<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Обьявление");
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?$APPLICATION->IncludeComponent(
                "networld:catalog.smart.filter",
                "visual_horizontal",
                array(
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => "visual_horizontal",
                    "CONVERT_CURRENCY" => "N",
                    "DISPLAY_ELEMENT_COUNT" => "N",
                    "FILTER_NAME" => "arrFilter",
                    "PREFILTER_NAME" => "smartPreFilter",
                    "FILTER_VIEW_MODE" => "vertical",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "IBLOCK_TYPE" => "ads",
                    "IBLOCK_ID" => "19",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "SAVE_IN_SESSION" => "N",
                    "SECTION_CODE" => "search",
                    "SECTION_DESCRIPTION" => "-",
                    "SECTION_ID" => "",
                    "SECTION_TITLE" => "-",
                    "SEF_MODE" => "Y",
                    "TEMPLATE_THEME" => "blue",
                    "XML_EXPORT" => "N",
                    "POPUP_POSITION" => "left",
                    "NOT_FILTER" => "N",
                    "SEF_RULE" => "#SMART_FILTER_PATH#",
                    "SECTION_CODE_PATH" => "",
                    "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
                    "PRICE_CODE" => array(
                    ),
                ),
                $component
            );
            ?>
            <?$APPLICATION->IncludeComponent("bitrix:search.page","tags",Array(
                    "TAGS_SORT" => "NAME",
                    "TAGS_PAGE_ELEMENTS" => "150",
                    "TAGS_PERIOD" => "30",
                    "TAGS_URL_SEARCH" => "/search/index.php",
                    "TAGS_INHERIT" => "Y",
                    "FONT_MAX" => "50",
                    "FONT_MIN" => "10",
                    "COLOR_NEW" => "000000",
                    "COLOR_OLD" => "C8C8C8",
                    "PERIOD_NEW_TAGS" => "",
                    "SHOW_CHAIN" => "Y",
                    "COLOR_TYPE" => "Y",
                    "WIDTH" => "100%",
                    "USE_SUGGEST" => "Y",
                    "SHOW_RATING" => "Y",
                    "PATH_TO_USER_PROFILE" => "",
                    "AJAX_MODE" => "N",
                    "RESTART" => "Y",
                    "NO_WORD_LOGIC" => "N",
                    "USE_LANGUAGE_GUESS" => "Y",
                    "CHECK_DATES" => "Y",
                    "USE_TITLE_RANK" => "Y",
                    "DEFAULT_SORT" => "rank",
                    "FILTER_NAME" => "arrFilter",
                    "arrFILTER" => array("no"),
                    "SHOW_WHERE" => "Y",
                    "arrWHERE" => array(),
                    "SHOW_WHEN" => "Y",
                    "PAGE_RESULT_COUNT" => "50",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "DISPLAY_TOP_PAGER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Результаты поиска",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "AJAX_OPTION_SHADOW" => "Y",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => ""
                )
            );?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>