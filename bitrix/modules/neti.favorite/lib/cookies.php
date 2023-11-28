<?php

namespace Neti\Favorite;

use Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;

/**
 * Class Cookies
 * @package Neti\Favorite
 */
class Cookies
{
    /**
     * @return string|null
     */
    public function getJson(): ?string
    {
        return Application::getInstance()->getContext()->getRequest()->getCookie('Favorites');
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return json_decode($this->getJson(), true) ?? [];
    }

    public function clear(): void
    {
        Context::getCurrent()->getResponse()->addCookie(
            new Cookie('Favorites', $this->getJson(), time() - 3600 * 24 * 30)
        );
    }

    /**
     * @param int|null $iblockId
     * @return array|null
     */
    public function getIds(int $iblockId = null): ?array
    {
        $arrCookies = $this->getArray();
        $arrIds = [];
        if ($iblockId !== null) {
            $arrCookies = $arrCookies[$iblockId];
            foreach ($arrCookies as $id) {
                $arrIds[] = $id;
            }
            if (empty($arrIds)) {
                return null;
            }

            return $arrIds;
        }
        foreach ($arrCookies as $cookie) {
            foreach ($cookie as $id) {
                $arrIds[] = $id;
            }
        }

        return $arrIds ?? null;
    }

    /**
     * @param array $arCookie
     */
    public function set(array $arCookie): void
    {
        $jsonCookie = json_encode($arCookie);
        $cookie = new Cookie("Favorites", $jsonCookie, time() + 3600 * 24 * 30);
        $cookie->setSecure(false);
        Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
    }

    /**
     * @param int $iblockId
     * @param int $elementId
     * @return array|null
     */
    public function save(int $iblockId, int $elementId): ?array
    {
        $arrCurrentCookies = $this->getArray();
        if (!array_key_exists($iblockId, $arrCurrentCookies)) {
            $arrCurrentCookies[$iblockId][] = $elementId;
            $this->set($arrCurrentCookies);
            return $this->returnArrayMethodAdd();
        }
        if (array_key_exists($iblockId, $arrCurrentCookies)) {
            $ids = $arrCurrentCookies[$iblockId];
            $foundId = false;
            foreach ($ids as $id) {
                if ((int) $id === $elementId) {
                    $foundId = true;
                    break;
                }
            }
            if ($foundId === true) {
                $this->delete($iblockId, $elementId);
                return $this->returnArrayMethodDelete();
            }

            $arrCurrentCookies[$iblockId][] = $elementId;
            $this->add($iblockId, $elementId);
            return $this->returnArrayMethodAdd();
        }
        return null;
    }

    /**
     * @return array
     */
    private function returnArrayMethodAdd(): array
    {
        return [
            'count' => count($this->getIds()) + 1,
            'method' => 'addElement',
            'classAdd'  => Option::get('neti.favorite', 'addClass'),
            'classDelete' => Option::get('neti.favorite', 'removeClass'),
        ];
    }

    /**
     * @return array
     */
    private function returnArrayMethodDelete(): array
    {
        return [
            'count' => count($this->getIds()) - 1,
            'method' => 'deleteElement',
            'classAdd'  => Option::get('neti.favorite', 'removeClass'),
            'classDelete' => Option::get('neti.favorite', 'addClass'),
        ];
    }

    /**
     * @param int $iblockId
     * @param int $elementId
     */
    public function delete(int $iblockId, int $elementId): void
    {
        $arrCurrentCookies = $this->getArray();

        $arrIds = $arrCurrentCookies[$iblockId];
        $removeKey = array_search($elementId, $arrIds);
        unset($arrCurrentCookies[$iblockId][$removeKey]);

        if (count($arrCurrentCookies[$iblockId]) === 0) {
            unset($arrCurrentCookies[$iblockId]);
        }
        if (empty($arrCurrentCookies)) {
            $this->clear();
            return;
        }

        $this->set($arrCurrentCookies);
    }

    /**
     * @param int $iblockId
     * @param int $elementId
     */
    public function add(int $iblockId, int $elementId): void
    {
        $arrCurrentCookies = $this->getArray();
        $arrCurrentCookies[$iblockId][] = $elementId;

        $this->set($arrCurrentCookies);
    }
}
