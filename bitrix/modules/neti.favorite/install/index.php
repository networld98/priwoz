<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\SystemException;
use Neti\Favorite\Entity\FavoritesTable;
use Neti\Favorite\Entity\PriceChangeFavoriteTable;

Loc::loadMessages(__FILE__);

class neti_favorite extends CModule
{
    public $MODULE_ID = 'neti.favorite';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $PARTNER_URI;

    public $errors, $module_path;

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__.'/version.php');

        $this->MODULE_ID = 'neti.favorite';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = Loc::getMessage('MODULE_NETI_FAVORITE_PARTHER_NAME');
        $this->PARTNER_URI = 'https://netiweb.ru';

        $this->MODULE_NAME =  Loc::getMessage('MODULE_NETI_FAVORITE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_NETI_FAVORITE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
    }

    public function doInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $step;

        if (!ModuleManager::isModuleInstalled('highloadblock')) {
            throw new SystemException(Loc::getMessage('ERROR_MODULE_HIGHLOADBLOCK'));
        }
        if (!ModuleManager::isModuleInstalled('iblock')) {
            throw new SystemException(Loc::getMessage('ERROR_MODULE_IBLOCK'));
        }

        $step = (int) $step;
        if ($step < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage('NETI_FAVORITE_HELLO'), $DOCUMENT_ROOT."/bitrix/modules/" . $this->MODULE_ID . "/install/step1.php");
        }
        if ($step === 2) {
            ModuleManager::registerModule($this->MODULE_ID);
            if (Loader::includeModule($this->MODULE_ID)) {
                $this->doInstallFiles();
                $this->doInstallEvents();
                $this->doInstallDB();
                $APPLICATION->IncludeAdminFile(Loc::getMessage('MODULE_NETI_COMPLETE_INSTALL'), $DOCUMENT_ROOT."/bitrix/modules/" . $this->MODULE_ID . "/install/step2.php");
            }
        }
        return true;
    }

    public function doUninstall()
    {
        global $APPLICATION, $DOCUMENT_ROOT, $step;
        $step = (int) $step;

        if ($step < 2) {
            $APPLICATION->IncludeAdminFile('', $DOCUMENT_ROOT."/bitrix/modules/" . $this->MODULE_ID . "/install/unstep1.php");
        }
        if ($step === 2) {
            $context = Application::getInstance()->getContext();
            $request = $context->getRequest();
            if (Loader::includeModule($this->MODULE_ID)) {
                $this->doUnInstallEvents();
                $this->doUnInstallFiles();
                if (empty($request->getValues()['savedata'])) {
                    $this->doUnInstallDB();
                }
                ModuleManager::unRegisterModule($this->MODULE_ID);
                $APPLICATION->IncludeAdminFile(Loc::getMessage('MODULE_NETI_COMPLETE_UNINSTALL'), $DOCUMENT_ROOT . "/bitrix/modules/" . $this->MODULE_ID . "/install/unstep2.php");

            }
        }
        return true;
    }

    public function doInstallDB()
    {
		if (!Loader::includeModule('highloadblock')) {
		    throw new SystemException('');
        }
        $hlId = HL\HighloadBlockTable::getList([
            'filter' => ['TABLE_NAME' => FavoritesTable::getTableName()]
        ])->fetch()['ID'];

        if (empty($hlId)) {
            $result = HL\HighloadBlockTable::add([
                'NAME' => FavoritesTable::getHlTableName(),
                'TABLE_NAME' => FavoritesTable::getTableName(),
            ]);
            if (!$result->isSuccess()) {
                throw new Exception('Error');
            }

            $hlId = $result->getId();
            $oUserTypeEntity = new \CUserTypeEntity();

            $aUserFieldsOwner    = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_OWNER',
                'USER_TYPE_ID'      => 'integer',
                'XML_ID'            => 'XML_ID_OWNER',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OWNER'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OWNER'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OWNER'),
                ],
                'ERROR_MESSAGE' => [
                    'ru'    => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_OWNER'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsOwner);
            $aUserFieldsEntity = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_ENTITY',
                'USER_TYPE_ID'      => 'integer',
                'XML_ID'            => 'XML_ID_ENTITY',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_ENTITY'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_ENTITY'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_ENTITY'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_ENTITY'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsEntity);
            $aUserFieldsDate = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_DATE',
                'USER_TYPE_ID'      => 'datetime',
                'XML_ID'            => 'XML_ID_DATE',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_DATE'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsDate);
            $aUserFieldType = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_IBLOCK',
                'USER_TYPE_ID'      => 'integer',
                'XML_ID'            => 'XML_ID_IBLOCK',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_IBLOCK_ID'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_IBLOCK_ID'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_IBLOCK_ID'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_IBLOCK_ID'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldType);
        }

        $hlId = HL\HighloadBlockTable::getList([
            'filter' => ['TABLE_NAME' => PriceChangeFavoriteTable::getTableName()]
        ])->fetch()['ID'];

        if (empty($hlId) && ModuleManager::isModuleInstalled('catalog')) {
            $result = HL\HighloadBlockTable::add([
                'NAME' => PriceChangeFavoriteTable::getHlTableName(),
                'TABLE_NAME' => PriceChangeFavoriteTable::getTableName(),
            ]);
            if (!$result->isSuccess()) {
                throw new Exception('Error');
            }

            $hlId = $result->getId();
            $oUserTypeEntity = new \CUserTypeEntity();
            $aUserFieldsOwner    = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_PRODUCT_ID',
                'USER_TYPE_ID'      => 'integer',
                'XML_ID'            => 'XML_ID_OWNER',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_PRODUCT_ID'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_PRODUCT_ID'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_PRODUCT_ID'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_PRODUCT_ID'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsOwner);
            $aUserFieldsOwner    = [
                'ENTITY_ID'         => 'HLBLOCK_' . $hlId,
                'FIELD_NAME'        => 'UF_PRICE',
                'USER_TYPE_ID'      => 'string',
                'XML_ID'            => 'XML_ID_PRICE',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_NEW_PRICE'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_NEW_PRICE'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_NEW_PRICE'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_NEW_PRICE'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsOwner);
            $aUserFieldsOwner    = [
                'ENTITY_ID'         => 'HLBLOCK_' . $hlId,
                'FIELD_NAME'        => 'UF_OLD_PRICE',
                'USER_TYPE_ID'      => 'string',
                'XML_ID'            => 'XML_ID_OLD_PRICE',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OLD_PRICE'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OLD_PRICE'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_OLD_PRICE'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_OLD_PRICE'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsOwner);
            $aUserFieldsDate = [
                'ENTITY_ID'         => 'HLBLOCK_'.$hlId,
                'FIELD_NAME'        => 'UF_DATE',
                'USER_TYPE_ID'      => 'datetime',
                'XML_ID'            => 'XML_ID_DATE',
                'SORT'              => 500,
                'MULTIPLE'          => 'N',
                'MANDATORY'         => 'N',
                'SHOW_FILTER'       => 'N',
                'SHOW_IN_LIST'      => '',
                'EDIT_IN_LIST'      => '',
                'IS_SEARCHABLE'     => 'N',
                'SETTINGS' => [
                    'DEFAULT_VALUE' => '',
                    'SIZE'          => '20',
                    'ROWS'          => '1',
                    'MIN_LENGTH'    => '0',
                    'MAX_LENGTH'    => '0',
                    'REGEXP'        => '',
                ],
                'EDIT_FORM_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE_CREATE'),
                ],
                'LIST_COLUMN_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE_CREATE'),
                ],
                'LIST_FILTER_LABEL' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_FIELD_DATE_CREATE'),
                ],
                'ERROR_MESSAGE' => [
                    'ru' => Loc::getMessage('NETI_FAVORITE_ERROR_FIELD_DATE_CREATE'),
                ],
                'HELP_MESSAGE' => [
                    'ru'    => '',
                ],
            ];
            $oUserTypeEntity->Add($aUserFieldsDate);
        }

        return true;
    }

    public function doUnInstallDB()
    {
        if (Loader::includeModule('highloadblock')) {
            $res = HL\HighloadBlockTable::getList([
                'filter' => ['TABLE_NAME' => PriceChangeFavoriteTable::getTableName()]
            ]);
            if ($id = $res->fetch()['ID']) {
                HL\HighloadBlockTable::delete($id);
            }

            $res = HL\HighloadBlockTable::getList([
                'filter' => ['TABLE_NAME' => FavoritesTable::getTableName()]
            ]);
            if ($id = $res->fetch()['ID']) {
                HL\HighloadBlockTable::delete($id);
            }
        }
        return true;
    }

    public function doInstallFiles()
    {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/'.$this->MODULE_ID.'/install/js', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/js', true, true);
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/'.$this->MODULE_ID.'/install/components/neti', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/neti', true, true);
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/'.$this->MODULE_ID.'/install/components/bitrix/catalog.show.products.mail/favorites', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/.default/components/bitrix/catalog.show.products.mail/favorites', true, true);
        return true;
    }

    public function doUnInstallFiles()
    {
        DeleteDirFilesEx('/bitrix/js/neti_favorite');
        DeleteDirFilesEx('/bitrix/components/neti/favorite.icon');
        DeleteDirFilesEx('/bitrix/templates/.default/components/bitrix/catalog.show.products.mail/favorites');
        return true;
    }

    public function doInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible("iblock", "OnIBlockElementDelete", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "OnIBlockElementDelete");
        $eventManager->registerEventHandlerCompatible("main", "OnAfterUserAuthorize", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "OnAfterUserAuthorizeHandler");
        $eventManager->registerEventHandlerCompatible("main", "OnAfterUserLogout", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "OnAfterUserLogoutHandler");
        $this->doInstallEventsTriggerEmailMarketing();
        $this->doInstallEventsCatalogPriceChange();
        return true;
    }

    public function doInstallEventsTriggerEmailMarketing()
    {
        if (ModuleManager::isModuleInstalled('sender') && ModuleManager::isModuleInstalled('catalog')) {
            $eventManager = EventManager::getInstance();
            $eventManager->registerEventHandlerCompatible("sender", "OnTriggerList", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "onTriggerList");
        }
        return true;
    }

    public function doInstallEventsCatalogPriceChange()
    {
        if (ModuleManager::isModuleInstalled('catalog')) {
            $eventManager = EventManager::getInstance();
            $eventManager->registerEventHandler('catalog','\Bitrix\Catalog\Price::OnBeforeUpdate', "neti.favorite", "\\Neti\\Favorite\\Handler","onAfterUpdatePriceHandler");
        }
        return true;
    }

    public function doUnInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler("iblock", "OnIBlockElementDelete", $this->MODULE_ID, "\\Neti\\Favorite\\Favorite", "OnIBlockElementDelete");
        $eventManager->unRegisterEventHandler("main", "OnAfterUserAuthorize", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "OnAfterUserAuthorizeHandler");
        $eventManager->unRegisterEventHandler("main", "OnAfterUserLogout", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "OnAfterUserLogoutHandler");
        $this->doUnInstallEventsTriggerEmailMarketing();
        $this->doUnInstallEventsCatalogPriceChange();
        return true;
    }

    public function doUnInstallEventsTriggerEmailMarketing()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler("sender", "OnTriggerList", $this->MODULE_ID, "\\Neti\\Favorite\\Handler", "onTriggerList");
        return true;
    }

    public function doUnInstallEventsCatalogPriceChange()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler('catalog','\Bitrix\Catalog\Price::OnBeforeUpdate', "neti.favorite", "\\Neti\\Favorite\\Handler","onAfterUpdatePriceHandler");
        return true;
    }
}
