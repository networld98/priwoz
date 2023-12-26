<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Настройки пользователя");
?>
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
                    <div class="title-box">
                        <h1 class="page-title">FAq</h1>
                        <a href="/personal/announcement/" class="btn btn-orange">Добавить объявление</a>
                    </div>
                    <?$APPLICATION->IncludeComponent("bitrix:support.faq.element.list","",Array(
                            "IBLOCK_TYPE" => "services",
                            "IBLOCK_ID" => "19",
                            "SHOW_RATING" => "Y",
                            "RATING_TYPE" => "like",
                            "PATH_TO_USER" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "CACHE_GROUPS" => "Y",
                            "AJAX_MODE" => "N",
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N"
                        )
                    );?>

                </div>
            </div>
        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>