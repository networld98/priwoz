<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
Loader::includeModule("iblock");

global $USER;
if(!empty($_GET['id'])){ //Оплата обьявлений/компаний если указан айди элемента
$name = CIBlockElement::GetByID($_GET['id'])->GetNextElement()->GetFields()['NAME'];
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.monobank.ua/api/merchant/invoice/create',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        'amount' => (int)$_GET['p'],
        'ccy' => 980,
        'tds' => true,
        'redirectUrl' => 'https://'.$_SERVER['SERVER_NAME'].$_GET['link'],
        'webHookUrl' => 'https://'.$_SERVER['SERVER_NAME'].'/local/scripts/monoPay/result.php',
        'merchantPaymInfo' => array(
            'reference' => $_GET['id'].date('dmYHis'),
            'destination' => 'Оплата місячної підписки на сайті priwoz.info',
            'comment' => 'Оплата місячної підписки на сайті priwoz.info ('.$_GET['names'].')',
            'customerEmails' => array(
                $USER->GetEmail(),
            )
        )
      ]),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'X-Token:  mE8i2rhkdoUNjaMUw1qVXUQ',
    ),
));
}elseif(!empty($_GET['ids'])){ //Оплата рекламы если указаны группы сообществ

    //Создаем оплату рекламы, без фиксации самой оплаты
    $groups = explode(',',$_GET['ids']);
    $elementFields = array(
        "IBLOCK_ID" => 30,
        "NAME" => date('dmYHis').$_GET['names'],
        "ACTIVE" => "N",
        "PROPERTY_VALUES" => array(
            "GROUPS" => $groups,
            "TELEGRAM_NIK" => $_GET['telegram'],
            "PHONE" => $_GET['tel'],
            "FIO" => $_GET['name'],
        ),
    );

    $el = new CIBlockElement;
    $elementId = $el->Add($elementFields);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.monobank.ua/api/merchant/invoice/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            'amount' => (int)$_GET['p'],
            'ccy' => 980,
            'tds' => true,
            'redirectUrl' => 'https://'.$_SERVER['SERVER_NAME'].$_GET['link'],
            'webHookUrl' => 'https://'.$_SERVER['SERVER_NAME'].'/local/scripts/monoPay/result.php',
            'merchantPaymInfo' => array(
                'reference' => $elementId.date('dmYHis'),
                'destination' => 'Оплата реклами в спільнотах priwoz.info',
                'comment' => 'Оплата реклами в спільнотах priwoz.info ('.$_GET['id'].')',
            )
        ]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'X-Token:  mE8i2rhkdoUNjaMUw1qVXUQ',
        ),
    ));
}

$response = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);


// Обробка отриманої відповіді
if ($response === false) {
    // Виникла помилка при виконанні запиту
    echo 'Помилка: ' . curl_error($ch);
} else {
    // Обробка успішної відповіді
    $decoded_response = json_decode($response, true);
    // Переходимо до оплати
    header('Location: '.$decoded_response['pageUrl']);
    exit;
}
?>