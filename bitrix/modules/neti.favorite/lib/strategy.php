<?php

namespace Neti\Favorite;

use Neti\Favorite\Entity\FavoritesTable;

/**
 * Class Strategy
 * @package Neti\Favorite
 */
class Strategy
{
    private int $iblockId;
    private int $elementId;

    /**
     * Strategy constructor.
     * @param int $iblockId
     * @param int $elementId
     */
    public function __construct(int $iblockId, int $elementId)
    {
        $this->iblockId = $iblockId;
        $this->elementId = $elementId;
    }

    /**
     * @return array
     */
    public function run(): array
    {
        $objCookies = new Cookies();
        $methodAndClass = $objCookies->save($this->iblockId, $this->elementId);

        global $USER;
        if ($USER->IsAuthorized()) {
            $objFavorite = new FavoritesTable($this->iblockId, $this->elementId);
            $method = $methodAndClass['method'];
            $objFavorite->$method();
        }

        return $methodAndClass;
    }
}