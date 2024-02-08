<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if ($_POST['CATEGORY']) {

    $arAllElements = [];
    $arSelect1 = array("ID", "NAME");
    $arFilter1 = array("IBLOCK_ID" => 20, "IBLOCK_SECTION_ID" => $_POST['CATEGORY'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $dbAllElements = CIBlockElement::GetList(array(), $arFilter1, false, false, $arSelect1);

    while ($arElement = $dbAllElements->Fetch()) {
        $arAllElements[$arElement['ID']] = array('VALUE' => $arElement['NAME']);
    }

    $arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]['ENUM'] = $arAllElements;

    if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
        $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];
    ?>
    <div class="form-select-box">
        <? if (count((array)$arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"]) == 0) {?>
            <input type="text"  class="form-control"  readonly placeholder="<?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NON_SUBCATEGORY".$_POST['SITE_ID']);?>">
        <?} else {?>
        <select class="form-select SUBCATEGORY" name="PROPERTY[528][0]">
            <option value=""><?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NA_SUBCATEGORY_".$_POST['SITE_ID']) ?></option>
            <?
            if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
            else $sKey = "ELEMENT";

            foreach ($arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"] as $key => $arEnum) {
                if($_POST['SITE_ID']=='ua'){
                    $arEnum["VALUE"] = CIBlockElement::GetByID($key)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                }
                $checked = false;
                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                    foreach ($arResult[$sKey][$_POST['CATEGORY']] as $elKey => $arElEnum) {
                        if ($key == $arElEnum["VALUE"]) {
                            $checked = true;
                            break;
                        }
                    }
                } else {
                    if ($arEnum["DEF"] == "Y") $checked = true;
                }
                ?>
                <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
                <?
            }
            ?>
        </select>
    </div>
    <script>
        $( document ).ready(function() {
            $(".form-select:not(.-with-icon)").select2();
        })
    </script>

        <?}?>
<? }elseif($_POST['CATEGORY']==""){?>
<div class="form-select-box">
    <input type="text"  class="form-control"  readonly placeholder="<?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NON_SUBCATEGORY_".$_POST['SITE_ID']);?>">
</div>
<?}?>
