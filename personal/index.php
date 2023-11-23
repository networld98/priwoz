<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки пользователя");
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "",
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
        </div>
        <div class="col-md-9">
            <?$APPLICATION->IncludeComponent("bitrix:main.profile", "", Array(
                "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
            ),
                false
            );?>
        </div>
    </div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>