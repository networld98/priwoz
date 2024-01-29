<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt=$APPLICATION->IncludeComponent("networld:menu.sections", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => SITE_DIR."companies/",
    "SECTION_PAGE_URL" => "?category=#SECTION_CODE#",
    "DETAIL_PAGE_URL" => "#ELEMENT_CODE#",
    "IBLOCK_TYPE" => "company",
    "IBLOCK_ID" => 22,
    "DEPTH_LEVEL" => "1",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000"
),
    false
);
$aMenuLinks = array_merge($aMenuLinks,$aMenuLinksExt);
?>