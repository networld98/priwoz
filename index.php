<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Priwoz.info");
?>
    <section class="products-section">
        <div class="container">
            <div class="advertisement-slider swiper-container">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "includes/odessa-main-slider.php"
                    )
                );
                ?>
            </div>
            <?
            global $arrFilter;
            $arrFilter = array("!PROPERTY_MODERATION_VALUE" => "Y");
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "ads",
                array(
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "CHECK_DATES" => "N",
                    "COMPONENT_TEMPLATE" => "ads",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "PRICE",
                        1 => "CONDITION",
                        2 => "PHOTOS",
                        3 => "AUTHOR",
                        4 => "PHONE",
                        5 => "DOPPHONE",
                        6 => "CITY",
                        7 => "TELEGRAM",
                        8 => "VIBER",
                        9 => "WHATSAPP",
                        10 => "CATEGORY",
                        11 => "SUBCATEGORY",
                        12 => "CURRENCY",
                    ),
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_TYPE" => "ads",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "PRICE",
                        1 => "CONDITION",
                        2 => "PHOTOS",
                        3 => "AUTHOR",
                        4 => "PHONE",
                        5 => "DOPPHONE",
                        6 => "CITY",
                        7 => "TELEGRAM",
                        8 => "VIBER",
                        9 => "WHATSAPP",
                        10 => "CATEGORY",
                        11 => "SUBCATEGORY",
                        12 => "CURRENCY",
                    ),
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "NEWS_COUNT" => "9",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "show_more_main_ads",
                    "PAGER_TITLE" => "Новости",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SEF_FOLDER" => "/",
                    "SEF_MODE" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "Y",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "USE_PERMISSIONS" => "N",
                    "USE_RATING" => "N",
                    "USE_REVIEW" => "N",
                    "USE_RSS" => "N",
                    "USE_SEARCH" => "N",
                    "USE_SHARE" => "N",
                    "FILTER_NAME" => "arrFilter",
                    "FILTER_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                        2 => "",
                        3 => "",
                        4 => "",
                        5 => "",
                    ),
                    "IBLOCK_ID" => "19",
                    "FILE_404" => "",
                    "SHARE_HIDE" => "N",
                    "SHARE_TEMPLATE" => "",
                    "SHARE_HANDLERS" => array(
                        0 => "twitter",
                        1 => "lj",
                        2 => "mailru",
                        3 => "vk",
                        4 => "delicious",
                        5 => "facebook",
                    ),
                    "SHARE_SHORTEN_URL_LOGIN" => "",
                    "SHARE_SHORTEN_URL_KEY" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "PRICE",
                        1 => "AUTHOR",
                        2 => "PHONE",
                        3 => "DOPPHONE",
                        4 => "TELEGRAM",
                        5 => "VIBER",
                        6 => "WHATSAPP",
                        7 => "CITY",
                        8 => "",
                    ),
                    "TEMPLATE_THEME" => "blue",
                    "DETAIL_URL" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MEDIA_PROPERTY" => "",
                    "SLIDER_PROPERTY" => "",
                    "SEARCH_PAGE" => "/search/"
                ),
                false
            ); ?>
            <div class="advertisement-slider swiper-container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "slider-main-big",
                    array(
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
                        "TYPE" => "mainpage"
                    )
                ); ?>
            </div>
        </div>
    </section>
    <section class="companies-section">
        <div class="container">
            <div class="section-title">Компании наших в Болгарии</div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "companies",
                array(
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "CHECK_DATES" => "N",
                    "COMPONENT_TEMPLATE" => "companies",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_TYPE" => "ads",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "NEWS_COUNT" => "10",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "show_more_main_companies",
                    "PAGER_TITLE" => "Новости",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SEF_FOLDER" => "/",
                    "SEF_MODE" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "Y",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "USE_PERMISSIONS" => "N",
                    "USE_RATING" => "N",
                    "USE_REVIEW" => "N",
                    "USE_RSS" => "N",
                    "USE_SEARCH" => "N",
                    "USE_SHARE" => "Y",
                    "FILTER_NAME" => "arrFilter",
                    "FILTER_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                        2 => "",
                        3 => "",
                        4 => "",
                        5 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "TELEGRAM",
                        1 => "VIBER",
                        2 => "WHATSAPP",
                        3 => "AUTHOR",
                        4 => "PHONE",
                        5 => "LOGO",
                        6 => "DOPPHONE",
                        7 => "CITY",
                        8 => "CATEGORY",
                        9 => "SUBCATEGORY",
                    ),
                    "IBLOCK_ID" => "24",
                    "FILE_404" => "",
                    "SHARE_HIDE" => "N",
                    "SHARE_TEMPLATE" => "",
                    "SHARE_HANDLERS" => array(
                        0 => "twitter",
                        1 => "lj",
                        2 => "mailru",
                        3 => "vk",
                        4 => "delicious",
                        5 => "facebook",
                    ),
                    "SHARE_SHORTEN_URL_LOGIN" => "",
                    "SHARE_SHORTEN_URL_KEY" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "TEMPLATE_THEME" => "blue",
                    "DETAIL_URL" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MEDIA_PROPERTY" => "",
                    "SLIDER_PROPERTY" => "",
                    "SEARCH_PAGE" => "/search/"
                ),
                false
            ); ?>
        </div>
    </section>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "includes/partnership-section.php"
    )
); ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "includes/about-section.php"
    )
); ?>
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-xl-3">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "includes/blog-section.php"
                        )
                    ); ?>
                </div>
                <div class="col-xs-12 col-md-8 col-xl-9">
                    <div class="blog-posts">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "blog",
                            array(
                                "ADD_ELEMENT_CHAIN" => "Y",
                                "ADD_SECTIONS_CHAIN" => "Y",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "BROWSER_TITLE" => "-",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "N",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "N",
                                "CHECK_DATES" => "N",
                                "COMPONENT_TEMPLATE" => "blog",
                                "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                "DETAIL_FIELD_CODE" => array(
                                    0 => "YOUTUBE",
                                    1 => "COMPANY",
                                    2 => "YOUTUBE_IN_MAIN",
                                ),
                                "DETAIL_PAGER_SHOW_ALL" => "Y",
                                "DETAIL_PAGER_TEMPLATE" => "",
                                "DETAIL_PAGER_TITLE" => "Страница",
                                "DETAIL_PROPERTY_CODE" => array(
                                    0 => "YOUTUBE",
                                    1 => "COMPANY",
                                    2 => "YOUTUBE_IN_MAIN",
                                ),
                                "DETAIL_SET_CANONICAL_URL" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                "IBLOCK_TYPE" => "ads",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "LIST_FIELD_CODE" => array(
                                    0 => "YOUTUBE",
                                    1 => "COMPANY",
                                    2 => "YOUTUBE_IN_MAIN",
                                ),
                                "LIST_PROPERTY_CODE" => array(
                                    0 => "YOUTUBE",
                                    1 => "COMPANY",
                                    2 => "YOUTUBE_IN_MAIN",
                                ),
                                "MESSAGE_404" => "",
                                "META_DESCRIPTION" => "-",
                                "META_KEYWORDS" => "-",
                                "NEWS_COUNT" => "3",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "arrows",
                                "PAGER_TITLE" => "Новости",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "SEF_FOLDER" => "/blog/",
                                "SEF_MODE" => "Y",
                                "SET_LAST_MODIFIED" => "Y",
                                "SET_STATUS_404" => "Y",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "Y",
                                "SORT_BY1" => "ACTIVE_FROM",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER1" => "DESC",
                                "SORT_ORDER2" => "ASC",
                                "STRICT_SECTION_CHECK" => "N",
                                "USE_CATEGORIES" => "N",
                                "USE_FILTER" => "Y",
                                "SHOW_ALL_WO_SECTION" => "Y",
                                "USE_PERMISSIONS" => "N",
                                "USE_RATING" => "N",
                                "USE_REVIEW" => "N",
                                "USE_RSS" => "N",
                                "USE_SEARCH" => "N",
                                "USE_SHARE" => "N",
                                "FILTER_NAME" => "arrFilter",
                                "IBLOCK_ID" => "25",
                                "FILE_404" => "",
                                "SHARE_HIDE" => "N",
                                "SHARE_TEMPLATE" => "",
                                "SHARE_HANDLERS" => array(
                                    0 => "twitter",
                                    1 => "lj",
                                    2 => "mailru",
                                    3 => "vk",
                                    4 => "delicious",
                                    5 => "facebook",
                                ),
                                "SHARE_SHORTEN_URL_LOGIN" => "",
                                "SHARE_SHORTEN_URL_KEY" => "",
                                "FIELD_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "PROPERTY_CODE" => array(
                                    0 => "YOUTUBE",
                                    1 => "YOUTUBE_IN_MAIN",
                                    2 => "",
                                ),
                                "TEMPLATE_THEME" => "blue",
                                "DETAIL_URL" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "MEDIA_PROPERTY" => "",
                                "SLIDER_PROPERTY" => "",
                                "SEARCH_PAGE" => "/search/"
                            ),
                            false
                        ); ?>
                    </div>
                    <div class="btn-box d-xs-block d-md-none">
                        <a href="/blog/" class="btn btn-gray">посмотреть блог</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "includes/social-section.php"
    )
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>