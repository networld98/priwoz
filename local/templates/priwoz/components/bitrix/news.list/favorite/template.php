<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');


?>
<?php
Bitrix\Main\Loader::includeModule('neti.favorite');
$defaultClass = \Bitrix\Main\Config\Option::get('neti.favorite',
    'removeClass');
?>
<? $i = 0;
foreach ($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="grid-item product-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="box">

            <? if ($arItem['PROPERTIES']['PHOTOS']['VALUE']):
                $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450, 'height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <div class="img">
                    <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $arItem['NAME'] ?>">
                </div>
            <? endif; ?>
            <? if (!empty($arItem["PROPERTIES"]['LOGO'])):?>
                <div class="img">
                    <?
                    $logo = CFile::ResizeImageGet($arItem["PROPERTIES"]['LOGO']['VALUE'], array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <img class="bg-img" src="<?= $picture["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <img class="company-logo" src="<?= $logo["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                </div>
            <? endif; ?>

            <div class="text">
                <h2 class="product-title"><?= $arItem["NAME"] ?></h2>
                <div class="location-date">
                    <div class="location"><?= $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'] ?></div>
                    <? if (!empty($arItem['DISPLAY_PROPERTIES']['PRICE'])) {
                        ?>
                        <time datetime="<?= strtolower(FormatDate("d m Y", MakeTimeStamp($arItem['TIMESTAMP_X']))) ?>"
                              class="date"><?= strtolower(FormatDate("d M Y", MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></time>
                    <? } ?>
                </div>
                <? if (!empty($arItem['DISPLAY_PROPERTIES']['PRICE'])) {
                    ?>
                    <div class="price"><? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != 0 && $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != NULL) {
                            echo $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] . " BGN";
                        } else {
                            echo "Договорная";
                        } ?></div>
                <? } ?>
            </div>

            <? if ($APPLICATION->GetCurPage() == "/personal/ads-list/") { ?>
                <div class="overlay">
                    <div class="row overlay-inner">
                        <div class="col-xs-12 col-md-6">
                            <a href="/personal/announcement/?edit=Y&CODE=<?= $arItem['ID'] ?>" class="overlay-link">
                                <div class="overlay-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                         fill="none">
                                        <path d="M3.91682 26.0832L3.49255 26.5075C3.73384 26.7487 4.03307 26.7502 4.1982 26.7341C4.34647 26.7196 4.52075 26.6759 4.67483 26.6373C4.68463 26.6348 4.69435 26.6324 4.70397 26.63L4.55845 26.0479L4.70397 26.63L10.8581 25.0914C10.8743 25.0874 10.8904 25.0834 10.9065 25.0794C11.1253 25.025 11.3356 24.9728 11.5271 24.8644C11.7185 24.756 11.8715 24.6025 12.0307 24.4429C12.0424 24.4311 12.0542 24.4194 12.066 24.4076L27.1351 9.33848L27.1619 9.31164C27.4722 9.00136 27.7465 8.72715 27.9378 8.47639C28.1452 8.20457 28.3108 7.89104 28.3108 7.5C28.3108 7.10896 28.1452 6.79543 27.9378 6.52361C27.7465 6.27285 27.4722 5.99864 27.1619 5.68835L27.1351 5.66152L24.3385 2.86495L24.3116 2.8381C24.0014 2.52778 23.7271 2.25352 23.4764 2.0622C23.2046 1.85481 22.891 1.68921 22.5 1.68921C22.109 1.68921 21.7954 1.85481 21.5236 2.0622C21.2729 2.25352 20.9986 2.52777 20.6884 2.8381L20.6615 2.86495L5.59887 17.9276L5.59245 17.934L5.59244 17.934C5.58063 17.9458 5.56885 17.9576 5.5571 17.9693C5.39748 18.1285 5.24404 18.2815 5.13564 18.4729C5.02725 18.6644 4.97499 18.8747 4.92062 19.0935C4.91662 19.1096 4.91261 19.1257 4.90856 19.1419L3.37003 25.296C3.36762 25.3057 3.36518 25.3154 3.36272 25.3252C3.32411 25.4793 3.28044 25.6535 3.26593 25.8018C3.24978 25.9669 3.25127 26.2662 3.49255 26.5074L3.91682 26.0832Z"
                                              stroke="currentColor" stroke-width="1.2"/>
                                        <path d="M19.6875 4.6875L27.1875 12.1875" stroke="currentColor"
                                              stroke-width="1.2"/>
                                    </svg>
                                </div>
                                <div class="overlay-text">редактировать</div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a href="/personal/ads-list/?delete=Y&CODE=<?= $arItem['ID'] ?>" class="overlay-link">
                                <div class="overlay-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                         fill="none">
                                        <path d="M11 22L11 14" stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M19 22L19 14" stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M15 22L15 14" stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M0.794189 7.5H29.206H27.6814C25.7958 7.5 24.853 7.5 24.2672 8.08579C23.6814 8.67157 23.6814 9.61438 23.6814 11.5V25.1667C23.6814 27.0523 23.6814 27.9951 23.0957 28.5809C22.5099 29.1667 21.5671 29.1667 19.6814 29.1667H10.3187C8.43308 29.1667 7.49027 29.1667 6.90449 28.5809C6.3187 27.9951 6.3187 27.0523 6.3187 25.1667V11.5C6.3187 9.61438 6.3187 8.67157 5.73291 8.08579C5.14713 7.5 4.20432 7.5 2.3187 7.5H0.794189Z"
                                              stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M11.0551 2.50105C11.0551 2.50105 11.8443 0.833984 15.0012 0.833984C18.1581 0.833984 19 3.50098 19 3.50098"
                                              stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M6 2L24.0586 4.50391" stroke="currentColor" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div class="overlay-text">удалить</div>
                            </a>
                        </div>
                    </div>
                </div>
            <? } ?>
            <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
               data-favorite-entity="<?= $arItem['ID'] ?>"
               data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
            </a>
        </div>
    </div>
<? endforeach; ?>

