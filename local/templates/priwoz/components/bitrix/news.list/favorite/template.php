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
    $active = CIBlockElement::GetByID($arItem['ID'])->GetNextElement()->GetFields()['ACTIVE'];?>
    <div class="grid-item product-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="box <?if($arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE']){?>company<?}?>">
            <? if ($arItem['PROPERTIES']['PHOTOS']['VALUE']):
                $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450, 'height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <div class="img">
                    <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $arItem['NAME'] ?>">
                    <? if ($arItem["PROPERTIES"]['AUTHOR']['VALUE'] != $arItem["PROPERTIES"]['NAME']['VALUE'] && is_numeric($arItem["PROPERTIES"]['NAME']['VALUE'])) {
                        $companyData = CIBlockElement::GetByID($arItem["PROPERTIES"]['NAME']['VALUE'])->GetNextElement()->GetProperties();
                        if (!empty($companyData)) {
                            $logo = CFile::ResizeImageGet($companyData['LOGO']['VALUE'], array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                            <img class="company-logo" src="<?= $logo["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                        <? }
                    } ?>
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
                <?
                if($arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE']){?>
                     <div class="category-location">
                        <div class="category"><?= $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['NAME'] ?></div>
                        <div class="location"><?= $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'] ?></div>
                    </div>
                <?}else{?>
                    <div class="location-date">
                        <div class="location"><?= $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'] ?></div>
                        <? if (!empty($arItem['DISPLAY_PROPERTIES']['PRICE'])) {
                            ?>
                            <time datetime="<?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arItem['TIMESTAMP_X']))) ?>"
                                  class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></time>
                        <? } ?>
                    </div>
                <? } ?>
                <? if (!empty($arItem['DISPLAY_PROPERTIES']['PRICE'])) {
                    ?>
                    <div class="price"><? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != 0 && $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != NULL) {
                            echo $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] . " BGN";
                        } else {
                            echo "Договорная";
                        } ?></div>
                <? } ?>
            </div>
            <? if ($APPLICATION->GetCurPage() == SITE_DIR."personal/ads-list/" || $APPLICATION->GetCurPage() == SITE_DIR."personal/company-list/" || $_POST['id']) { ?>
                <?if($active=='N'){?>
                <div class="overlay overlay-disabled">
                    <p>Деактивировано</p>
                </div>
                <?}?>
                <div class="overlay">
                    <div class="row overlay-inner">
                        <div class="col-xs-12 col-md-4">
                            <a href="/personal/<?if($arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE']){?>company<?}else{?>announcement<?}?>/?edit=Y&CODE=<?= $arItem['ID'] ?>" class="overlay-link">
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
                     
                        <div class="col-xs-12 col-md-4">
                            <a onclick="editItem(<?= $arItem['ID']?>,<?= $arItem['IBLOCK_ID']?>,'<?if($active=='Y'){?>N<?}elseif($active=='N'){?>Y<?}?>')"  class="overlay-link">
                                <?if($active=='Y'){?>
                                    <div class="overlay-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 256 256" enable-background="new 0 0 256 256" xml:space="preserve">
                                            <g><g><path fill="#526172" d="M80.1,147.5c-1.9-5.2-2.9-10.8-2.9-16.7C77.2,136.7,78.3,142.4,80.1,147.5L80.1,147.5z M21.5,130.9L21.5,130.9c0,7.3,10.2,21.4,28.3,33.8l30.4-17.1v0l-30.4,17.1C31.7,152.2,21.5,138.2,21.5,130.9z M208.1,88.4l-8.2,4.6c24,13.2,37.9,30.7,37.9,40.1c0,14.8-42,57.6-107,57.6c-28.8,0-53-8.4-71.1-19l-8.2,4.6c20.3,12.7,47.8,22.6,79.3,22.6c67.7,0,115.3-45.3,115.3-65.8C245.9,121.2,231.8,102.7,208.1,88.4z M136.1,129.7l39-21.9c4.7,7.5,7.4,16.3,7.4,25.9c0,27.6-22.5,49.4-51.2,49.4c-19.6,0-36.3-10.1-45-25.4l18.3-10.3c2.7,1.1,5.8,1.7,9,1.7C125.4,149.1,134.9,140.7,136.1,129.7z M128.5,73.3c23.4,0,43.9,5.4,60.6,13.1C172.4,78.7,151.9,73.3,128.5,73.3c-64.9,0-106.9,42.8-107,57.6c0,0,0,0,0,0C21.5,116,63.5,73.3,128.5,73.3z M245.2,64l-39.3,22.1l-8.2,4.6L172.3,105l-38.9,21.9l-31.5,17.7l-18.3,10.3l-26.1,14.6l-8.2,4.6l-35.3,19.8l-3.9-6.9l31.8-17.8c-17.9-13.1-28.5-28-28.5-38.2c0-22,49-65.8,115.3-65.8c26.8,0,50.4,6.9,69.2,16.5L241.3,57L245.2,64z M132.5,118.1L132.5,118.1c-0.4-1.3-0.9-2.6-1.6-3.9c0-0.1-0.1-0.1-0.1-0.2c0,0,0-0.1,0-0.1c-3.8-6.9-11.3-11.5-20-11.5c-12.7,0-22.7,9.6-22.7,21.9c0,6,2.4,11.3,6.2,15.2h0l0,0l13.7-7.7L132.5,118.1C132.5,118.2,132.5,118.2,132.5,118.1z M189,86.4c-16.7-7.7-37.2-13.1-60.6-13.1c-64.9,0-107,42.8-107,57.6c0,0,0,0,0,0c0,0,0,0,0,0c0,7.3,10.2,21.3,28.3,33.8l30.4-17.1v0l0,0c-1.9-5.2-2.9-10.8-2.9-16.7c0-27.6,22.5-49.4,51.2-49.4c15.8,0,29.6,6.5,39,17L189,86.4z M130.8,114.1c0,0,0-0.1,0-0.1C130.8,114,130.8,114.1,130.8,114.1z M94.3,139.6l13.7-7.7L94.3,139.6C94.3,139.6,94.3,139.6,94.3,139.6z M132.5,118.1L132.5,118.1c-0.4-1.3-0.9-2.6-1.6-3.9C131.6,115.5,132.1,116.8,132.5,118.1z M130.9,114.3c0-0.1-0.1-0.1-0.1-0.2C130.8,114.1,130.9,114.2,130.9,114.3z M88.1,124.4c0,6,2.4,11.2,6.2,15.2h0C90.4,135.7,88,130.4,88.1,124.4c0-12.3,10-21.9,22.7-21.9c8.7,0,16.2,4.6,20,11.4c-3.8-6.8-11.3-11.4-20-11.4C98.1,102.6,88.1,112.2,88.1,124.4z M108,131.9l24.5-13.7v0L108,131.9z"/></g></g>
                                        </svg>
                                    </div>
                                <div class="overlay-text">деактивировать</div>
                                 <?}elseif($active=='N'){?>
                                <div class="overlay-icon">
                                    <svg version="1.1" id="Шар_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 256 256" style="enable-background:new 0 0 256 256;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path fill="#526172" d="M210.5,89.9c-1.2,0.2-2.4,0.1-3.4-0.6c-0.1-0.1-0.2-0.1-0.3-0.2l-3.6,2c0,0,0,0,0,0c1.8,1.2,2.8,3.2,2.4,5.2
                                                c20.4,12.7,32.1,28.1,32.1,36.7c0,14.8-42,57.6-107,57.6c-26.7,0-49.4-7.2-67-16.7c-0.6,1.8-2.4,3.4-4.4,3.5
                                                c0.3,0.4,0.6,0.9,0.9,1.3c0.6,1,0.9,2,0.8,2.9c19,10,42.9,17.1,69.7,17.1c59.1,0,118.2-39.3,115.3-65.8c-1.3-12-16.1-29.3-30-39.4
                                                C213.9,92,211.9,90.8,210.5,89.9z"/>
                                            <path fill="#526172" d="M178.6,114.6c-1.7,0.4-3.6,0.1-4.7-1.3c-0.9-1.1-1.8-2.3-2.6-3.4l-33.7,18.9c0.1,1.4,0.1,2.8,0,4.2c-0.2,2.6-2,4.2-4,4.7
                                                c-3.8,6.8-11.2,11.4-20,11.4c-2,0-3.9-0.3-5.7-0.7c-0.7,0.1-1.5,0.1-2.2-0.1c-0.5-0.2-1-0.4-1.6-0.6l-17.9,10.1
                                                c8.7,15.3,25.4,25.4,45,25.4c28.7,0,51.2-21.8,51.2-49.4C182.5,126.9,181.1,120.4,178.6,114.6z"/>
                                            <path fill="#526172" d="M165.1,100.3c-0.9-1.6-0.8-3.1-0.2-4.4c-9.3-8.9-22-14.4-36.5-14.4c-28.7,0-51.2,21.8-51.2,49.4c0,0,0,0,0-0.1
                                                c0,0,0,0,0,0.1c0,0,0,0,0,0c0,5.3,0.8,10.4,2.4,15.1c1.3,0.6,2.3,1.7,2.5,3.1c0.1,0.5,0.2,1,0.4,1.6c0,0,0,0.1,0,0.1
                                                c0.1,0.1,0.1,0.3,0.1,0.3c0,0.1,0.1,0.3,0.2,0.5c0,0,0.1,0,0.1,0.1c0.1,0.1,0.3,0.3,0.4,0.4c0,0,0,0,0,0c1.4,1,2.2,2.4,2.3,4
                                                l2-1.1l14.6-8.2c-2.8-1.5-5.2-3.4-7.2-6.1c-0.3-0.4-0.4-0.7-0.6-1.1l-0.1,0.1c-3.8-3.9-6.2-9.2-6.2-15.2c0-12.2,10-21.7,22.7-21.8
                                                c-12.7,0-22.7,9.6-22.7,21.8c0,0,0,0,0,0c0-12.3,10-21.9,22.7-21.9c8.7,0,16.2,4.6,20,11.5v0.1c1.1,0.3,2.2,0.9,3,2.2
                                                c2.1,3.2,3.2,6.9,3.6,10.7l32.8-18.5C168.4,105.8,166.6,103.1,165.1,100.3z"/>
                                            <path fill="#526172" d="M198.2,82.3c-1.3-0.8-2.1-2.2-2.4-3.6c-17.7-8-39.1-13.6-63.1-13.6C66.5,65.2,17.5,109,17.5,131
                                                c0,9.5,18.3,32.8,33.9,45.2c1.3-1.1-6-11.2-4.2-10.7c-0.4-0.9-0.5-1.8-0.3-2.9c-16.3-11.9-25.4-24.8-25.4-31.7
                                                c0-14.8,42.1-57.6,107-57.6c0,0,0,0,0,0c-65,0-106.9,42.7-106.9,57.6c0.1-14.8,42.1-57.6,106.9-57.6c21.7,0,40.9,4.7,56.8,11.5
                                                c1.4-1.2,3.5-1.7,5.6-0.6c3.8,2.1,7.7,3.9,11.3,6.3l3.6-2C203.2,86.4,200.8,84,198.2,82.3z"/>
                                            <path fill="#526172" d="M46.8,162.6c-16.2-11.9-25.3-24.8-25.3-31.7C21.5,137.8,30.6,150.7,46.8,162.6C46.8,162.6,46.8,162.6,46.8,162.6z"/>
                                        </g>
                                    </g>
                                        <path fill="#526172" d="M46.8,162.6l17,11.4l-2.8,7.8c-1.6-0.9-3.2-1.8-4.8-2.9c-6-4-10.6-8.5-14-12.5C43.8,165.1,45.3,163.9,46.8,162.6z"/>
                                        <path fill="#526172" d="M130.8,114c1.3,1.8,2.9,4.6,3.8,8.3c1.8,7.1-0.1,13-1.1,15.4l45.1-23.1c-1.1-3-3-7.4-6.5-11.8c-2.5-3.1-5.1-5.4-7.2-6.9C153.5,101.9,142.2,107.9,130.8,114z"/>
                                        <polyline fill="#526172" points="79.6,146 86.3,157.7 104.2,147.6 98.9,146 "/>
                                        <path fill="#526172" d="M188.7,119.5"/>
                                        <path fill="#526172" d="M154.3,142.7"/>
                                        <path fill="#526172" d="M225.5,131.1"/>
                                    </svg>
                                </div>
                                <div class="overlay-text">активировать</div>
                                <?}?>
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <a onclick="deleteItem(<?= $arItem['ID']?>, <?= $arItem['IBLOCK_ID']?>);" class="overlay-link">
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
            <? if ($APPLICATION->GetCurPage() != SITE_DIR."personal/ads-list/" && $APPLICATION->GetCurPage() != SITE_DIR."personal/company-list/") { ?>
                <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                   data-favorite-entity="<?= $arItem['ID'] ?>"
                   data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
                </a>
            <?}?>
        </div>
    </div>
<? endforeach;
if(count((array)$arResult["ITEMS"])==0){
    if($APPLICATION->GetCurPage() == SITE_DIR."personal/ads-list/"){?>
        У вас нет объявлений
    <?}elseif($APPLICATION->GetCurPage() == SITE_DIR."personal/company-list/") { ?>
        Список компаний пуст
    <?}else{?>
        Список избранного пуст
<? }
}?>


