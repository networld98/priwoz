<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array('jquery3'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/reset.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/styles.css");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap.bundle.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scripts.js');
    $APPLICATION->ShowHead(); ?>
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="logo" href="/"><img src="<?=SITE_TEMPLATE_PATH ?>/images/logo.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <button class="btn btn-outline-primary me-2">RU</button>
            <button class="btn btn-outline-primary me-2">UA</button>
            <button class="btn btn-outline-primary me-2">EN</button>
            <button class="btn btn-outline-primary me-2">Favorites</button>
            <button class="btn btn-primary">Login</button>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <? $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "header_filter",
                array(
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "COMPONENT_TEMPLATE" => "header_filter",
                    "CONVERT_CURRENCY" => "N",
                    "DISPLAY_ELEMENT_COUNT" => "N",
                    "FILTER_NAME" => "smartPreFilter",
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
                    "SEF_MODE" => "N",
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
                false
            );
            ?>
        </div>
        <?/*  <div class="col-lg-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Поиск">
                    <button class="btn btn-primary" type="button">Искать</button>
                </div>
            </div>
            <div class="col-lg-4">
                <select class="form-select" aria-label="Поиск по городу">
                    <option selected>Поиск по городу</option>
                    <option value="city1">Город 1</option>
                    <option value="city2">Город 2</option>
                    <option value="city3">Город 3</option>
                    <!-- Добавьте другие города по аналогии -->
                </select>
            </div>*/?>
        <div class="col-lg-2">
            <button class="btn btn-success" type="button">Добавить компанию</button>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-info" type="button">Добавить объявление</button>
        </div>
    </div>
</div>
<?if($APPLICATION->GetCurPage() != "/"):?>
    <div class="container">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
    </div>
<?endif;?>


