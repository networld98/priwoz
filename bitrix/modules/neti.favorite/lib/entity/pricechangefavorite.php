<?php
namespace Neti\Favorite\Entity;

use Bitrix\Main\Entity;

/**
 * Class PriceChangeFavoriteTable
 * @package Neti\Favorite\Entity
 */
class PriceChangeFavoriteTable extends Entity\DataManager
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'neti_favorites_price_change';
    }

    /**
     * @return string
     */
    public static function getHlTableName(): string
    {
        return 'NetiFavoritesPriceChange';
    }

    /**
     * @return array
     */
    public static function getMap(): array
    {
        $arFields = [];
        try {
            $arFields = [
                new Entity\IntegerField('ID', [
                    'primary' => true,
                    'autocomplete' => true
                ]),
                new Entity\IntegerField('UF_PRODUCT_ID'),
                new Entity\FloatField('UF_OLD_PRICE'),
                new Entity\FloatField('UF_PRICE'),
                new Entity\DatetimeField('UF_DATE'),
            ];
        } catch (\Exception $e) {
        }
        return $arFields;
    }
}