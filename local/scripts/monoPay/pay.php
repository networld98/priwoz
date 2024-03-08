<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
global $USER;

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
            'reference' => $_GET['id'].'/'.date('dmYHis'),
            'destination' => 'Оплата місячної підписки на сайті priwoz.info',
            'comment' => 'Оплата місячної підписки на сайті priwoz.info ('.$_GET['id'].')',
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