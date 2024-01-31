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

$arCloudParams = array(
    "SEARCH" => $arResult["REQUEST"]["~QUERY"],
    "TAGS" => $arResult["REQUEST"]["~TAGS"],
    "CHECK_DATES" => $arParams["CHECK_DATES"],
    "arrFILTER" => $arParams["arrFILTER"],
    "SORT" => $arParams["TAGS_SORT"],
    "PAGE_ELEMENTS" => $arParams["TAGS_PAGE_ELEMENTS"],
    "PERIOD" => $arParams["TAGS_PERIOD"],
    "URL_SEARCH" => $arParams["TAGS_URL_SEARCH"],
    "TAGS_INHERIT" => $arParams["TAGS_INHERIT"],
    "FONT_MAX" => $arParams["FONT_MAX"],
    "FONT_MIN" => $arParams["FONT_MIN"],
    "COLOR_NEW" => $arParams["COLOR_NEW"],
    "COLOR_OLD" => $arParams["COLOR_OLD"],
    "PERIOD_NEW_TAGS" => $arParams["PERIOD_NEW_TAGS"],
    "SHOW_CHAIN" => $arParams["SHOW_CHAIN"],
    "COLOR_TYPE" => $arParams["COLOR_TYPE"],
    "WIDTH" => $arParams["WIDTH"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "RESTART" => $arParams["RESTART"],
);
$companies = [];
$ads = [];
foreach ($arResult['SEARCH'] as $item) {
    if ($item['PARAM2'] == 24) {
        $companies[] = $item['ITEM_ID'];
    }
    if ($item['PARAM2'] == 19) {
        $ads[] = $item['ITEM_ID'];
    }
}
if ($_GET['city_529']) {
    $arSelect = array("ID", "NAME");
    $arFilter = array("IBLOCK_ID" => 21, "CODE" => $_GET['city_529'], "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $cityId = $arFields['ID'];
        $cityName = $arFields['NAME'];
    }
    //Фильтруем обьявы по городу
    $arSelect = array("ID");
    $arFilter = array("IBLOCK_ID" => 19, "ID" => $ads, "PROPERTY_CITY" => $cityId);
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
    $ads = [];
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $ads[] = $arFields['ID'];
    }
    //Фильтруем компании по городу
    $arFilter = array("IBLOCK_ID" => 24, "ID" => $companies, "PROPERTY_CITY" => $cityId);
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
    $companies = [];
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $companies[] = $arFields['ID'];
    }
}

if ($_GET['companies'] == 'Y') {
    $iblock = 24;
    $theme = 'companies';
    $filterItems = $companies;
}
if ($_GET['companies'] == 'N' || empty($_GET['companies'])) {
    $iblock = 19;
    $theme = 'ads';
    $filterItems = $ads;
}

global $smartPreFilter;
$smartPreFilter = array("ID" => $filterItems);
?>
<section class="products-overview-section">
    <div id="products-overview-section-ajax">
        <div class="container">
            <div class="search-title-box">
                <h1><?=GetMessage('SEARCH_TITLE')?> <span class="highlight"><? if ($arResult['REQUEST']['QUERY']) {
                            echo $arResult['REQUEST']['QUERY'];
                        } else { ?> <?=GetMessage('SEARCH_CITY')?><? } ?>:</span></h1>
                <div class="search-output"><span class="<? if ($_GET['companies'] != 'Y'){ ?>current" <? }else{ ?>link"
                    data-url="/search/?q=<?=$_GET['q']?>&city_529=<?=$_GET['city_529']?>&companies=N"<?}?>
                    ><?=GetMessage('SEARCH_ADS')?> <?= count((array)$ads) ?></span><span
                            class="<? if ($_GET['companies'] == 'Y'){ ?>current" <? }else{ ?>link"
                    data-url="/search/?q=<?=$_GET['q']?>&city_529=<?=$_GET['city_529']?>&companies=Y"<?}?>
                    ><?=GetMessage('SEARCH_COMPANY')?> <?= count((array)$companies) ?></span>
                </div>
            </div>
            <div class="filter-output-box">
                <div class="filter-output">
                    <div class="links">
                        <a href="<?=SITE_DIR?>">Priwoz</a>
                        <? if ($arResult['REQUEST']['QUERY']) { ?> <span class="sep">-</span> <a
                            href="/<?=SITE_DIR?>search/?q=<?= $arResult['REQUEST']['QUERY'] ?>"><?= $arResult['REQUEST']['QUERY'] ?></a><? } ?>
                        <? if ($_GET['city_529']) { ?><span class="sep">/</span><span
                                class="current-page"><?= $cityName ?></span><? } ?>
                    </div>
                </div>
                <div class="sort-by-box">
                    <div class="bx_filter_parameters_box active">
                        <div class="bx_filter_parameters_box_title"><?=GetMessage('SEARCH_SORT')?></div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <div class="bx_filter_select_container">
                                    <select class="form-select filter-sort-search -without-search">
                                        <option <?if($_GET['sort']=='ACTIVE_FROM' && $_GET['ads']=='desc'){?>selected<?}?> value="/search/?q=<?=$_GET['q']?>&city_529=<?=$_GET['city_529']?>&companies=<?=$_GET['companies']?>&sort=ACTIVE_FROM&ads=desc"><?=GetMessage('SEARCH_SORTED_BY_DATE')?></option>
                                        <option <?if($_GET['sort']=='ACTIVE_FROM' && $_GET['ads']=='asc'){?>selected<?}?> value="/search/?q=<?=$_GET['q']?>&city_529=<?=$_GET['city_529']?>&companies=<?=$_GET['companies']?>&sort=ACTIVE_FROM&ads=asc"><?=GetMessage('SEARCH_SORT_BY_DATE')?></option>

