<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Neti\Favorite\Cookies;

Loc::loadMessages(__FILE__);

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * Class FavoritesCounter
 */
class FavoritesCounter extends CBitrixComponent
{
    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $result = [
            "LINK" => trim($arParams['LINK'])
        ];
        return $result;
    }

    /**
     * @return void
     */
    public function executeComponent()
    {
        try {
            \Bitrix\Main\UI\Extension::load('neti_favorite.neti_lib');
            $this->checkInstalledModules();
            $this->arResult['LINK'] = $this->arParams['LINK'];

            $this->includeComponentTemplate();

        } catch (Exception $exception) {
            ShowError($exception->getMessage());
        }
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private function checkInstalledModules(): void
    {
        if (!Loader::includeModule('neti.favorite')) {
            throw new Exception(Loc::getMessage('INSTALL_ERROR_MODULES_NETI_FAVORITE'));
        }
    }
}