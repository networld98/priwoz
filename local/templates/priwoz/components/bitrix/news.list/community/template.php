<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<section class="community-overview-section">
    <div class="container">
        <div class="title-box">
            <div class="row align-items-md-baseline">
                <div class="col-xs-12 col-md-9">
                    <h1 class="section-title"><?$APPLICATION->ShowTitle(false)?></h1>
                </div>
                <div class="col-xs-12 col-md-3">
                    <a href="<?=SITE_DIR?>" class="blue-link" data-popup="addCommunityPopup"><?=GetMessage("CT_BNL_ADD_COMM")?></a>
                </div>
            </div>
        </div>
        <div class="social-tabs">
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <span data-name="telegram" class="social-tab <?if($_GET['social']== 'telegram'){?>active<?}?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 30 25" fill="none">
                            <path d="M17.5817 19.069L17.2726 18.8734L16.9925 19.1088L12.9222 22.5311L12.3114 22.6142L9.78596 13.8837L9.71267 13.6303L9.46214 13.5477L1.49131 10.921L28.7355 0.502077L29.4025 0.517048L25.1279 23.8447L17.5817 19.069ZM24.5385 4.1322L24.3685 4.11199L24.2218 4.20023L11.0947 12.0957L10.7827 12.2834L10.8655 12.6379L12.3772 19.1078L12.4902 19.5916L12.9747 19.4816L13.3889 19.3876L13.6686 19.3241L13.755 19.0507L15.2909 14.1915L25.6763 5.10819L26.5226 4.36802L25.4062 4.23533L24.5385 4.1322Z"
                                  stroke="currentColor"/>
                        </svg>
                        Telegramm
                    </span>
                </div>
                <div class="col-xs-4 col-md-2">
                    <span data-name="viber" class="social-tab <?if($_GET['social']== 'viber'){?>active<?}?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="30" viewBox="0 0 27 30" fill="none">
                            <path d="M21.5711 10.5249C21.7226 9.80017 21.5283 9.26497 21.2898 8.50001C21.0513 7.73504 20.6257 6.99879 20.0449 6.34641C19.4641 5.69402 18.7431 5.14242 17.9359 4.73294C17.1288 4.32345 16.4562 3.99886 15.584 3.91406"
                                  stroke="currentColor" stroke-linecap="round"/>
                            <path d="M19.2634 11.2828C19.3203 10.6961 19.1226 10.2445 18.8709 9.60138C18.6191 8.95823 18.2234 8.32742 17.7134 7.75621C17.2033 7.18499 16.5922 6.68817 15.9257 6.30298C15.2593 5.91779 14.7054 5.6105 14.0156 5.48828"
                                  stroke="currentColor" stroke-linecap="round"/>
                            <path d="M16.8139 12.0394C16.8694 11.604 16.7309 11.2725 16.5559 10.8C16.3809 10.3274 16.0975 9.86627 15.727 9.45102C15.3565 9.03576 14.9085 8.67718 14.4164 8.40214C13.9244 8.12709 13.5152 7.90802 13 7.82812"
                                  stroke="currentColor" stroke-linecap="round"/>
                            <path d="M9.69715 10.0501L9.69754 10.0498L10.0984 9.7176L10.0985 9.71756C10.3649 9.49686 10.4151 9.11222 10.2169 8.83261L10.2167 8.83231L8.76591 6.78193L8.76557 6.78145C8.54825 6.47357 8.11417 6.40662 7.81173 6.63872C7.81171 6.63874 7.81169 6.63875 7.81167 6.63877C7.8116 6.63882 7.81154 6.63886 7.81148 6.63891L7.06213 7.21527L7.06186 7.21548C6.91665 7.32702 6.70419 7.58373 6.46732 7.97338C6.23837 8.35001 6.01187 8.80858 5.82564 9.27908C5.63877 9.75122 5.49881 10.2194 5.43399 10.6161C5.36493 11.0387 5.3978 11.2836 5.4475 11.3825C6.39592 13.2679 7.59064 15.481 8.83901 16.6325L8.83925 16.6327C10.4448 18.1157 12.608 19.6891 14.6893 20.5369L14.6894 20.537C14.7731 20.5711 14.9967 20.587 15.3928 20.4972C15.7619 20.4135 16.1962 20.2583 16.6355 20.0621C17.0729 19.8667 17.5008 19.6372 17.8554 19.413C18.2207 19.182 18.4719 18.9791 18.5874 18.8443C18.8141 18.5795 19.0276 18.3082 19.2141 18.0608C19.4354 17.7666 19.3727 17.3492 19.0706 17.1316L16.6899 15.4175C16.6899 15.4175 16.6899 15.4175 16.6898 15.4175C16.396 15.2063 15.9865 15.2667 15.7676 15.5501L15.7552 15.5661L15.7416 15.581L15.3418 16.0202C15.3416 16.0204 15.3414 16.0207 15.3412 16.0209C14.9736 16.4269 14.403 16.6622 13.8205 16.544M9.69715 10.0501L9.14562 11.7322C9.35536 12.544 9.91346 13.6578 10.8804 14.6909C12.0529 15.9469 13.1029 16.3991 13.8205 16.544M9.69715 10.0501C9.20878 10.4556 8.98339 11.105 9.14557 11.732L9.69715 10.0501ZM13.8205 16.544C13.8204 16.5439 13.8203 16.5439 13.8202 16.5439L13.9198 16.0539M13.8205 16.544C13.8207 16.544 13.8208 16.544 13.8209 16.544L13.9198 16.0539M13.9198 16.0539C14.3079 16.1328 14.7063 15.9775 14.971 15.6848L13.9198 16.0539Z"
                                  stroke="currentColor"/>
                            <path d="M11.3748 24.3471L11.1418 24.3524L10.996 24.5343C10.3864 25.2951 9.77441 26.0517 9.16152 26.8094C8.87178 27.1676 8.58184 27.5261 8.29183 27.8854L8.6809 28.1995L8.29182 27.8854C7.90801 28.361 7.57752 28.7684 7.24652 29.0654C7.00216 29.2847 6.79135 29.4122 6.59783 29.4672L6.55498 23.9192L6.55197 23.53L6.17383 23.4374C3.26462 22.7256 1.61904 20.4748 0.937779 17.5507L0.937771 17.5507C0.612268 16.1541 0.46685 14.1841 0.506327 12.1953C0.545812 10.206 0.769321 8.24619 1.15781 6.86812C1.61318 5.25302 2.29782 4.07491 3.24061 3.19489C4.18616 2.31229 5.42556 1.69757 7.04245 1.26686L6.91375 0.78371L7.04245 1.26686C9.19268 0.694062 12.0353 0.403781 14.8487 0.528621C17.669 0.653763 20.4028 1.19359 22.3637 2.23715L22.3637 2.23717C24.5348 3.39241 25.6198 5.61063 26.086 8.19443C26.5518 10.7761 26.3807 13.6312 26.1183 15.9092L26.5716 15.9615L26.1183 15.9092C25.8781 17.994 25.342 19.5241 24.5806 20.6587C23.823 21.7876 22.8222 22.5548 21.5989 23.0849C19.1104 24.1632 15.7541 24.2477 11.7381 24.3388L11.3748 24.3471ZM6.60036 29.7802C6.60054 29.7818 6.60059 29.7827 6.60056 29.7827L6.60036 29.7802Z"
                                  stroke="currentColor"/>
                        </svg>
                        viber
                    </span>
                </div>
                <div class="col-xs-4 col-md-2">
                    <span data-name="facebook" class="social-tab <?if($_GET['social']== 'facebook'){?>active<?}?>">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="7.3mm" height="7.3mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                             viewBox="0 0 730 730"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                         <defs>
                          <style type="text/css">
                           <![CDATA[
                           .str0 {stroke:#526172;stroke-width:26.46;stroke-miterlimit:22.9256}
                           .fil0 {fill:none}
                           ]]>
                          </style>
                         </defs>
                         <g id="Слой_x0020_1">
                          <metadata id="CorelCorpID_0Corel-Layer"/>
                          <path id="FB.svg" class="fil0 str0" d="M531.09 320.5l62.76 0 0 -139.66c-37.62,-4.98 -73.36,-7.97 -111.44,-7.5 -63.15,0.02 -107.45,20.08 -134.96,62.37 -26.51,40.74 -35.84,99.95 -35.92,174.65l-60.6 4.16 -1.08 120.99 61.42 -1.19c-0.06,64.16 -0.5,128.33 -0.87,192.49 -47.05,-1 -93.03,-1.92 -130.76,-1.92 -74.82,0 -119.67,-22.08 -146.33,-55.62 -27.16,-34.17 -37.55,-82.8 -37.55,-140.12 0,-96.92 2.29,-193.83 2.29,-290.68 0,-64.05 14.17,-111.22 43.39,-142.42 29.07,-31.04 75.34,-48.73 145.14,-48.73 107.08,0 214.15,-0.51 321.23,-0.51 63.96,0 107.92,13.31 136.28,42.86 28.51,29.72 44.03,78.71 44.03,156.79 0,117.63 -1.32,236.34 -5.14,354 -0.99,30.6 -18.28,69.83 -43.01,89.03 -38.93,30.23 -95.9,38.01 -130.25,38.87l-37.7 0.95 -4.21 -197.98 96.5 -1.91 22.62 -132.95 -120.29 6.61 4.53 -34.52c5.16,-39.17 22.36,-48.06 59.92,-48.06z"/>
                         </g>
                        </svg>
                        facebook
                    </span>
                </div>
            </div>
        </div>
        <div class="communities-wrap">
            <div class="grid communities-masonry" id="community-section-ajax">
                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $props = CIBlockElement::GetByID($arItem["ID"])->GetNextElement()->GetProperties();
                    $picture = CFile::ResizeImageGet($props["PICTURE"]["VALUE"], array('width'=>400,'height'=> 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    if($props["MODERATION"]["VALUE"] == "Y"){
                        if($_GET['social']==''){?>
                            <div class="grid-item community-grid-item">
                                <a href="<?=$props["LINK"]["VALUE"]?>" class="box">
                                    <div class="img">
                                        <img class="bg-img" src="<?= $picture["src"]?>" alt="<?=$arItem['NAME']?>">
                                        <div class="social-icon">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/social/<?=$props["LOGO"]["VALUE"]?>.svg" alt="<?=$arItem['NAME']?>">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h2 class="community-title"><?=$arItem['NAME']?></h2>
                                        <div class="description"><?=$arItem["PREVIEW_TEXT"]?></div>
                                    </div>
                                </a>
                            </div>
                        <? } else {
                            if ($props["LOGO"]["VALUE"] == $_GET['social']) {
                                ?>
                                <div class="grid-item community-grid-item">
                                    <a href="<?=$props["LINK"]["VALUE"]?>" class="box">
                                        <div class="img">
                                            <img class="bg-img" src="<?= $picture["src"]?>" alt="<?=$arItem['NAME']?>">
                                            <div class="social-icon">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/social/<?=$props["LOGO"]["VALUE"]?>.svg" alt="<?=$arItem['NAME']?>">
                                            </div>
                                        </div>
                                        <div class="text">
                                            <h2 class="community-title"><?=$arItem['NAME']?></h2>
                                            <div class="description"><?=$arItem["PREVIEW_TEXT"]?></div>
                                        </div>
                                    </a>
                                </div>
                            <? }
                        }
                    } ?>
                <?endforeach;?>
                <?if($_GET['strIMessage']!=''){?>
                <div class="grid-item community-grid-item">
                    <div class="box">
                        <div class="text">
                            <?=GetMessage("FORM_NOTE_ADDOK_2")?>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>
<div class="popup-general" id="addCommunityPopup">
    <div class="modal-box">
        <div class="scroll-box">
            <div class="form-box">
                <? $APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "community", array(
                    "SEF_MODE" => "Y",    // Включить поддержку ЧПУ
                    "IBLOCK_TYPE" => "community",    // Тип инфоблока
                    "IBLOCK_ID" => "26",    // Инфоблок
                    "PROPERTY_CODES" => array(    // Свойства, выводимые на редактирование
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "560",
                        3 => "561",
                        4 => "578",
                        5 => "579",
                    ),
                    "PROPERTY_CODES_REQUIRED" => array(    // Свойства, обязательные для заполнения
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "560",
                        3 => "561",
                        4 => "578",
                        5 => "579",
                    ),
                    "GROUPS" => array(    // Группы пользователей, имеющие право на добавление/редактирование
                        0 => "2",
                    ),
                    "STATUS_NEW" => "NEW",
                    "STATUS" => "N",    // Редактирование возможно
                    "LIST_URL" => "",    // Страница со списком своих элементов
                    "ELEMENT_ASSOC" => "PROPERTY_ID",
                    "ELEMENT_ASSOC_PROPERTY" => "530",
                    "MAX_USER_ENTRIES" => "100",    // Ограничить кол-во элементов для одного пользователя
                    "MAX_LEVELS" => "1000000",    // Ограничить кол-во рубрик, в которые можно добавлять элемент
                    "LEVEL_LAST" => "Y",    // Разрешить добавление только на последний уровень рубрикатора
                    "USE_CAPTCHA" => "N",    // Использовать CAPTCHA
                    "USER_MESSAGE_EDIT" => "",    // Сообщение об успешном сохранении
                    "USER_MESSAGE_ADD" => GetMessage("FORM_NOTE_ADDOK"),    // Сообщение об успешном добавлении
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
        </div>
    </div>
</div>