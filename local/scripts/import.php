<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
Loader::includeModule("catalog");
$file = $_SERVER["DOCUMENT_ROOT"].'/local/scripts/olx.csv';
$src = fopen($file,'r');
if (!$src) die('File read error');

while (($data = fgetcsv($src, 0, "\t")) !== FALSE) {
    $new[] = explode(';',$data[0]);
   
}
unset($new[0]);
foreach ($new as $array){
    $arrayList[]=['ID'=> $array[0], 'PARRENT_ID'=> $array[1], "NAME_UA"=> $array[2], "NAME_RU"=> $array[3]];
}
$bs = new CIBlockSection;
$el = new CIBlockElement;
$secCount = 0;
$itemCount = 0;
$parents = [];
$params = Array(
    "max_len" => "100", // обрезает символьный код до 100 символов
    "change_case" => "L", // буквы преобразуются к нижнему регистру
    "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
    "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
    "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
    "use_google" => "false", // отключаем использование google
);
foreach ($arrayList as $item) {
    $ID=NULL;
    if($item["PARRENT_ID"]==NULL){
        $parents[$item["PARRENT_ID"]] = false;
    }
  /*  echo "<pre>";
    print_r( $item);
    echo "</pre>";*/
    if ($item["ID"]!=NULL) {
        $secCount++;
        $arFields = array(
            "ACTIVE" => "Y",
            "IBLOCK_SECTION_ID" => $parents[$item["PARRENT_ID"]],
            "CODE" => CUtil::translit($item["NAME_RU"], "ru" , $params),
            "IBLOCK_ID" => 20,
            "NAME" => $item["NAME_RU"],
            "SORT" => 500,
            'UF_NAME_UA' => array('VALUE' => $item["NAME_UA"])

        );
        if ($ID > 0) {
            $res = $bs->Update($ID, $arFields);
            $parents[$item["ID"]] = $ID;
        } else {
            $ID = $bs->Add($arFields);
            $res = ($ID > 0);
        }
        $parents[$item["ID"]] = $ID;
        echo  $ID;
        echo "<br>";
        echo $item["NAME_RU"];
        echo "<br>";
        if (!$res)
            echo $bs->LAST_ERROR;

    }else{
        $itemCount++;
        $PROP = array();
        $PROP[536] = $item["NAME_UA"];
        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(),
            "IBLOCK_SECTION_ID" => $parents[$item["PARRENT_ID"]],
            "CODE" => CUtil::translit($item["NAME_RU"], "ru" , $params),
            "IBLOCK_ID"      => 20,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => $item["NAME_RU"],
            "ACTIVE"         => "Y",            // активен
        );
        if($PRODUCT_ID = $el->Add($arLoadProductArray))
            echo "New ID: ".$PRODUCT_ID;
        else
            echo "Error: ".$el->LAST_ERROR;
    }

}
echo "<pre>";
  print_r($parents);
  echo "</pre>";

//print '<br>Рубрик и подрубрик: '.echo $secCount;.'<br>';
//print 'Категорий: '.echo $itemCount;.'<br>';