<!--                                        <option --><?//if($_GET['sort']=='PROPERTY_PRICE' && $_GET['ads']=='desc'){?><!--selected--><?//}?><!-- value="/search/?q=--><?//=$_GET['q']?><!--&city_529=--><?//=$_GET['city_529']?><!--&companies=--><?//=$_GET['companies']?><!--&sort=PROPERTY_PRICE&ads=desc">Сначала дешевые</option>-->
<!--                                        <option --><?//if($_GET['sort']=='PROPERTY_PRICE' && $_GET['ads']=='asc'){?><!--selected--><?//}?><!-- value="/search/?q=--><?//=$_GET['q']?><!--&city_529=--><?//=$_GET['city_529']?><!--&companies=--><?//=$_GET['companies']?><!--&sort=PROPERTY_PRICE&ads=asc">Сначала дорогие</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay">
            <div class="container">
                <? if (count((array)$smartPreFilter['ID']) > 0): ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        $theme,
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "NEWS_COUNT" => "12",
                            "IBLOCK_TYPE" => "ads",
                            "IBLOCK_ID" => $iblock,
                            "SORT_BY1" => $_GET['sort'],
                            "SORT_ORDER1" => $_GET['ads'],
                            "SORT_BY2" => 'timestamp_x',
                            "SORT_ORDER2" => 'desc',
                            "FILTER_NAME" => 'smartPreFilter',
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "PRICE",
                                1 => "AUTHOR",
                                2 => "NAME",
                                3 => "PHONE",
                                4 => "DOPPHONE",
                                5 => "TELEGRAM",
                                6 => "VIBER",
                                7 => "WHATSAPP",
                                8 => "LOGO",
                                9 => "CITY",
                                10 => "CATEGORY"
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "3600",
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "show_more",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "Y",
                            "SHOW_404" => "Y",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "COMPONENT_TEMPLATE" => $theme,
                            "STRICT_SECTION_CHECK" => "N",
                            "FILE_404" => "",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "TEMPLATE_THEME" => "blue",
                            "MEDIA_PROPERTY" => "",
                            "SLIDER_PROPERTY" => "",
                            "SEARCH_PAGE" => "/search/",
                            "USE_RATING" => "N",
                            "USE_SHARE" => "N",
                            "PAGER_TITLE" => "Новости"
                        ),
                        false
                    ); ?>
                <? endif; ?>
            </div>
        </div>
    </div>
</section>
<? if (count((array)$smartPreFilter['ID']) == 0): ?>
<section class="not-found-section">
    <div class="container">
        <div class="bg-box">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <h5><? ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); ?></h5>
                </div>
                <div class="col-xs-12 col-md-6 col-xl-5">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/404-cat.png" alt="404 Priwoz">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? endif; ?>
<script>
    $( document ).ready(function() {
        $(".search-output span.link").click(function () {
            let url = $(this).data('url');
            $(".products-overview-section").load(url + " #products-overview-section-ajax");
        })
        $(".filter-sort-search").change(function () {
            let url = $(this).val();
            $(".products-overview-section").load(url +" #products-overview-section-ajax");
        })
    })
    $(document).ajaxComplete(function() {
        $(".search-output span.link").click(function () {
            let url = $(this).data('url');
            $(".products-overview-section").load(url + " #products-overview-section-ajax");
        })
        $(".filter-sort-search").change(function () {
            let url = $(this).val();
            $(".products-overview-section").load(url +" #products-overview-section-ajax");
        })
        grid = $('.grid').masonry({}).css('opacity', '1'),
            grid.masonry('reloadItems');
        $('.form-select').select2();
    })
</script>



