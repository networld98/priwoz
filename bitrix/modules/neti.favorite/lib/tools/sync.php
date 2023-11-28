<?php

namespace Neti\Favorite\Tools;

use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Neti\Favorite\Entity\FavoritesTable;

class Sync
{
    private array $arrCookies;
    private array $tableFormat;

    public function __construct(array $arrCookies, array $tableFormat)
    {
        $this->tableFormat = $tableFormat;
        $this->arrCookies = $arrCookies;
    }

    /**
     * @return array
     * @throws SystemException
     */
    public function __invoke(): array
    {
        if (empty($this->arrCookies)) {
            return $this->tableFormat;
        }

        $this->insert();

        return $this->generateCookie();
    }

    /**
     * @throws SystemException
     */
    private function insert(): void
    {
        foreach ($this->arrCookies as $iblockId => $arrElementIds) {
            foreach($arrElementIds as $elementId) {
                $found = in_array($elementId, $this->tableFormat[$iblockId] ?? []);

                if ($found === false) {
                    (new FavoritesTable($iblockId, $elementId))->addElement();
                }
            }
        }
    }

    /**
     * @return array
     */
    private function generateCookie(): array
    {
        $cookie = [];
        $keys = array_merge(array_keys($this->arrCookies), array_keys($this->tableFormat));
        $keys = array_unique($keys);

        foreach ($keys as $key) {
            $merge = array_unique(array_merge($this->arrCookies[$key] ?? [], $this->tableFormat[$key] ?? []));
            $cookie[$key] = $merge;
        }

        return $cookie;
    }
}