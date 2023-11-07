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

