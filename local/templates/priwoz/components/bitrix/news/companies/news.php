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
$iblock = 22;
?>
<? if ($arParams["USE_RSS"] == "Y"): ?>
    <?
    if (method_exists($APPLICATION, 'addheadstring'))
        $APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" href="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" />');
    ?>
<? endif ?>

<? if ($arParams["USE_SEARCH"] == "Y"): ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "flat",
        array(
            "PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"]
        ),
        $component
    ); ?>
<? endif ?>
<?
$id = CIBlockFindTools::GetSectionID($section_id, $_GET['category'],  array("IBLOCK_ID" => $iblock));
if($id==0) {
    $id = CIBlockFindTools::GetElementID($element_id, $_GET['category'], $section_id, $section_code, array("IBLOCK_ID" => $iblock));
    $sub = CIBlockElement::GetByID($id)->GetNext()['IBLOCK_SECTION_ID'];
}
if($id!=0 && $sub==NULL){
    $name = CIBlockSection::GetByID($id)->GetNextElement()->GetFields()['NAME'];
    $APPLICATION->AddChainItem($name);
}elseif($id!=0 && $sub!=NULL){
    $name = CIBlockElement::GetByID($id)->GetNextElement()->GetFields()['NAME'];
    $subname = CIBlockSection::GetByID($sub)->GetNextElement()->GetFields()['NAME'];
    $subcode = CIBlockSection::GetByID($sub)->GetNextElement()->GetFields()['CODE'];
    $APPLICATION->AddChainItem($subname, SITE_DIR."companies/?category=".$subcode);
    $APPLICATION->AddChainItem($name);
}else{
    $name = 'Компании наших в Болгарии';
}
?>
<section class="company-overview-section">
    <div class="container">
        <div class="title-box">
            <h1 class="page-title"><?=$name?></h1>
                <?if($id!=0){
                    global $smartPreFilter;
                    if($id!=0 && $sub==$id){
                        $smartPreFilter = array("PROPERTY_CATEGORY" => $id);
                    }elseif($id!=0 && $sub!=NULL){
                        $smartPreFilter = array("PROPERTY_CATEGORY" => $sub, "PROPERTY_SUBCATEGORY" => $id);
                    }
                     $APPLICATION->IncludeComponent(
                        "networld:catalog.smart.filter",
                        "companies_filter",
                        array(
                            "INSTANT_RELOAD" => "N",
                            "IBLOCK_TYPE" => "companies",
                            "IBLOCK_ID" => "24",
                            "PREFILTER_NAME" => "smartPreFilter",
                            "FILTER_NAME" => "city",
                            "PROPERTY_CODE" => array(
                                1 => "CITY",
                                2 => "CATEGORY",
                                3 => "SUBCATEGORY",
                            ),
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "N",
                            "CACHE_GROUPS" => "Y",
                            "SEARCH_PAGE" => SITE_DIR."search/",
                        ),
                        false
                    );?>
                <?}else{?>
                    <a href="<?=SITE_DIR?>personal/company/" class="btn btn-green d-xs-none d-xl-inline-flex">Добавить компанию</a>
                <?}?>

        </div>
        <?if($id==0){?>
            <div class="collapse-head-box d-xl-none">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="collapse-head search-box-opener" data-collapsed="#search-box">Поиск компаний на Priwoze <span class="arrow"></span></div>
                    </div>
                    <div class="col-xs-12 col-md-6 d-xs-none d-md-block">
                        <div class="collapse-head filter-box-opener" data-collapsed="#filter-box">Фильтры поиска <span class="arrow"></span></div>
                    </div>
                </div>
            </div>
            <?
            $APPLICATION->IncludeComponent(
                "networld:catalog.smart.filter",
                "header_filter",
                array(
                    "INSTANT_RELOAD" => "N",
                    "IBLOCK_TYPE" => "companies",
                    "IBLOCK_ID" => "24",
                    "FILTER_NAME" => "city",
                    "PROPERTY_CODE" => array(
                        1 => "CATEGORY",
                        2 => "SUBCATEGORY",
                        3 => "PRICE",
                        4 => "CONDITION",

                    ),
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "CACHE_GROUPS" => "Y",
                    "SEARCH_PAGE" => SITE_DIR."search/",
                ),
                false
            );
            ?>
        <?}?>
        <div class="category-list d-xs-none d-xl-flex">
            <?
            if($sub==NULL){
                $sub = $id;
            }
            $arFilter = array("IBLOCK_ID" => $iblock, "IBLOCK_SECTION_ID" =>  $sub);
            if($id==0) {
                $arSelect = array("NAME", "CODE", "UF_ICON", "UF_NAME_UA");
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            }else{
                $arSelect = array();
                $obSections = CIBlockElement::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            }
            while ($ar_result = $obSections->GetNext()) {
                if ($ar_result['UF_ICON'] || $id!=0) {
                    if (SITE_ID == 's1') {
                        $nameCategory = $ar_result['NAME'];
                    }
                    if (SITE_ID == 'ua') {
                        if($id==0){
                            $nameCategory = $ar_result['UF_NAME_UA'];
                        }else{
                            $nameCategory = $ar_result['NAME_UA'];
                        }
                    } ?>
                    <div class="item">
                        <a href="<?= SITE_DIR ?>companies/?category=<?= $ar_result['CODE'] ?>" class="category-link">
                            <?= htmlspecialchars_decode($ar_result['UF_ICON']) ?>
                            <?= $nameCategory ?>
                        </a>
                    </div>
                    <?
                }
            } ?>
        </div>
        <div class="d-xs-block d-md-none">
            <div class="collapse-head filter-box-opener" data-collapsed="#filter-box">Фильтры поиска <span class="arrow"></span></div>
        </div>
        <div id="filter-box" class="collapsed-content filter-box d-xl-none">
            <div class="form-label">Категория</div>
            <select class="form-select -without-search select2-hidden-accessible" data-select2-id="select2-data-13-r8o1" tabindex="-1" aria-hidden="true">
                <option data-count="36643" value="All" selected="" data-select2-id="select2-data-15-0x05">Все объявления</option>
                <option data-count="126" value="avto">Авто</option>
                <option data-count="3644" value="det_mir">Детский мир</option>
                <option data-count="14826" value="dom_i_sad">Дом и сад</option>
                <option data-count="10433" value="zyvotnye">Животные</option>
                <option data-count="456" value="krasota">Красота</option>
                <option data-count="8210" value="nedv">Недвижимость</option>
                <option data-count="11325" value="odeg">Одежда</option>
                <option data-count="15247" value="darom">Отдам даром</option>
                <option data-count="456" value="rabota">Работа</option>
                <option data-count="8210" value="hobbi">Хобби и спорт</option>
                <option data-count="11325" value="uslugi">Услуги</option>
                <option data-count="15247" value="electr">Электроника</option>
            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-14-6o7o" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-gs03-container" aria-controls="select2-gs03-container"><span class="select2-selection__rendered" id="select2-gs03-container" role="textbox" aria-readonly="true" title="Все объявления">Все объявления</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        </div>
        <div class="container">
            <?
            if($id!=0 && empty($_GET['city_548'])) {
                global $city;
                if ($id != 0 && $sub == $id) {
                    $city = array("PROPERTY_CATEGORY" => $id);
                } elseif ($id != 0 && $sub != NULL) {
                    $city = array("PROPERTY_CATEGORY" => $sub, "PROPERTY_SUBCATEGORY" => $id);
                }
            }
            $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "companies",
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
    </div>
</section>
