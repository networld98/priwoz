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
$dbAllSections = CIBlockSection::GetList (
    Array("ID" => "ASC"),
    Array("IBLOCK_ID" => 20),
    false,
    Array('CODE','IBLOCK_SECTION_ID')
);
while($arElement = $dbAllSections->GetNext())
{
    $res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"])->GetNext()['CODE'];
    $arAllElements[$arElement['CODE']] = $res;
}
?>
<div class="collapse-head filter-box-opener" data-collapsed="#smartFilterAds">Фильтры поиска <span class="arrow"></span></div>
<div class="bx_filter <?= $templateData["TEMPLATE_CLASS"] ?> bx_horizontal collapsed-content " id="smartFilterAds">
    <div class="bx_filter_section" id="smartFilterAds-block">
        <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
              method="get" class="smartfilter">
            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <?endforeach;
            //prices
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                $key = $arItem["ENCODED_ID"];
                if (isset($arItem["PRICE"])):
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;
                    ?>
                    <div class="bx_filter_parameters_box active">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title"><?= $arItem["NAME"] ?></div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <label class="form-label -min-max-label">
                                            <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </label>
                                    </div>
                                </div>
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <label class="form-label -min-max-label">
                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                        </label>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>

                                <div class="bx_ui_slider_track" id="drag_track_<?= $key ?>">
                                    <?
                                    $price1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                    $price2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4);
                                    $price3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 2);
                                    $price4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) * 3) / 4);
                                    $price5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                    ?>
                                    <div class="bx_ui_slider_part p1"><span><?= $price1 ?></span></div>
                                    <div class="bx_ui_slider_part p2"><span><?= $price2 ?></span></div>
                                    <div class="bx_ui_slider_part p3"><span><?= $price3 ?></span></div>
                                    <div class="bx_ui_slider_part p4"><span><?= $price4 ?></span></div>
                                    <div class="bx_ui_slider_part p5"><span><?= $price5 ?></span></div>

                                    <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;"
                                         id="colorUnavailableActive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;"
                                         id="colorAvailableInactive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_pricebar_V" style="left: 0;right: 0;"
                                         id="colorAvailableActive_<?= $key ?>"></div>
                                    <div class="bx_ui_slider_range" id="drag_tracker_<?= $key ?>"
                                         style="left: 0%; right: 0%;">
                                        <a class="bx_ui_slider_handle left" style="left:0;" href="javascript:void(0)"
                                           id="left_slider_<?= $key ?>"></a>
                                        <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)"
                                           id="right_slider_<?= $key ?>"></a>
                                    </div>
                                </div>
                                <div style="opacity: 0;height: 1px;"></div>
                            </div>
                        </div>
                    </div>
                <?
                $precision = 2;
                if (Bitrix\Main\Loader::includeModule("currency")) {
                    $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                    $precision = $res['DECIMALS'];
                }
                $arJsParams = array(
                    "leftSlider" => 'left_slider_' . $key,
                    "rightSlider" => 'right_slider_' . $key,
                    "tracker" => "drag_tracker_" . $key,
                    "trackerWrap" => "drag_track_" . $key,
                    "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                    "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                    "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                    "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                    "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                    "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                    "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                    "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                    "precision" => $precision,
                    "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                    "colorAvailableActive" => 'colorAvailableActive_' . $key,
                    "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                );
                ?>
                    <script type="text/javascript">
                        BX.ready(function () {
                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                        });
                    </script>
                <?endif;
            }

            //not prices
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                if ($arItem["ID"] != 529) {
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
                    <div class="bx_filter_parameters_box <? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>active<?endif ?>">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title"><?= $arItem["NAME"] ?></div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <?
                                $arCur = current($arItem["VALUES"]);
                                switch ($arItem["DISPLAY_TYPE"]) {
                                case "A"://NUMBERS_WITH_SLIDER
                                    ?>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <label class="form-label -min-max-label">
                                            <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <label class="form-label -min-max-label">
                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                                <label class="form-label -min-max-label">
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>

                                    <div class="bx_ui_slider_track" id="drag_track_<?= $key ?>">
                                        <?
                                        $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                        $value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4);
                                        $value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 2);
                                        $value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) * 3) / 4);
                                        $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                        ?>
                                        <div class="bx_ui_slider_part p1"><span><?= $value1 ?></span></div>
                                        <div class="bx_ui_slider_part p2"><span><?= $value2 ?></span></div>
                                        <div class="bx_ui_slider_part p3"><span><?= $value3 ?></span></div>
                                        <div class="bx_ui_slider_part p4"><span><?= $value4 ?></span></div>
                                        <div class="bx_ui_slider_part p5"><span><?= $value5 ?></span></div>

                                        <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;"
                                             id="colorUnavailableActive_<?= $key ?>"></div>
                                        <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;"
                                             id="colorAvailableInactive_<?= $key ?>"></div>
                                        <div class="bx_ui_slider_pricebar_V" style="left: 0;right: 0;"
                                             id="colorAvailableActive_<?= $key ?>"></div>
                                        <div class="bx_ui_slider_range" id="drag_tracker_<?= $key ?>"
                                             style="left: 0;right: 0;">
                                            <a class="bx_ui_slider_handle left" style="left:0;"
                                               href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                            <a class="bx_ui_slider_handle right" style="right:0;"
                                               href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                        </div>
                                    </div>
                                <?
                                $arJsParams = array(
                                    "leftSlider" => 'left_slider_' . $key,
                                    "rightSlider" => 'right_slider_' . $key,
                                    "tracker" => "drag_tracker_" . $key,
                                    "trackerWrap" => "drag_track_" . $key,
                                    "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                    "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                    "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                    "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                    "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                    "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                    "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                                    "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                    "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                                    "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                                    "colorAvailableActive" => 'colorAvailableActive_' . $key,
                                    "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                                );
                                ?>
                                    <script type="text/javascript">
                                        BX.ready(function () {
                                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                        });
                                    </script>
                                <?
                                break;
                                case "B"://NUMBERS
                                ?>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <label class="form-label -min-max-label">
                                                <?=GetMessage('CT_BCSF_FILTER_FROM')?>:
                                                <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <label class="form-label -min-max-label">
                                                <?=GetMessage('CT_BCSF_FILTER_TO')?>:
                                            <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                    id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                    value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                            />
                                            </label>
                                        </div>
                                    </div>
                                <?
                                break;
                                case "G"://CHECKBOXES_WITH_PICTURES
                                ?>
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                <input
                                        style="display: none"
                                        type="checkbox"
                                        name="<?= $ar["CONTROL_NAME"] ?>"
                                        id="<?= $ar["CONTROL_ID"] ?>"
                                        value="<?= $ar["HTML_VALUE"] ?>"
                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                />
                                    <?
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class .= " active";
                                    if ($ar["DISABLED"])
                                        $class .= " disabled";
                                    ?>
                                    <label for="<?= $ar["CONTROL_ID"] ?>" data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx_filter_param_label dib<?= $class ?>"
                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon"
                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                            <?endif ?>
										</span>
                                    </label>
                                <?endforeach ?>
                                <?
                                break;
                                case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                ?>
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                <input
                                        style="display: none"
                                        type="checkbox"
                                        name="<?= $ar["CONTROL_NAME"] ?>"
                                        id="<?= $ar["CONTROL_ID"] ?>"
                                        value="<?= $ar["HTML_VALUE"] ?>"
                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                />
                                    <?
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class .= " active";
                                    if ($ar["DISABLED"])
                                        $class .= " disabled";
                                    ?>
                                    <label for="<?= $ar["CONTROL_ID"] ?>" data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx_filter_param_label<?= $class ?>"
                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon"
                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                            <?endif ?>
										</span>
                                        <span class="bx_filter_param_text"
                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?> (<span
                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                            endif; ?></span>
                                    </label>
                                <?endforeach ?>
                                <?
                                break;
                                case "P"://DROPDOWN
                                $checkedItemExist = false;
                                ?>
                                    <div class="bx_filter_select_container">
                                        <div class="bx_filter_select_block"
                                             onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                            <div class="bx_filter_select_text arrFilter_<?= CUtil::JSEscape($key) ?>"
                                                 data-role="currentOption">
                                                <?
                                                foreach ($arItem["VALUES"] as $val => $ar) {
                                                    if ($ar["CHECKED"]) {
                                                        echo trim($ar["VALUE"], " \t.");
                                                        $checkedItemExist = true;
                                                    }
                                                }
                                                if (!$checkedItemExist) {
                                                    echo GetMessage("CT_BCSF_FILTER_ALL");
                                                }
                                                ?>
                                            </div>
                                            <div class="bx_filter_select_arrow"></div>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                    value=""
                                            />
                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                <input
                                                        style="display: none"
                                                        type="radio"
                                                        name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                        id="<?= $ar["CONTROL_ID"] ?>"
                                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                />
                                            <?endforeach ?>
                                            <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                 style="display: none;">
                                                <ul>
                                                    <li>
                                                        <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                               class="bx_filter_param_label"
                                                               data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                            <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                        </label>
                                                    </li>
                                                    <?
                                                    foreach ($arItem["VALUES"] as $val => $ar):
                                                        $class = "";
                                                        if ($ar["CHECKED"])
                                                            $class .= " selected";
                                                        if ($ar["DISABLED"])
                                                            $class .= " disabled";
                                                        ?>
                                                        <li>
                                                            <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                   class="bx_filter_param_label<?= $class ?>"
                                                                   data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                   onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= trim($ar["VALUE"], " \t.") ?></label>
                                                        </li>
                                                    <?endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                break;
                                case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                                ?>
                                    <div class="bx_filter_select_container">
                                        <div class="bx_filter_select_block"
                                             onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                            <div class="bx_filter_select_text" data-role="currentOption">
                                                <?
                                                $checkedItemExist = false;
                                                foreach ($arItem["VALUES"] as $val => $ar):
                                                    if ($ar["CHECKED"]) {
                                                        ?>
                                                        <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                            <span class="bx_filter_btn_color_icon"
                                                                  style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                        <?endif ?>
                                                        <span class="bx_filter_param_text">
														<?= $ar["VALUE"] ?>
													</span>
                                                        <?
                                                        $checkedItemExist = true;
                                                    }
                                                endforeach;
                                                if (!$checkedItemExist) {
                                                    ?><span class="bx_filter_btn_color_icon all"></span> <?
                                                    echo GetMessage("CT_BCSF_FILTER_ALL");
                                                }
                                                ?>
                                            </div>
                                            <div class="bx_filter_select_arrow"></div>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                    value=""
                                            />
                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                <input
                                                        style="display: none"
                                                        type="radio"
                                                        name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                        id="<?= $ar["CONTROL_ID"] ?>"
                                                        value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                />
                                            <?endforeach ?>
                                            <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                 style="display: none">
                                                <ul>
                                                    <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                        <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                               class="bx_filter_param_label"
                                                               data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                            <span class="bx_filter_btn_color_icon all"></span>
                                                            <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                        </label>
                                                    </li>
                                                    <?
                                                    foreach ($arItem["VALUES"] as $val => $ar):
                                                        $class = "";
                                                        if ($ar["CHECKED"])
                                                            $class .= " selected";
                                                        if ($ar["DISABLED"])
                                                            $class .= " disabled";
                                                        ?>
                                                        <li>
                                                            <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                   data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                   class="bx_filter_param_label<?= $class ?>"
                                                                   onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')">
                                                                <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                    <span class="bx_filter_btn_color_icon"
                                                                          style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                                <?endif ?>
                                                                <span class="bx_filter_param_text">
															<?= $ar["VALUE"] ?>
														</span>
                                                            </label>
                                                        </li>
                                                    <?endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?
                                break;
                                case "K"://RADIO_BUTTONS
                                ?>
                                    <div class="form-label">
                                        <select class="form-select -without-search"
                                                name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                onChange="smartFilter.click(this)"
                                                id="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
                                            <option
                                                    data-count="<? echo $ar["ELEMENT_COUNT"]; ?>"
                                                    value=""
                                                    data-name="Все"
                                                    name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'selected' : '' ?>>
                                                <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                            </option>

                                            <? foreach ($arItem["VALUES"] as $val => $ar):
                                                if($ar['SECTION']) {
                                                    if(CUtil::JSEscape($key)=='571') {
                                                        $iblockSectionId = CIBlockSection::GetByID($ar['SECTION'])->GetNext()['IBLOCK_SECTION_ID'];
                                                    }elseif(CUtil::JSEscape($key)=='528'){
                                                        $iblockSectionId = CIBlockElement::GetByID($ar['SECTION'])->GetNextElement()->GetFields()['IBLOCK_SECTION_ID'];
                                                    }
                                                }
                                                if(SITE_ID=='ua'){
                                                    if(CUtil::JSEscape($key)=='527' || CUtil::JSEscape($key)=='571') {
                                                        $ar["VALUE"] = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 20, 'ID' => $ar["SECTION"]), false, array('UF_NAME_UA'))->GetNext()['UF_NAME_UA'];
                                                    }elseif(CUtil::JSEscape($key)=='528'|| CUtil::JSEscape($key)=='526') {
                                                        $ar["VALUE"] = CIBlockElement::GetByID($ar["SECTION"])->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                                                    }
                                                }?>
                                                <option
                                                        <?if(CUtil::JSEscape($key)=='528'){
                                                            if($ar['SECTION']) {
                                                                $iblockSectionId = CIBlockElement::GetByID($ar['SECTION'])->GetNextElement()->GetFields()['IBLOCK_SECTION_ID'];
                                                            }?>
                                                            class="subcategory"
                                                        <?}?>
                                                        <?if(CUtil::JSEscape($key)=='571'){?>
                                                            class="betcategory"
                                                        <?}?>
                                                        data-count="<? echo $ar["ELEMENT_COUNT"]; ?>"
                                                        data-id-element="<? echo $ar['SECTION']; ?>"
                                                        data-id-section="<? echo $iblockSectionId; ?>"
                                                        data-section="<?=$arAllElements[$ar["URL_ID"]]?>"
                                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                        data-name="<?= str_replace(".", "", $ar["VALUE"]); ?>"
                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                    <? echo $ar["CHECKED"] ? 'selected' : '' ?>>
                                                    <?= str_replace(".", "", $ar["VALUE"]); ?>
                                                </option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                <?
                                break;
                                case "U"://CALENDAR
                                ?>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container bx_filter_calendar_container">
                                            <? $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                    'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                                    'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container bx_filter_calendar_container">
                                            <? $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                    'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                                    'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            ); ?>
                                        </div>
                                    </div>
                                <?
                                break;
                                default://CHECKBOXES
                                ?>
                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx_filter_param_label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                           for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox">
											<input
                                                    type="checkbox"
                                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
												onclick="smartFilter.click(this)"
                                            />
											<span class="bx_filter_param_text"
                                                  title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                    ?> (<span
                                                        data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                endif; ?></span>
										</span>
                                    </label>
                                <?endforeach;
                                    ?>
                                <?
                                }
                                ?>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                <?
                }
            }
            ?>
        </form>
    </div>
</div>
<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'horizontal');
</script>