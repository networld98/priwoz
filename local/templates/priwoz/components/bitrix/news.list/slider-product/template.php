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
$this->setFrameMode(true); ?>
<section class="other-products-section">
    <div class="container">
        <div class="title-wrap">
            <div class="section-title">Другие объявления автора</div>
            <div class="swiper-navigation">
                <div class="swiper-button-prev other-products-swiper-button-prev"></div>
                <div class="swiper-button-next other-products-swiper-button-next"></div>
            </div>
        </div>
        <div class="other-products-slider-box">
            <div class="other-products-slider swiper-container">
                <div class="swiper-wrapper">
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
                        <div class="swiper-slide">
                            <div class="grid-item product-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">

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
                                            <img class="bg-img" src="<?= $picture["src"] ?>"
                                                 alt="<?= $arItem['NAME'] ?>">
                                            <img class="company-logo" src="<?= $logo["src"] ?>"
                                                 alt="<?= $arItem['NAME'] ?>">
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
                                </a>
                                <? if ($APPLICATION->GetCurPage() == "/personal/ads-list/") { ?>
                                    <a href="/personal/announcement/?edit=Y&CODE=<?= $arItem['ID'] ?>" class="box">Редактировать</a>
                                <? } ?>
                                <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                                   data-favorite-entity="<?= $arItem['ID'] ?>"
                                   data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
                                </a>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>

        <div class="load-more-box">
            <a href="/" class="blue-link">Все объявления автора</a>
        </div>
    </div>
</section>

