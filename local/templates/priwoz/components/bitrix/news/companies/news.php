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
    $name = GetMessage("T_NEWS_TITLE");
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
                            "FILTER_NAME" => "category",
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
                    <a href="<?=SITE_DIR?>personal/company/" class="btn btn-green d-xs-none d-xl-inline-flex"><?=GetMessage("T_NEWS_ADD_COMPANY")?></a>
                <?}?>

        </div>
        <?if($id==0){?>
            <div class="collapse-head-box d-xl-none">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="collapse-head search-box-opener" data-collapsed="#search-box"><?=GetMessage("T_NEWS_SEARCH_DESK")?> <span class="arrow"></span></div>
                    </div>
                    <div class="col-xs-12 col-md-6 d-xs-none d-md-block">
                        <div class="collapse-head filter-box-opener" data-collapsed="#filter-box"><?=GetMessage("T_NEWS_SEARCH")?> <span class="arrow"></span></div>
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
                    "FILTER_NAME" => "category",
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
            $arFilter = array("IBLOCK_ID" => $iblock, "IBLOCK_SECTION_ID" =>  $sub, "ACTIVE"=>"Y");
            if($id==0) {
                $arSelect = array("ID", "NAME", "CODE", "UF_ICON", "UF_NAME_UA");
                $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while ($ar_result = $obSections->GetNext()) {
                    if ($ar_result['UF_ICON'] || $id!=0) {
                        if (SITE_ID == 's1') {
                            $nameCategory = $ar_result['NAME'];
                        }
                        if (SITE_ID == 'ua') {
                            $nameCategory = $ar_result['UF_NAME_UA'];
                        } ?>
                        <div class="item">
                            <a href="<?= SITE_DIR ?>companies/?category=<?= $ar_result['CODE'] ?>" class="category-link">
                                <?= htmlspecialchars_decode($ar_result['UF_ICON']) ?>
                                <?= $nameCategory ?>
                            </a>
                        </div>
                        <?
                        $mobCat[] = ["NAME"=>$nameCategory,"ICON"=>htmlspecialchars_decode($ar_result['UF_ICON']), "CODE"=>$ar_result['CODE']];
                    }
                }
            }else{
                $arSelect = array("ID","NAME","CODE","PROPERTY_NAME_UA");
                $obSections = CIBlockElement::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                while($ob = $obSections->GetNextElement()){
                    $ar_result = $ob->GetFields();
                    $ar_props = $ob->GetProperties();
                    if ($id!=0) {
                        if (SITE_ID == 's1') {
                            $nameCategory = $ar_result['NAME'];
                        }
                        if (SITE_ID == 'ua') {
                            $nameCategory = $ar_props['NAME_UA']['VALUE'];
                        } ?>
                        <div class="item">
                            <a href="<?= SITE_DIR ?>companies/?category=<?= $ar_result['CODE'] ?>" class="category-link">
                                <?= $nameCategory ?>
                            </a>
                        </div>
                        <?
                        $mobCat[] = ["NAME"=>$nameCategory, "CODE"=>$ar_result['CODE']];
                    }
                }
            }
            ?>
        </div>
        <div class="d-xs-block d-md-none">
            <div class="collapse-head filter-box-opener" data-collapsed="#filter-box"><?=GetMessage("T_NEWS_SEARCH")?> <span class="arrow"></span></div>
        </div>
        <div id="filter-box" class="collapsed-content filter-box d-xl-none">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="form-label"><?=GetMessage("T_NEWS_CATEGORY")?></div>
                    <select class="form-select -without-search">
                        <option><a href="<?= SITE_DIR ?>companies/">Все компанії</a></option>
                        <?foreach($mobCat as $item){?>
                            <option ON><a href="<?= SITE_DIR ?>companies/?category=<?= $item['CODE'] ?>"><?= $item['ICON'] ?><?= $item['NAME']?></a></option>
                        <?}?>
                    </select>
                </div>
            </div>
        </div>
        <div class="container" id="companies-container">
            <?
            if($id!=0 && empty($_GET['category_548'])) {
                global $category;
                if ($id != 0 && $sub == $id) {
                    $category = array("PROPERTY_CATEGORY" => $id);
                } elseif ($id != 0 && $sub != NULL) {
                    $category = array("PROPERTY_CATEGORY" => $sub, "PROPERTY_SUBCATEGORY" => $id);
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
