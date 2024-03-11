<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses('priwoz.option', array(
    // no thanks, bitrix, we better will use psr-4 than your class names convention
    'Priwoz\Option\ExampleTable' => 'lib/ExampleTable.php',
));

EventManager::getInstance()->addEventHandler('main', 'OnAfterUserAdd', function(){
    // do something when new user added

});
