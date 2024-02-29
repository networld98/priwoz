<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;

Loader::includeModule("iblock");

// Отримуємо вміст POST-запиту
$postData = file_get_contents('php://input');

// Перетворюємо JSON-рядок у асоціативний масив
$data = json_decode($postData, true);

if ($data['status'] == 'success') {

//Отримуємо дату дякої діє оголошення
$newDate = date('d.m.Y', strtotime('+1 month'));

// Отримуємо айді елемента
    $id = explode('/', $data['reference']);
    $el = new CIBlockElement;
    $el->Update(
        $id[0],
        ['DATE_ACTIVE_TO' => $newDate, 'ACTIVE' => 'Y', 'PAYMENT_DATE' => date('d.m.Y'), 'PAYMENT_NUMBER' => $data['invoiceId']],
        true
    );

// Робимо що-небудь з отриманими даними

    CEventLog::Add(array(
        "CACHE" => "MonoPay",
        "AUDIT_TYPE_ID" => "MonoPay",
        "MODULE_ID" => "mono",
        "DESCRIPTION" => "MonoPay элемент " . $id[0] . " оплачен, данные от банка: " . $postData,
    ));
}
?>