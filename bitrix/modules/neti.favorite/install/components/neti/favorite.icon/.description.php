<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage('NETI_FAVORITE_FAVORITE_NAME'),
    "DESCRIPTION" => Loc::getMessage('NETI_FAVORITE_DESCRIPTION'),
    "PATH" => [
        "ID" => "neti.favorite",
        "CHILD" => [
            "ID" => "icon",
            "NAME" => Loc::getMessage('NETI_FAVORITE_CHILD_NAME')
        ]
    ],
    "ICON" => "/images/icon.gif",
];