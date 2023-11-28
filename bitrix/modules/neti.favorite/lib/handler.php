<?php

namespace Neti\Favorite;

use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Neti\Favorite\Entity\FavoritesTable;
use Neti\Favorite\Entity\PriceChangeFavoriteTable;
use Neti\Favorite\Tools\Helper;
use Neti\Favorite\Tools\Sync;

/**
 * Class Handler
 * @package Neti\Favorite
 */
class Handler
{
    /**
     * @param array $data
     * @return array
     */
    public static function onTriggerList(array $data = []): array
    {
        if (Option::get('neti.favorite', 'mailing') === 'Y') {
            $data['TRIGGER'] = [
                '\Neti\Favorite\Triggers\SenderProductsInFavorite',
            ];
        }

        return $data;
    }

    /**
     * @param \Bitrix\Main\ORM\Event $arFields
     */
    public static function onAfterUpdatePriceHandler(\Bitrix\Main\ORM\Event $arFields):void
    {
        try {
            if (!Loader::includeModule('catalog')) return;
            if (!Loader::includeModule('iblock')) return;

            $parameters = $arFields->getParameter('fields');

            $element = ElementTable::getList([
                'select' => ['*', 'PRICE_LIST'],
                'filter' => ['=ID' => (int) $parameters['PRODUCT_ID']],
                'runtime' => [
                    'PRICE_LIST' => [
                        'data_type' => PriceTable::class,
                        'reference' => [
                            '=ref.PRODUCT_ID' => 'this.ID',
                        ],
                        'join_type' => 'inner'
                    ],
                ],
            ])->fetch();

            if (empty($element)) {
                return;
            }

            if ($parameters['PRICE'] < $element['IBLOCK_ELEMENT_PRICE_LIST_PRICE']) {
                $parameters['NAME'] = $element['NAME'];
                $res = PriceChangeFavoriteTable::getList([
                    'filter' => ['UF_PRODUCT_ID' => $parameters['PRODUCT_ID']]
                ]);
                if ($dbRes = $res->fetch()) {
                    PriceChangeFavoriteTable::delete($dbRes['ID']);
                }
                $id = PriceChangeFavoriteTable::getList([
                    'filter' => [
                        'UF_PRODUCT_ID' => $parameters['PRODUCT_ID']
                    ]
                ])->fetch()['ID'];

                if (!empty($id)) PriceChangeFavoriteTable::delete($id);

                PriceChangeFavoriteTable::add([
                    'UF_PRODUCT_ID' => $parameters['PRODUCT_ID'],
                    'UF_PRICE' => $parameters['PRICE'],
                    'UF_OLD_PRICE' => $element['IBLOCK_ELEMENT_PRICE_LIST_PRICE'],
                    'UF_DATE' => new DateTime(),
                ]);
            }
        } catch (\Exception $e) {
            Helper::log($e->getMessage());
        }
    }

    /**
     * @param $arUser
     */
    public static function OnAfterUserAuthorizeHandler($arUser): void
    {
        try {
            $userId = (int) $arUser['user_fields']['ID'];

            $objCookieFav = new Cookies();
            $arrCookies = $objCookieFav->getArray();

            $elementsTable = FavoritesTable::getList([
                'select' => ['UF_IBLOCK', 'UF_ENTITY'],
                'filter' => ['UF_OWNER' => $userId]
            ])->fetchAll();

            $tableFormat = Helper::transformCookieFormat($elementsTable);

            $sync = new Sync($arrCookies, $tableFormat);
            $cookie = $sync();

            if ($cookie !== []) {
                $objCookieFav->set($cookie);
            }

        } catch (\Exception $e) {
            Helper::log($e->getMessage());
        }
    }

    public static function OnIBlockElementDelete($arFields): void
    {
        if ($arFields['IBLOCK_ID'] === Option::get('neti.favorite', 'iblock')) {
                $res = FavoritesTable::getList([
                    'select' => ['ID'],
                    'filter' => ['UF_ENTITY' => $arFields['ID']]
                ]);
                if ($res = $res->fetchAll()) {
                    foreach ($res as $elementHL)
                        FavoritesTable::delete($elementHL['ID']);
                }
            }
        }


    public static function OnAfterUserLogoutHandler(): void
    {
        try {
            $objCookieFav = new Cookies();
            $objCookieFav->clear();
        } catch (\Exception $e) {
            Helper::log($e->getMessage());
        }
    }
}