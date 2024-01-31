<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Создание компании");
?>
    <section class="breadcrumbs-section">
        <div class="container">
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom", array(
                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            ),
                false
            ); ?>
        </div>
    </section>
    <section class="add-company-section">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form",
	"company",
	array(
		"SEF_MODE" => "Y",
		"IBLOCK_TYPE" => "companies",
		"IBLOCK_ID" => "24",
		"PROPERTY_CODES" => array(
            0 => "548",
            1 => "546",
            2 => "547",
            3 => "550",
            4 => "551",
            5 => "567",
            6 => "563",
            7 => "564",
            8 => "565",
            9 => "566",
            10 => "557",
            11 => "558",
            12 => "559",
            13 => "568",
            14 => "NAME",
            15 => "PREVIEW_TEXT",
            16 => "569",
		),
		"PROPERTY_CODES_REQUIRED" => array(
            0 => "546",
            1 => "NAME",
            2 => "548",
            3 => "550",
            4 => "551",
            5 => "PREVIEW_TEXT",
		),
		"GROUPS" => array(
			0 => "5",
		),
		"STATUS_NEW" => "N",
		"STATUS" => "ANY",
		"LIST_URL" => "",
		"ELEMENT_ASSOC" => "PROPERTY_ID",
		"ELEMENT_ASSOC_PROPERTY" => "570",
		"MAX_USER_ENTRIES" => "100",
		"MAX_LEVELS" => "1000000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "Y",
		"MAX_FILE_SIZE" => "5242880",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"SEF_FOLDER" => "/",
		"COMPONENT_TEMPLATE" => "company"
	),
	false
); ?>

        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>