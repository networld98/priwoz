<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array('jquery3'));
$curPagePath = $APPLICATION->GetCurDir();
$curPagePath = explode("/", $curPagePath);

if (SITE_ID == 's1') {
    setlocale(LC_TIME, 'ru_RU.utf8');
    $uaUrl = SITE_DIR.'ua'.$_SERVER['SCRIPT_URL'];
}
if (SITE_ID == 's2') {
    setlocale(LC_TIME, 'uk_UA.utf8');
    $ruUrl = str_replace(SITE_DIR, '/',  $_SERVER['SCRIPT_URL']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?
    $APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/main.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/styles.css");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bundle.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scripts.js');
    $APPLICATION->ShowHead(); ?>
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
                <div class="col-xs-4 col-md-2">
                    <a class="logo" href="<?=SITE_DIR?>">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Priwoz">
                    </a>
                </div>
                <div class="d-xs-none d-md-block col-md-3 d-xl-none full-height">
                    <div class="main-link">
                        <a href="<?=SITE_DIR?>ads/"><?=GetMessage('DEF_ADS')?></a>
                    </div>
                </div>
                <div class="col-xs-2 col-md-1 d-xs-block d-xl-none full-height">
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
                <div class="col-xs-2 col-md-1 d-xs-block d-xl-none full-height">
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
                <div class="col-xs-2 full-height d-xs-block d-md-none">
                    <div class="link-icon -round" data-open="profile-menu">
                        <a href="<?=SITE_DIR?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20"
                                 fill="none">
                                <path d="M2.62332 19.0024L2.62352 19.0025C4.04032 19.2854 5.71254 19.4553 7.44364 19.5H9.28156C11.4384 19.4443 13.5517 19.1913 15.2546 18.73L16.0147 18.4714C16.0155 18.4685 16.0164 18.4655 16.0173 18.4625C16.0347 18.4026 16.0532 18.3241 16.0719 18.2282C16.1093 18.0365 16.1432 17.7993 16.1717 17.5503C16.2291 17.0488 16.2604 16.5395 16.2604 16.3174C16.2604 14.7681 15.8351 13.2776 14.6283 12.4414C14.3901 12.2764 14.141 12.1833 13.7783 12.0476L2.62332 19.0024ZM2.62332 19.0024C2.46997 18.9719 1.97348 18.8572 1.49805 18.7251C1.26019 18.659 1.03803 18.5914 0.870968 18.5306C0.824825 18.5137 0.786083 18.4986 0.754439 18.4853C0.732865 18.4019 0.709352 18.2931 0.68632 18.1749C0.641897 17.9469 0.604529 17.7115 0.590888 17.6123M2.62332 19.0024L0.590888 17.6123M0.590888 17.6123L0.500018 16.3004C0.503833 14.4874 1.11681 13.0814 2.11326 12.4522L0.590888 17.6123ZM13.3622 11.8924C13.464 11.9301 13.5657 11.9678 13.6673 12.006L9.73601 10.6704L9.96958 11.1125C9.96962 11.1125 9.96966 11.1124 9.96971 11.1124C10.1151 11.0356 10.3449 10.8849 10.5466 10.7395C10.6099 10.6939 10.6735 10.6466 10.7338 10.5997C10.7797 10.6335 10.8289 10.6691 10.8798 10.7042L10.8798 10.7042C11.7202 11.2837 12.5441 11.5891 13.3622 11.8924ZM5.94594 10.6663C5.97541 10.6467 6.00582 10.626 6.03657 10.6044L2.11333 12.4522C2.43602 12.2485 2.73935 12.1255 3.08068 12.005C3.15527 11.9786 3.23317 11.952 3.31406 11.9243C3.59606 11.8278 3.91453 11.7188 4.25684 11.5676L4.25687 11.5675C4.48543 11.4666 4.92721 11.2541 5.34628 11.024C5.55581 10.909 5.76701 10.7856 5.94594 10.6663ZM5.12497 4.4486L5.15298 4.35463L5.14342 4.25705C5.01096 2.90449 5.39625 1.97748 5.97663 1.38908C6.56671 0.790836 7.40834 0.492031 8.26929 0.500161L8.2693 0.500161C9.97809 0.516238 11.4227 1.85069 11.37 3.87368C11.3662 3.89577 11.3614 3.91899 11.3552 3.94957L11.3528 3.96122L11.3525 3.96281C11.3442 4.0038 11.3305 4.07071 11.3247 4.14123C11.3103 4.3158 11.3423 4.53765 11.5271 4.73196L11.5273 4.73213C11.5477 4.75363 11.5669 4.77245 11.5826 4.78749L11.604 4.80805L11.6067 4.81057C11.5993 5.07974 11.521 5.29974 11.4239 5.49668C11.3816 5.58244 11.3394 5.65721 11.2942 5.73716C11.2819 5.75896 11.2693 5.78115 11.2565 5.80404C11.2059 5.89442 11.1329 6.0261 11.0932 6.1628L11.0932 6.16301C10.9204 6.75911 10.5777 7.4442 10.0863 7.97784C9.5985 8.50753 8.99019 8.86304 8.26805 8.88523C7.63049 8.90479 7.00473 8.57721 6.46771 8.03972C5.93218 7.50371 5.54039 6.81119 5.37127 6.23372C5.28904 5.95283 5.2194 5.81477 5.12266 5.6865C5.10734 5.66619 5.09795 5.65409 5.09148 5.64577C5.08102 5.6323 5.07824 5.62872 5.07047 5.61624C5.06157 5.60192 5.04238 5.56822 5.01186 5.49124C4.81687 4.99904 4.84929 4.81814 4.85813 4.78581C4.8589 4.78518 4.85978 4.78447 4.86081 4.78365C4.86564 4.77982 4.87118 4.77565 4.88173 4.76784L4.88413 4.76606C4.89281 4.75964 4.90957 4.74725 4.92544 4.73456C4.92585 4.73424 4.9265 4.73373 4.92738 4.73306C4.94656 4.71833 5.07369 4.62068 5.12497 4.4486ZM0.783223 18.5828C0.784797 18.5863 0.785545 18.5883 0.785529 18.5885C0.785513 18.5886 0.784723 18.5868 0.783223 18.5828Z"
                                      stroke="currentColor"/>
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
                    $arFilter = array("IBLOCK_ID" => 22);
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


