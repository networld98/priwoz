<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Персональный кабинет");

global $USER;
if ($USER->IsAuthorized()){ ?>
<section class="personal-section">
    <div class="container">
        <div class="content-row">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "personal-left",
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
            <div class="main-content">
<?}?>
                <?$APPLICATION->IncludeComponent("bitrix:main.profile", "custom", array(
                "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                "USER_PROPERTY" =>  array("UF_CITY","UF_TELEGRAM","UF_VIBER","UF_WHATSAPP"),
                ), false
                );?>
<?if ($USER->IsAuthorized()){?>
            </div>
        </div>
    </div>
</section>
<? } ?>
<? require ($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>