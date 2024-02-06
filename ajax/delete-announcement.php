<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $arrFilter, $USER;
if (!empty($_POST['id'])) {
    $author = CIBlockElement::GetByID($_POST['id'])->GetNextElement()->GetProperties()['AUTHOR'];
    if ($author['VALUE'] == $USER->GetID() && $_POST['iblock']!=24) {
        CIBlockElement::Delete($_POST['id']);
    }else{
        $arSelect = array("ID","PROPERTY_NAME","PROPERTY_AUTHOR");
        $arFilter = array(
            "IBLOCK_ID" => 19,
        );
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while($arElement = $rsElements->GetNext())
        {
            if($arElement['PROPERTY_NAME_VALUE'] == $_POST['id']){
                $el = new CIBlockElement;
                $res = $el->Update($arElement['ID'], Array("ACTIVE" => "N", "PROPERTY_NAME" => $arElement['PROPERTY_AUTHOR_VALUE'],  "DATE_ACTIVE_FROM" => date()));
                CIBlockElement::SetPropertyValuesEx($arElement['ID'], 19, Array("NAME" => $arElement['PROPERTY_AUTHOR_VALUE']));
            }
        }
        CIBlockElement::Delete($_POST['id']);
    }
}
$arrFilter = array("PROPERTY_AUTHOR" => $USER->GetID(),"ACTIVE" => array("Y", "N")); ?>
<div class="grid-sizer"></div>
<div class="gutter-sizer"></div>
<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "favorite",
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
            0 => "LOGO",
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
        ),
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "LOGO",
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
        ),
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "NEWS_COUNT" => "24",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "arrows",
        "PAGER_TITLE" => "Новости",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SEF_FOLDER" => "/personal/favorite/",
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
        "IBLOCK_ID" => $_POST['iblock'],
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
            1 => "TELEGRAM",
            2 => "VIBER",
            3 => "WHATSAPP",
            4 => "AUTHOR",
            5 => "DOPPHONE",
            6 => "PHONE",
            7 => "CITY",
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
<script>
    $(document).ajaxComplete(function() {
        let grid = $('.grid').masonry({}).css('opacity', '1');
        grid.masonry('reloadItems');
    })
</script>