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
    <section class="products-overview-section">
        <div class="container">
            <div class="title-box">
                <h1 class="page-title">Доска объявлений</h1>
                <a href="/personal/announcement/" class="btn btn-orange d-xs-none d-xl-inline-flex">Добавить объявление</a>
            </div>
            <div class="collapse-head search-box-opener" data-collapsed="#search-box">Поиск на доске объявлений <span class="arrow"></span></div>
            <form id="search-box" class="collapsed-content search-box">
                <label class="form-label">
                    <input type="text" class="form-control form-control-filter -search"
                           placeholder="Шо найти на Priwoze">
                </label>
                <label class="form-label">
                    <input type="text" class="form-control form-control-filter -location"
                           placeholder="Болгария, область">
                </label>
                <div class="btn-box">
                    <input type="submit" class="btn btn-search" value="Поиск">
                </div>
            </form>
            <? if ($arParams["USE_FILTER"] == "Y"): ?>
                <? $APPLICATION->IncludeComponent(
                    "networld:catalog.smart.filter",
                    "ads_filter",
                    array(
                        "INSTANT_RELOAD" => "Y",
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PREFILTER_NAME" => "smartPreFilter",
                        "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
                        "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    ),
                    $component
                );
                ?>
            <? endif ?>
            <div class="collapse-head filter-box-opener" data-collapsed="#filter-box">Фильтры поиска <span class="arrow"></span></div>
            <div id="filter-box" class="collapsed-content bx_filter">
                <div class="bx_filter_section">
                    <form class="smartfilter">
                        <div class="bx_filter_parameters_box active">
                            <span class="bx_filter_container_modef"></span>
                            <div class="bx_filter_parameters_box_title">Категория</div>
                            <div class="bx_filter_block">
                                <div class="bx_filter_parameters_box_container">
                                    <div class="bx_filter_select_container">
                                        <div class="bx_filter_select_block"
                                             onclick="smartFilter.showDropDownPopup(this, '527')">
                                            <div class="bx_filter_select_text" data-role="currentOption">
                                                Все
                                            </div>
                                            <div class="bx_filter_select_arrow"></div>
                                            <input style="display: none" type="radio" name="arrFilter_527"
                                                   id="all_arrFilter_527_2157551989" value="">
                                            <input style="display: none" type="radio" name="arrFilter_527"
                                                   id="arrFilter_527_2157551989" value="avto">
                                            <input style="display: none" type="radio" name="arrFilter_527"
                                                   id="arrFilter_527_4264091080" value="eda">

                                        </div>
                                    </div>
                                </div>
                                <div class="clb"></div>
                            </div>
                        </div>
                        <div class="bx_filter_parameters_box active">
                            <span class="bx_filter_container_modef"></span>
                            <div class="bx_filter_parameters_box_title">Подкатегория</div>
                            <div class="bx_filter_block">
                                <div class="bx_filter_parameters_box_container">
                                    <div class="bx_filter_select_container">
                                        <div class="bx_filter_select_block"
                                             onclick="smartFilter.showDropDownPopup(this, '528')">
                                            <div class="bx_filter_select_text" data-role="currentOption">
                                                Все
                                            </div>
                                            <div class="bx_filter_select_arrow"></div>
                                            <input style="display: none" type="radio" name="arrFilter_528"
                                                   id="all_arrFilter_528_1600042024" value="">
                                            <input style="display: none" type="radio" name="arrFilter_528"
                                                   id="arrFilter_528_1600042024" value="prodazha-avto">
                                            <input style="display: none" type="radio" name="arrFilter_528"
                                                   id="arrFilter_528_3505443437" value="test">
                                            <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                 style="display: none;">
                                                <ul>
                                                    <li>
                                                        <label for="all_arrFilter_528_1600042024"
                                                               class="bx_filter_param_label"
                                                               data-role="label_all_arrFilter_528_1600042024"
                                                               onclick="smartFilter.selectDropDownItem(this, 'all_arrFilter_528_1600042024')">
                                                            Все </label>
                                                    </li>
                                                    <li>
                                                        <label for="arrFilter_528_1600042024"
                                                               class="bx_filter_param_label"
                                                               data-role="label_arrFilter_528_1600042024"
                                                               onclick="smartFilter.selectDropDownItem(this, 'arrFilter_528_1600042024')">Продажа
                                                            авто</label>
                                                    </li>
                                                    <li>
                                                        <label for="arrFilter_528_3505443437"
                                                               class="bx_filter_param_label"
                                                               data-role="label_arrFilter_528_3505443437"
                                                               onclick="smartFilter.selectDropDownItem(this, 'arrFilter_528_3505443437')">Тест</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clb"></div>
                            </div>
                        </div>
                        <div class="bx_filter_parameters_box active">
                            <span class="bx_filter_container_modef"></span>
                            <div class="bx_filter_parameters_box_title">Стоимость</div>
                            <div class="bx_filter_block">
                                <div class="bx_filter_parameters_box_container">
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <input class="min-price" type="text" name="arrFilter_525_MIN"
                                                   id="arrFilter_525_MIN" value="" size="5"
                                                   onkeyup="smartFilter.keyup(this)" placeholder="от:">
                                        </div>
                                    </div>
                                    <div class="bx_filter_parameters_box_container_block">
                                        <div class="bx_filter_input_container">
                                            <input class="max-price" type="text" name="arrFilter_525_MAX"
                                                   id="arrFilter_525_MAX" value="" size="5"
                                                   onkeyup="smartFilter.keyup(this)" placeholder="до:">
                                        </div>
                                    </div>
                                </div>
                                <div class="clb"></div>
                            </div>
                        </div>
                        <div class="bx_filter_parameters_box active">
                            <span class="bx_filter_container_modef"></span>
                            <div class="bx_filter_parameters_box_title">Состояние</div>
                            <div class="bx_filter_block">
                                <div class="bx_filter_parameters_box_container">
                                    <div class="bx_filter_select_container">
                                        <div class="bx_filter_select_block"
                                             onclick="smartFilter.showDropDownPopup(this, '526')">
                                            <div class="bx_filter_select_text" data-role="currentOption">
                                                Все
                                            </div>
                                            <div class="bx_filter_select_arrow"></div>
                                            <input style="display: none" type="radio" name="arrFilter_526"
                                                   id="all_arrFilter_526_3057455389" value="">
                                            <input style="display: none" type="radio" name="arrFilter_526"
                                                   id="arrFilter_526_3057455389" value="bu">
                                            <input style="display: none" type="radio" name="arrFilter_526"
                                                   id="arrFilter_526_791953575" value="novoe">
                                            <div class="bx_filter_select_popup" data-role="dropdownContent"
                                                 style="display: none;">
                                                <ul>
                                                    <li>
                                                        <label for="all_arrFilter_526_3057455389"
                                                               class="bx_filter_param_label"
                                                               data-role="label_all_arrFilter_526_3057455389"
                                                               onclick="smartFilter.selectDropDownItem(this, 'all_arrFilter_526_3057455389')">
                                                            Все </label>
                                                    </li>
                                                    <li>
                                                        <label for="arrFilter_526_3057455389"
                                                               class="bx_filter_param_label"
                                                               data-role="label_arrFilter_526_3057455389"
                                                               onclick="smartFilter.selectDropDownItem(this, 'arrFilter_526_3057455389')">Б/у</label>
                                                    </li>
                                                    <li>
                                                        <label for="arrFilter_526_791953575"
                                                               class="bx_filter_param_label"
                                                               data-role="label_arrFilter_526_791953575"
                                                               onclick="smartFilter.selectDropDownItem(this, 'arrFilter_526_791953575')">Новое</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clb"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-overlay">
            <div class="container">

                <div class="advertisement advertisement-type-3">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "BS_ARROW_NAV" => "N",
                            "BS_BULLET_NAV" => "Y",
                            "BS_CYCLING" => "N",
                            "BS_EFFECT" => "fade",
                            "BS_HIDE_FOR_PHONES" => "Y",
                            "BS_HIDE_FOR_TABLETS" => "N",
                            "BS_KEYBOARD" => "Y",
                            "BS_PAUSE" => "Y",
                            "BS_WRAP" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COMPONENT_TEMPLATE" => "",
                            "NOINDEX" => "Y",
                            "QUANTITY" => "5",
                            "TYPE" => "asdpage"
                        )
                    );?>
                </div>
        <? if ($_GET['userAds'] != NULL && $_GET['companisAds'] != NULL) { ?>
            <? if ($arParams["USE_RSS"] == "Y"): ?>
                <?
                if (method_exists($APPLICATION, 'addheadstring'))
                    $APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" href="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" />');
                ?>
            <? endif ?>
        <? } elseif ($_GET['userAds']) {
            global $arrFilter;
            $arrFilter = array("PROPERTY_NAME" => $_GET['userAds']);
        } elseif ($_GET['companisAds']) {
            global $arrFilter;
            $arrFilter = array("PROPERTY_NAME" => $_GET['companisAds']);
        } ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "ads",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "NEWS_COUNT" => $arParams["NEWS_COUNT"],

                "SORT_BY1" => $arParams["SORT_BY1"],
                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                "SORT_BY2" => $arParams["SORT_BY2"],
                "SORT_ORDER2" => $arParams["SORT_ORDER2"],

                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "SEARCH_PAGE" => ($arParams["USE_SEARCH"] == "Y" ? $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"] : ''),

                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

                "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "MESSAGE_404" => $arParams["MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",

                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                "MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
                "SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],

                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                "USE_RATING" => $arParams["USE_RATING"],
                "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                "MAX_VOTE" => $arParams["MAX_VOTE"],
                "VOTE_NAMES" => $arParams["VOTE_NAMES"],

                "USE_SHARE" => $arParams["LIST_USE_SHARE"],
                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
            ),
            $component
        ); ?>
    </div>
</section>