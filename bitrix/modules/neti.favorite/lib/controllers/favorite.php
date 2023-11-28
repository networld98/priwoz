<?php

namespace Neti\Favorite\Controllers;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Result;
use Neti\Favorite\Cookies;
use Neti\Favorite\Entity\FavoritesTable;
use Neti\Favorite\Strategy;

/**
 * Class Favorite
 * @package Neti\Favorite\Controllers
 */
class Favorite extends Controller
{

    /**
     * @return array
     */
    public function configureActions(): array
    {
        return [
            'sendData' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_POST
                        ]
                    ),
                ],
            ],
            'setStatus' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_GET
                        ]
                    ),
                ],
            ],
            'allClean' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(
                        [
                            ActionFilter\HttpMethod::METHOD_POST
                        ]
                    ),
                ],
            ],
        ];
    }

    /**
     * @return array|null
     * @throws ArgumentNullException
     */
    public function sendDataAction(): ?array
    {
        $request = Context::getCurrent()->getRequest();
        $favoriteEntityId = (int) $request->get('favoriteEntityId'); // $id товара
        $iblockId = (int) $request->get('iblockId'); //iblockId

        if (!$favoriteEntityId) {
            throw new ArgumentNullException('favoriteElement');
        }

        if (!$iblockId) {
            throw new ArgumentNullException('iblockElement');
        }

        $strategy = new Strategy($iblockId, $favoriteEntityId);
        $methodAndClass = $strategy->run();

        $actionResult = new Result();

        $actionResult->setData($methodAndClass);

        return $actionResult->getData();
    }

    public function setStatusAction(): array
    {
        $result['ids'] = (new Cookies())->getIds();
        $result['addClass'] = Option::get('neti.favorite', 'addClass');
        $result['removeClass'] = Option::get('neti.favorite', 'removeClass');

        $actionResult = new Result();
        $actionResult->setData($result);
        return $actionResult->getData();
    }

    public function allCleanAction(): array
    {
        global $USER;
        if ($USER->GetID()) {
            FavoritesTable::deleteByUser();
        }
        $objCookies = new Cookies();
        $objCookies->clear();

        $actionResult = new Result();
        $actionResult->setData(['action' => 'success']);
        return $actionResult->getData();
    }
}