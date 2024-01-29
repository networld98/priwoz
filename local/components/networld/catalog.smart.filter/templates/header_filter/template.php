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
?>
<form <? if ($APPLICATION->GetCurPage() != "/"): ?>id="search-box"<? endif; ?>
      name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      <? if ($APPLICATION->GetCurPage() != "/"): ?>id="search-box" class="collapsed-content search-box"<? endif; ?>>
    <? if ($APPLICATION->GetCurPage() == "/"): ?>
    <div class="search-box">
        <? endif; ?>
        <? $APPLICATION->IncludeComponent(
	"networld:search.title", 
	"custom", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "RETAIL",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"PAGE" => "#SITE_DIR#search/",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "10",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"CATEGORY_0_TITLE" => "Обьявления",
		"CATEGORY_0" => array(
			0 => "iblock_ads",
			1 => "iblock_companies",
		),
		"CATEGORY_0_iblock_news" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_content" => array(
			0 => "all",
		),
		"COMPONENT_TEMPLATE" => "custom",
		"CATEGORY_0_iblock_ads" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_companies" => array(
			0 => "all",
		)
	),
	false
); ?>
        <?
        //prices
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            $key = $arItem["ENCODED_ID"];
            if (isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    continue;
                ?>
                <div class="form-label">
                    <span class="bx_filter_container_modef"></span>
                    <!--						<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">-->
                    <?//=$arItem["NAME"]
                    ?><!--</div>-->
                    <div class="bx_filter_block">
                        <div class="bx_filter_parameters_box_container">
                            <div class="bx_filter_parameters_box_container_block">
                                <div class="bx_filter_input_container">
                                    <input
                                            class="min-price"
                                            type="text"
                                            name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                            id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                            value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                            <div class="bx_filter_parameters_box_container_block">
                                <div class="bx_filter_input_container">
                                    <input
                                            class="max-price"
                                            type="text"
                                            name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                            id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                            value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>

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
            if ($arItem["ID"] == 529) {
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
                <div class="form-label">
                    <span class="bx_filter_container_modef"></span>
                    <!--					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">-->
                    <?//=$arItem["NAME"]
                    ?><!--</div>-->
                    <div class="bx_filter_block">
                        <div class="bx_filter_parameters_box_container">
                            <?
                            $arCur = current($arItem["VALUES"]);
                            switch ($arItem["DISPLAY_TYPE"]) {
                            case "A"://NUMBERS_WITH_SLIDER
                                ?>
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <input
                                                class="min-price"
                                                type="text"
                                                name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this)"
                                        />
                                    </div>
                                </div>
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <input
                                                class="max-price"
                                                type="text"
                                                name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this)"
                                        />
                                    </div>
                                </div>

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
                                        <a class="bx_ui_slider_handle left" style="left:0;" href="javascript:void(0)"
                                           id="left_slider_<?= $key ?>"></a>
                                        <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)"
                                           id="right_slider_<?= $key ?>"></a>
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
                            case "P"://DROPDOWN
                            $checkedItemExist = false;
                            ?>
                                <div class="bx_filter_select_container form-control -location"
                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                    <div class="bx_filter_select_block">
                                        <div class="bx_filter_select_text" data-role="currentOption">
                                            <?
                                            foreach ($arItem["VALUES"] as $val => $ar) {
                                                if ($ar["CHECKED"]) {
                                                    echo $ar["VALUE"];
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
                                        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                            <input
                                                    style="display: none"
                                                    type="radio"
                                                    name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                    id="<?= $ar["CONTROL_ID"] ?>"
                                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                            />
                                        <? endforeach ?>
                                        <div class="bx_filter_select_popup 1" data-role="dropdownContent"
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
                                                               onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?></label>
                                                    </li>
                                                <? endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?
                            break;
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
                                            <?if($ar["HTML_VALUE_ALT"] == $_GET['city_529']) {echo 'selected';}?>>
                                            <?= str_replace(".", "", $ar["VALUE"]); ?>
                                        </option>
                                    <? endforeach; ?>
                                </select>
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
                    </div>
                </div>
                <?
            }
        }
        ?>
        <div class="<? if ($APPLICATION->GetCurPage() != SITE_DIR): ?>btn-box<? else: ?>bx_filter_button_box<? endif; ?>">
            <div class="bx_filter_block">
                <div class="bx_filter_parameters_box_container">
                    <a class="btn btn-search" id="modef"
                       href="<? echo $arResult["FILTER_URL"] ?>"><?= GetMessage("CT_BCSF_SET_FILTER") ?></a>
                </div>
            </div>
        </div>
        <? if ($APPLICATION->GetCurPage() == "/"): ?>
    </div>
<? endif; ?>
</form>
<? if ($APPLICATION->GetCurPage() == SITE_DIR || $APPLICATION->GetCurPage() == SITE_DIR."search/"): ?>
<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'horizontal');
</script>
<? endif; ?>