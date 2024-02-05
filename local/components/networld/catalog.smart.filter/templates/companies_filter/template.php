<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);
$arSelect1 = array('CODE','IBLOCK_SECTION_ID');
$arFilter1 = array("IBLOCK_ID" => 20, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$dbAllElements = CIBlockElement::GetList(array(), $arFilter1, false, false, $arSelect1);
while ($arElement = $dbAllElements->Fetch()) {
    $res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"])->GetNext()['CODE'];
    $arAllElements[$arElement['CODE']] = $res;
}
?>
 <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get">
            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <?endforeach;

            //not prices
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                if ($arItem["ID"] != 529 && $arItem["ID"] != 546 && $arItem["ID"] != 547) {
                    if (
                        empty($arItem["VALUES"])
                        || isset($arItem["PRICE"])
                    )
                        continue;

                    if (
                        $arItem["DISPLAY_TYPE"] == "A"
                        && (
                            $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                        )
                    )
                        continue;
                    ?>
                    <label class="form-label d-xs-none d-xl-flex">
                                <?
                                $arCur = current($arItem["VALUES"]);
                                switch ($arItem["DISPLAY_TYPE"]) {
                                case "K"://RADIO_BUTTONS
                                ?>
                                    <select class="form-select <? if ($APPLICATION->GetCurPage() == "/"): ?>-location<? else: ?>-simple-location<?endif; ?> "
                                            name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                            onChange="smartFilter.click(this)"
                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
                                        <option value=""
                                                name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
                                            <span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                        </option>
                                        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                            <option value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <?if($ar["HTML_VALUE_ALT"] == $_GET['category_529']) {echo 'selected';}?>>
                                                <?= str_replace(".", "", $ar["VALUE"]); ?>
                                            </option>
                                        <? endforeach; ?>
                                    </select>
                                <?
                                break;
                                ?>
                                <?
                                }
                                ?>
                                </label>
                <?
                }
            }
            ?>
        </form>
<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'horizontal');
</script>