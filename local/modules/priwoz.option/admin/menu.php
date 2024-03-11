<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu = array(
    array(
        'parent_menu' => 'global_menu_content',
        'sort' => 400,
        'text' => Loc::getMessage('REFERENCES_MENU_TEXT'),
        'title' => Loc::getMessage('REFERENCES_MENU_TITLE'),
        'url' => 'priwoz_option_index.php',
        'items_id' => 'menu_references',
        'items' => array(
            array(
                'text' => Loc::getMessage('REFERENCES_MENU_TEXT'),
				'url' => 'settings.php?lang='.LANGUAGE_ID.'&mid=priwoz.option&mid_menu=1',
                'more_url' => array('settings.php?lang='.LANGUAGE_ID.'&mid=priwoz.option&mid_menu=1'),
                'title' => Loc::getMessage('REFERENCES_MENU_TITLE'),
            ),
        ),
    ),
);

return $aMenu;
