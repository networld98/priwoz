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

// Отримуємо айді елемента
    $id = substr($data['reference'], 0, -14);
    $newDateElement = CIBlockElement::GetByID($id)->GetNextElement()->GetFields()['ACTIVE_TO'];
    $dateNow = new DateTime();
    if ($newDateElement && $newDateElement>=$dateNow) {
        $newDate = new DateTime($newDateElement);
        // Добавляем 1 месяц к дате
        $newDate->add('P1M'); // Добавляем 1 месяц
    } else {
        // Если нет даты, добавляем 1 месяц к текущей дате
        $newDate = new DateTime();
        $newDate->add('P1M'); // Добавляем 1 месяц
    }
// Форматируем новую дату
    $newDateFormatted = $newDate->format('d.m.Y H:i:s');

echo $newDateFormatted;

    $el = new CIBlockElement;
    $el->Update(
        $id,
        ['DATE_ACTIVE_TO' => $newDateFormatted, 'ACTIVE' => 'Y', 'PAYMENT_DATE' => date('d.m.Y H:i:s'), 'PAYMENT_NUMBER' => $data['invoiceId']],
        true
    );

    $res = CIBlockElement::GetByID($id);
    if ($ar_res = $res->GetNext()) {
        $iblockId = $ar_res['IBLOCK_ID'];
    }
    CIBlockElement::SetPropertyValuesEx($id, $iblockId, Array("PAYMENT_DATE" => date('d.m.Y H:i:s'), 'PAYMENT_NUMBER' => $data['invoiceId'], 'PAYMENT_URL' => $data['pageUrl']));

// Робимо що-небудь з отриманими даними

    CEventLog::Add(array(
        "CACHE" => "MonoPay",
        "AUDIT_TYPE_ID" => "MonoPay",
        "MODULE_ID" => "mono",
        "DESCRIPTION" => "MonoPay элемент " . $id . " оплачен, данные от банка: " . $postData,
    ));
}
?>