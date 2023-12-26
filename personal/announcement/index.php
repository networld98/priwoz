<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Обьявление");
?>
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
<section class="add-product-section">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "announcement", array(
            "SEF_MODE" => "Y",    // Включить поддержку ЧПУ
            "IBLOCK_TYPE" => "ads",    // Тип инфоблока
            "IBLOCK_ID" => "19",    // Инфоблок
            "PROPERTY_CODES" => array(    // Свойства, выводимые на редактирование
                0 => "527",
                1 => "525",
                2 => "531",
                3 => "532",
                4 => "533",
                5 => "534",
                6 => "535",
                7 => "NAME",
                8 => "PREVIEW_TEXT",
                9 => "524",
                10 => "528",
                11 => "526",
                12 => "529",
                13 => "556",
            ),
            "PROPERTY_CODES_REQUIRED" => array(    // Свойства, обязательные для заполнения
                0 => "524",
                1 => "525",
                2 => "531",
                3 => "NAME",
                5 => "PREVIEW_TEXT",
                6 => "527",
                7 => "528",
                9 => "526",
                10 => "529",
                11 => "556",
            ),
            "GROUPS" => array(    // Группы пользователей, имеющие право на добавление/редактирование
                0 => "5",
            ),
            "STATUS_NEW" => "NEW",
            "STATUS" => "ANY",    // Редактирование возможно
            "LIST_URL" => "",    // Страница со списком своих элементов
            "ELEMENT_ASSOC" => "PROPERTY_ID",
            "ELEMENT_ASSOC_PROPERTY" => "530",
            "MAX_USER_ENTRIES" => "100",    // Ограничить кол-во элементов для одного пользователя
            "MAX_LEVELS" => "1000000",    // Ограничить кол-во рубрик, в которые можно добавлять элемент
            "LEVEL_LAST" => "Y",    // Разрешить добавление только на последний уровень рубрикатора
            "USE_CAPTCHA" => "N",    // Использовать CAPTCHA
            "USER_MESSAGE_EDIT" => "",    // Сообщение об успешном сохранении
            "USER_MESSAGE_ADD" => "",    // Сообщение об успешном добавлении
            "DEFAULT_INPUT_SIZE" => "30",    // Размер полей ввода
            "RESIZE_IMAGES" => "Y",    // Использовать настройки инфоблока для обработки изображений
            "MAX_FILE_SIZE" => "5242880",    // Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
            "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
            "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
            "CUSTOM_TITLE_NAME" => "",    // * наименование *
            "CUSTOM_TITLE_TAGS" => "",    // * теги *
            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",    // * дата начала *
            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",    // * дата завершения *
            "CUSTOM_TITLE_IBLOCK_SECTION" => "",    // * раздел инфоблока *
            "CUSTOM_TITLE_PREVIEW_TEXT" => "",    // * текст анонса *
            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",    // * картинка анонса *
            "CUSTOM_TITLE_DETAIL_TEXT" => "",    // * подробный текст *
            "CUSTOM_TITLE_DETAIL_PICTURE" => "",    // * подробная картинка *
            "SEF_FOLDER" => "/",    // Каталог ЧПУ (относительно корня сайта)
            "COMPONENT_TEMPLATE" => ".default"
        ),
            false
        ); ?>
    </div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>