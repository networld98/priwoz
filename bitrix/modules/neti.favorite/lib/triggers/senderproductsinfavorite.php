<?php

namespace Neti\Favorite\Triggers;

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\UserTable;
use Bitrix\Sender\Trigger\TriggerConnectorClosed;
use Exception;
use Neti\Favorite\Entity\FavoritesTable;
use Neti\Favorite\Entity\PriceChangeFavoriteTable;
use Neti\Favorite\Tools\Helper;

Loader::includeModule('sender');
Loc::loadMessages(__FILE__);

/**
 * Class SenderProductsInFavorite
 * @package Neti\Favorite\Triggers
 */
class SenderProductsInFavorite extends TriggerConnectorClosed
{
    /**
     * @param Event $event
     * @return Event
     */
    public static function addTriggerInList(Event $event): Event
    {
        $event->addResult(new EventResult(EventResult::SUCCESS, [
            'TRIGGER' => [
                '\Neti\Favorite\Triggers\SenderProductsInFavorite'
            ]
        ],
            'neti.favorite',
        ));

        return $event;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return Loc::getMessage('NETI_FAVORITE_NAME_TRIGGER');
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return "neti_favorite_trigger_low_price";
    }

    /**
     * @return bool
     */
    public static function canBeTarget(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public static function canRunForOldData(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function filter(): bool
    {
        try {
            if (!Loader::includeModule('highloadblock')) {
                return false;
            }
            if (!Loader::includeModule('iblock')) {
                return false;
            }

            $this->setRecipient();
            if (count($this->recipient) > 0) {
                $this->deletePriceChange();
                return true;
            }

            return false;
        } catch (Exception $e) {
            Helper::log($e->getMessage());

            return false;
        }
    }

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function setRecipient(): void
    {
        $res = PriceChangeFavoriteTable::getList([
            'select' => [
                '*',
                'FAVORITE_UF_ENTITY' => 'FAVORITE.UF_ENTITY',
                'FAVORITE_UF_OWNER' => 'FAVORITE.UF_OWNER',
                'FAVORITE_UF_DATE' => 'FAVORITE.UF_DATE',
                'USER_EMAIL' => 'USER.EMAIL',
                'USER_NAME' => 'USER.NAME',
                'USER_ID' => 'USER.ID'
            ],
            'runtime' => [
                (new ReferenceField(
                    'FAVORITE',
                    FavoritesTable::class,
                    Join::on('this.UF_PRODUCT_ID', 'ref.UF_ENTITY')
                ))->configureJoinType(Join::TYPE_INNER),
                new ReferenceField(
                    'USER',
                    UserTable::class,
                    Join::on('this.FAVORITE.UF_OWNER', 'ref.ID')
                ),
            ]
        ])->fetchAll();

        if (empty($res)) {
            return;
        }

        $mails = [];
        foreach ($res as $info) {
            $updatePriceTime = $info['UF_DATE']->getTimestamp();
            $priceInFavoritesTime = $info['FAVORITE_UF_DATE']->getTimestamp();
            if ($updatePriceTime > $priceInFavoritesTime) {
                $userId = $info['USER_ID'];
                $productId = $info['UF_PRODUCT_ID'];
                $email = $info['USER_EMAIL'];
                $userName = $info['USER_NAME'];

                if (!empty($mails[$userId])) {
                    $mails[$userId]['PRODUCT_ID'] .= ',' . $productId;
                } else {
                    $mails[$userId] = [
                        'FAVORITE_PRODUCT_IDS' => $productId,
                        'USER_ID' => $userId,
                        'EMAIL' => $email,
                        'NAME' => $userName,
                    ];
                }
            }
        }

        $this->recipient = $mails;
    }

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Exception
     */
    public function deletePriceChange(): void
    {
        $ids = PriceChangeFavoriteTable::getList([
            'select' => ['ID'],
        ])->fetchAll();
        foreach ($ids as $id) {
            PriceChangeFavoriteTable::delete($id);
        }
    }

    /**
     * @return \string[][]
     */
    public static function getPersonalizeList(): array
    {
        return [
            [
                'CODE' => 'FAVORITE_PRODUCT_IDS',
                'NAME' => 'ID продуктов',
                'DESC' => '',
            ],
        ];
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

}