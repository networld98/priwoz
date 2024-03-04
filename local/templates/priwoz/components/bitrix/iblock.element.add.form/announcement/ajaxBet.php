<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
if ($_POST['CATEGORY']) {
    $arAllElements = [];
    $dbAllElements = CIBlockSection::GetList (
        Array("ID" => "ASC"),
        Array("IBLOCK_ID" => 20, "SECTION_ID" => $_POST['CATEGORY']),
        false,
        Array('ID', 'NAME', 'CODE')
    );
    while($arElement = $dbAllElements->GetNext())
    {
        $arAllElements[$arElement['ID']] = array('VALUE' => $arElement['NAME']);
    }
    $arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]['ENUM'] = $arAllElements;

    if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
        $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];
    ?>
    <div class="form-select-box">
        <? if (count((array)$arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"]) == 0) {?>
            <input type="text" q class="form-control"  readonly placeholder="<?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NON_SUBCATEGORY_".$_POST['SITE_ID']);?>">
        <?} else {?>
        <select class="form-select BETCATEGORY" name="PROPERTY[571][0]">
            <option value=""><?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NA_SUBCATEGORY_".$_POST['SITE_ID']) ?></option>
            <?
            if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
            else $sKey = "ELEMENT";

            foreach ($arResult["PROPERTY_LIST_FULL"][$_POST['CATEGORY']]["ENUM"] as $key => $arEnum) {
                if($_POST['SITE_ID']=='ua'){
                    $arEnum["VALUE"] = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 20, 'ID' => $key), false, array('UF_NAME_UA'))->GetNext()['UF_NAME_UA'];
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
            $(".BETCATEGORY").change(function () {
                let id = $(this).val();
                let subcategory = $('.SUBCATEGORY-block');
                $.ajax({
                    type: "POST",
                    url: '<?=SITE_TEMPLATE_PATH ?>/components/bitrix/iblock.element.add.form/announcement/ajaxCategory.php',
                    data: {CATEGORY: id, SITE_ID: "<?=$_POST['SITE_ID']?>"},
                    success: function (data) {
                        // Вывод текста результата отправки
                        $(subcategory).html(data);
                    }
                });
                return false;
            });
            var isAndroid = navigator.userAgent.toLowerCase().indexOf("android") > -1;
            if (isAndroid) {
                $('.form-select').select2(
                    {
                        minimumResultsForSearch: -1
                    }
                );
            }else{
                $('.form-select').select2();
            }
        })
    </script>

        <?}?>
<? }elseif($_POST['CATEGORY']==""){?>
<div class="form-select-box">
    <input type="text"  class="form-control" readonly placeholder="<?=GetMessage("CT_BIEAF_PROPERTY_VALUE_NON_SUBCATEGORY_".$_POST['SITE_ID']);?>">
</div>
<?}?>
