<?php

namespace Neti\Favorite\Tools;

use Bitrix\Main\Config\Option;
use Neti\Favorite\Entity\FavoritesTable;

/**
 * Class Helper
 * @package Neti\Favorite\Tools
 */
class Helper
{
    /**
     * @param array $elementsTable
     * @return array
     */
    public static function transformCookieFormat(array $elementsTable): array
    {
        $tableFormatCookies = [];
        foreach ($elementsTable as $cookie) {
            $iblockId = $cookie['UF_IBLOCK'];
            $tableFormatCookies[$iblockId][] = $cookie['UF_ENTITY'];
        }
        return $tableFormatCookies;
    }

    /**
     * @param string $error
     */
    public static function log(string $error): void
    {
        if (Option::get('neti.favorite', 'log') === 'Y') {
            \CEventLog::Add([
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID" => "NETI_FAVORITE_ERROR",
                "MODULE_ID" => "neti.favorite",
                "DESCRIPTION" => $error,
            ]);
        }
    }
}