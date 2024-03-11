<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array('jquery3'));
CModule::IncludeModule('iblock');
$curPagePath = $APPLICATION->GetCurDir();
$curPagePath = explode("/", $curPagePath);
if (SITE_ID == 's1') {
    setlocale(LC_TIME, 'ru_RU.utf8');
    $uaUrl = SITE_DIR.'ua'.$_SERVER['SCRIPT_URL'];
}
if (SITE_ID == 'ua') {
    setlocale(LC_TIME, 'uk_UA.utf8');
    $ruUrl = str_replace(SITE_DIR, '/',  $_SERVER['SCRIPT_URL']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RBFFG4PDVH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-RBFFG4PDVH');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?
    if ($curPagePath[1] != "companies" && $curPagePath[2] != "companies" && $curPagePath[1] != "ads" && $curPagePath[2] != "ads") { ?>
        <meta property="og:description" content="<?=$APPLICATION->GetDirProperty("description")?>">
        <meta property="og:image" content="https://priwoz.info<?= SITE_TEMPLATE_PATH ?>/images/priwoz.jpg">
        <meta property="og:image:url" content="https://priwoz.info<?= SITE_TEMPLATE_PATH ?>/images/priwoz.jpg">
    <? } else {
        $APPLICATION->ShowViewContent('og');
    } ?>
    <meta property="og:title" content="<? $APPLICATION->ShowTitle() ?>">
    <meta property="og:type" content="website">
    <meta property="og:image:type" content="article">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:url" content="https://priwoz.info<?= $_SERVER['SCRIPT_URL'] ?>">
    <link rel="icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_TEMPLATE_PATH ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= SITE_TEMPLATE_PATH ?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/favicon-16x16.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?
    $APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/main.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fancybox.css");
    
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/emojionearea.min.css");
        
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/styles.css");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bundle.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox.umd.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/lazysizes.min.js');
    
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/emojionearea.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scripts.js');
    $APPLICATION->ShowHead(); ?>
    <meta name="robots" content="noindex, nofollow" />
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<div class="site">
    <header class="site-header">
        <div class="container">
            <div class="row align-items-xs-center">
                <div class="col-xs-2 col-md-1 d-xs-block d-xl-none full-height">
                    <a href="#" class="mobile-menu-opener" data-open="mobile-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" viewBox="0 0 40 20" fill="none">
                            <rect width="40" height="2" rx="1" transform="matrix(1 0 0 -1 0 20)" fill="currentColor"/>
                            <rect width="33" height="2" rx="1" transform="matrix(1 0 0 -1 0 11)" fill="currentColor"/>
                            <rect width="40" height="2" rx="1" transform="matrix(1 0 0 -1 0 2)" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
                <div class="col-xs-7 col-md-2">
                    <a class="logo" href="<?=SITE_DIR?>">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/Priwoz2.svg" alt="Priwoz">
                    </a>
                </div>
                <div class="d-xs-none d-md-block col-md-3 d-xl-none full-height">
                    <div class="main-link">
                        <a href="<?=SITE_DIR?>ads/"><?=GetMessage('DEF_ADS')?></a>
                    </div>
                </div>
                <div class="col-xs-1 col-md-1 d-xs-block d-xl-none full-height">
                    <div class="link-icon -white-popup" data-open="search-menu">
                        <a href="<?=SITE_DIR?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20"
                                 fill="none">
                                <path d="M18.1479 19.2062L13.6914 14.7861" stroke="currentColor"
                                      stroke-linecap="round"/>
                                <path d="M16.1667 8.31025C16.1667 12.6224 12.6609 16.1205 8.33333 16.1205C4.00579 16.1205 0.5 12.6224 0.5 8.31025C0.5 3.99807 4.00579 0.5 8.33333 0.5C12.6609 0.5 16.1667 3.99807 16.1667 8.31025Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-xs-1 col-md-1 d-xs-block d-xl-none full-height">
                    <div class="link-icon -white-popup" data-open="buttons-menu">
                        <a href="<?=SITE_DIR?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                 fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M10 19.5C10 19.7761 10.2239 20 10.5 20C10.7761 20 11 19.7761 11 19.5V11.001H19.5C19.7761 11.001 20 10.7771 20 10.501C20 10.2248 19.7761 10.001 19.5 10.001H11V0.5C11 0.223858 10.7761 0 10.5 0C10.2239 0 10 0.223858 10 0.5V10.001H0.5C0.223858 10.001 0 10.2248 0 10.501C0 10.7771 0.223858 11.001 0.5 11.001H10V19.5Z"
                                      fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="d-xs-none d-xl-block col-xs-7 full-height">
                    <div class="main-menu">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "header",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "bottom",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N"
                            )
                        );?>
                    </div>
                </div>
                <div class="d-xs-none d-md-block col-md-2 col-xl-1">
                    <ul class="menu lang-menu">
                        <li><a <?if(SITE_ID != 's1'){?>href="<?=$ruUrl?>"<?}else{?>class="active"<?}?>>RU</a></li>
                        <li><a <?if(SITE_ID != 'ua'){?>href="<?=$uaUrl?>"<?}else{?>class="active"<?}?>>UA</a></li>
                    </ul>
                </div>
                <div class="d-xs-none d-md-block col-md-1" id="favorite-header-block">
                    <?php \Bitrix\Main\UI\Extension::load('neti_favorite.neti_lib'); ?>
                    <div class="link-icon" id="favorite-header">
                        <a <?if($_COOKIE['BITRIX_SM_Favorites']){?>class="selected"<?}?> href="<?=SITE_DIR?>personal/favorite/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                 fill="none">
                                <path d="M8.7838 4.44275C9.62445 2.26787 10.0448 1.18044 10.7277 1.02972C10.9072 0.990093 11.0928 0.990093 11.2723 1.02972C11.9552 1.18044 12.3756 2.26787 13.2162 4.44275C13.6943 5.67955 13.9333 6.29796 14.3805 6.71857C14.506 6.83655 14.6422 6.94162 14.7872 7.03231C15.3041 7.35566 15.9494 7.41563 17.2401 7.53559C19.4249 7.73865 20.5174 7.84018 20.851 8.48658C20.9201 8.62045 20.967 8.7654 20.9899 8.91539C21.1005 9.63962 20.2974 10.3979 18.6913 11.9144L18.2452 12.3355C17.4943 13.0445 17.1188 13.399 16.9017 13.8414C16.7714 14.1067 16.684 14.3925 16.6431 14.6873C16.5749 15.1788 16.6848 15.693 16.9047 16.7215L16.9833 17.089C17.3776 18.9335 17.5748 19.8558 17.3287 20.3091C17.1076 20.7163 16.7004 20.977 16.2505 20.9993C15.7497 21.0241 15.044 20.4273 13.6326 19.2339C12.7028 18.4475 12.2379 18.0544 11.7217 17.9008C11.2501 17.7605 10.7499 17.7605 10.2783 17.9008C9.76213 18.0544 9.29721 18.4475 8.36736 19.2339C6.95601 20.4273 6.25033 21.0241 5.74951 20.9993C5.29965 20.977 4.89241 20.7163 4.67132 20.3091C4.42519 19.8558 4.62236 18.9335 5.0167 17.089L5.09527 16.7215C5.31516 15.693 5.42511 15.1788 5.35688 14.6873C5.31595 14.3925 5.2286 14.1067 5.09833 13.8414C4.88116 13.399 4.5057 13.0445 3.75478 12.3355L3.30875 11.9144C1.70256 10.3979 0.899467 9.63962 1.01007 8.91539C1.03297 8.7654 1.07995 8.62045 1.14904 8.48658C1.48264 7.84018 2.57506 7.73865 4.75991 7.53559C6.05056 7.41563 6.69588 7.35566 7.21283 7.03231C7.35783 6.94162 7.49401 6.83655 7.61946 6.71857C8.06672 6.29796 8.30575 5.67955 8.7838 4.44275Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-xs-1 full-height d-xs-block d-md-none">
                    <div class="link-icon -round" data-open="profile-menu">
                        <a href="<?=SITE_DIR?>">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="5.5mm" height="5.5mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 550 550" xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <defs>
                                         <style type="text/css">
                                             .str0 {;stroke-width:26.46;stroke-miterlimit:22.9256}
                                             .fil0 {fill:none}
                                         </style>
                                     </defs>
                                <g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path id="icon.svg" style="stroke:#fff" class="fil0 str0" d="M267.86 533.32c68.98,-0.54 136.82,-4.32 203.88,-27.13 2.12,-8.5 3.17,-15.7 4.15,-24.37 5.47,-47.72 2.55,-105.12 -40.83,-135.17 -13.86,-9.6 -101.17,-52.26 -104.06,-49.89 -44.65,36.7 -79.91,38.31 -126.44,0.01 -2.89,-2.37 -90.2,40.29 -104.06,49.89 -43.38,30.05 -46.3,87.45 -40.83,135.17 0.98,8.67 2.03,15.87 4.15,24.37 39.45,13.42 79.19,20.25 119.25,23.71 24.43,2.11 60.83,4.91 84.79,3.41zm-81.15 -413.35c1.35,7.7 1.58,12.29 -0.59,17.74 -7.55,18.91 3.38,24.27 7.92,42.83 9.22,31.79 34.29,68.93 72.12,71.88 0.85,0.06 1.52,0.06 2.36,0.06 38.33,-2.43 63.71,-39.92 73,-71.95 4.54,-18.56 15.47,-23.92 7.92,-42.83 -2.17,-5.45 -1.94,-10.04 -0.59,-17.74 1.32,-51.42 -33.19,-87.42 -80.93,-89.26 -50.04,1.43 -82.47,40.35 -81.21,89.27z"></path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-md-1 d-xs-none d-md-block">
                    <div class="link-icon">
                        <a href="<?=SITE_DIR?>personal/">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="5.5mm" height="5.5mm"
                                 version="1.1"
                                 style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                 viewBox="0 0 550 550"
                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                     <defs>
                                         <style type="text/css">
                                             <![CDATA[
                                             .str0 {;stroke-width:26.46;stroke-miterlimit:22.9256}
                                             .fil0 {fill:none}
                                             ]]>
                                         </style>
                                     </defs>
                                <g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <path id="icon.svg" style="stroke:#fff" class="fil0 str0"
                                          d="M267.86 533.32c68.98,-0.54 136.82,-4.32 203.88,-27.13 2.12,-8.5 3.17,-15.7 4.15,-24.37 5.47,-47.72 2.55,-105.12 -40.83,-135.17 -13.86,-9.6 -101.17,-52.26 -104.06,-49.89 -44.65,36.7 -79.91,38.31 -126.44,0.01 -2.89,-2.37 -90.2,40.29 -104.06,49.89 -43.38,30.05 -46.3,87.45 -40.83,135.17 0.98,8.67 2.03,15.87 4.15,24.37 39.45,13.42 79.19,20.25 119.25,23.71 24.43,2.11 60.83,4.91 84.79,3.41zm-81.15 -413.35c1.35,7.7 1.58,12.29 -0.59,17.74 -7.55,18.91 3.38,24.27 7.92,42.83 9.22,31.79 34.29,68.93 72.12,71.88 0.85,0.06 1.52,0.06 2.36,0.06 38.33,-2.43 63.71,-39.92 73,-71.95 4.54,-18.56 15.47,-23.92 7.92,-42.83 -2.17,-5.45 -1.94,-10.04 -0.59,-17.74 1.32,-51.42 -33.19,-87.42 -80.93,-89.26 -50.04,1.43 -82.47,40.35 -81.21,89.27z"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="popup-menu general-menu d-xs-none d-xl-block" id="company-menu">
        <div class="inner">
            <div class="container">
                <div class="title-wrap">
                    <div class="menu-name"><?=GetMessage('DEF_HEADING')?></div>
                    <a href="<?=SITE_DIR?>companies/" class="all-link"><?=GetMessage('DEF_COMPANIES')?></a>
                </div>
                <div class="row sub-menu">
                    <?
                    $arSelect = array("NAME", "CODE", "UF_ICON", "UF_NAME_UA");
                    $arFilter = array("IBLOCK_ID" => 22, "ACTIVE" => "Y");
                    $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
                    while ($ar_result = $obSections->GetNext()) {
                        if ($ar_result['UF_ICON']) {
                            if (SITE_ID == 's1') {
                                $nameCategory = $ar_result['NAME'];
                            }
                            if (SITE_ID == 'ua') {
                                $nameCategory = $ar_result['UF_NAME_UA'];
                            } ?>
                            <div class="item col-xs-4">
                                <a href="<?= SITE_DIR ?>companies/?category=<?= $ar_result['CODE'] ?>">
                                    <?= htmlspecialchars_decode($ar_result['UF_ICON']) ?>
                                    <?= $nameCategory ?>
                                </a>
                            </div>
                        <?
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-menu mobile-menu" id="mobile-menu">
        <div class="inner">
            <ul class="menu main-menu">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "mobile-header",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "bottom",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                );?>
                <li class="d-xs-block d-md-none">
                    <ul class="menu lang-menu">
                        <li><a <?if(SITE_ID != 's1'){?>href="<?=$ruUrl?>"<?}else{?>class="active"<?}?>>RU</a></li>
                        <li><a <?if(SITE_ID != 'ua'){?>href="<?=$uaUrl?>"<?}else{?>class="active"<?}?>>UA</a></li>
                    </ul>
                </li>
                <li><a href="<?=SITE_DIR?>personal/company/" class="-green"><?=GetMessage('DEF_ADD_COMPANIES')?></a></li>
                <li><a href="<?=SITE_DIR?>personal/announcement/" class="-orange"><?=GetMessage('DEF_ADD_ADS')?></a></li>
            </ul>
        </div>
    </div>

    <div class="popup-menu profile-menu" id="profile-menu">
        <div class="inner">
            <ul class="menu main-menu">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "mobile-personal-left",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "",
                        "USE_EXT" => "N"
                    )
                ); ?>
                <li><a href="<?=SITE_DIR?>personal/company/" class="-green"><?=GetMessage('DEF_ADD_COMPANIES')?></a></li>
                <li><a href="<?=SITE_DIR?>personal/announcement/" class="-orange"><?=GetMessage('DEF_ADD_ADS')?></a></li>
            </ul>
        </div>
    </div>

    <div class="popup-menu general-menu d-xs-block d-xl-none" id="search-menu">
        <div class="inner">
            <? $APPLICATION->IncludeComponent(
                "networld:catalog.smart.filter",
                "header_filter_mobile",
                array(
                    "INSTANT_RELOAD" => "N",
                    "IBLOCK_TYPE" => "ads",
                    "IBLOCK_ID" => "19",
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
                    "SEARCH_PAGE" => "/search/",
                ),
                false
            );
            ?>
        </div>
    </div>

    <div class="popup-menu general-menu d-xs-block d-xl-none" id="buttons-menu">
        <div class="inner">
            <div class="container">
                <div class="buttons-wrap">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><a href="<?=SITE_DIR?>personal/company/" class="btn btn-large btn-green"><?=GetMessage('DEF_ADD_COMPANIES')?></a></div>
                        <div class="col-xs-12 col-md-6"><a href="<?=SITE_DIR?>personal/announcement/" class="btn btn-large btn-orange"><?=GetMessage('DEF_ADD_ADS')?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? if($APPLICATION->GetCurPage() == SITE_DIR || $APPLICATION->GetCurPage() == SITE_DIR."search/"):?>
    <section class="filter-section d-xs-none d-xl-block">
        <div class="container">
            <div class="row align-items-md-center">
                <div class="col-xl-8">
                    <? $APPLICATION->IncludeComponent(
                        "networld:catalog.smart.filter",
                        "header_filter",
                        array(
                            "INSTANT_RELOAD" => "N",
                            "IBLOCK_TYPE" => "ads",
                            "IBLOCK_ID" => "19",
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
                </div>
                <div class="col-xl-4">
                    <div class="buttons-wrap">
                        <div class="row">
                            <div class="col-xs-12 col-md-6"><a href="<?=SITE_DIR?>personal/company/" class="btn btn-green"><?=GetMessage('DEF_ADD_COMPANIES')?></a></div>
                            <div class="col-xs-12 col-md-6"><a href="<?=SITE_DIR?>personal/announcement/" class="btn btn-orange"><?=GetMessage('DEF_ADD_ADS')?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?endif;?>
<? if($APPLICATION->GetCurPage() != SITE_DIR  && $curPagePath[1] !== "personal" && $curPagePath[1] !== "auth" && $curPagePath[2] !== "personal" && $curPagePath[2] !== "auth" ):?>
    <section class="breadcrumbs-section">
        <div class="container">
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", Array(
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            ),
                false
            );?>
        </div>
    </section>
<?endif;?>


