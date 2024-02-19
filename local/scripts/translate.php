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
    $arrayList[$array[3]]= $array[2];
}

     $bs = new CIBlockSection;
            $arSelect = array("NAME","ID");
            $arFilter = array("IBLOCK_ID"=>20);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {
                     $IBLOCK_ID = 20;
                          $arFields = Array(
                             "UF_NAME_UA" => $arrayList[$ar_result['NAME']],
                          );
                    $bs->Update($ar_result['ID'], $arFields);
            }?>
