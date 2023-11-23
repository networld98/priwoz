<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if($_POST['CATEGORY']){

$arAllElements = [];
$arSelect1 = Array("ID", "NAME");
$arFilter1 = Array("IBLOCK_ID"=>20, "IBLOCK_SECTION_ID"=>$_POST['CATEGORY'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$dbAllElements = CIBlockElement::GetList(Array(), $arFilter1, false, false , $arSelect1);

while($arElement = $dbAllElements->Fetch())
{
    $arAllElements[$arElement['ID']] = array('VALUE'=>$arElement['NAME']);
}

$arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]['ENUM'] = $arAllElements;

if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
    $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];
?>
<select class="SUBCATEGORY" name="PROPERTY[<?=$propertyID?>][0]">
   <?if(count((array)$arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"])== 0){
     $message = GetMessage("CT_BIEAF_PROPERTY_VALUE_NON_SUBCATEGORY");
   }else{
     $message = GetMessage("CT_BIEAF_PROPERTY_VALUE_NA_SUBCATEGORY");
   }?>
    <option value=""><?=$message?></option>
    <?
    if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
    else $sKey = "ELEMENT";

    foreach ($arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"] as $key => $arEnum)
    {
        $checked = false;
        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
        {
            foreach ($arResult[$sKey][$_POST['CATEGORY']] as $elKey => $arElEnum)
            {
                if ($key == $arElEnum["VALUE"])
                {
                    $checked = true;
                    break;
                }
            }
        }
        else
        {
            if ($arEnum["DEF"] == "Y") $checked = true;
        }
        ?>
        <option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
        <?
    }
    ?>
</select>
<?}?>
