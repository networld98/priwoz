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
$this->SetViewTarget("countElements");
echo count((array)$arResult["ITEMS"]);
$this->EndViewTarget();
$payActive = "N";?>
<div class="products-wrap">
    <div id="products-wrap">
        <div class="grid products-masonry" id="products-masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
            <? $i = 0;
            foreach ($arResult["ITEMS"] as $arItem):?>
                <?
                //Получаем дату окончания действия елемента и текущую
                $date=DateTime::createFromFormat('d.m.Y H:i:s', CIBlockElement::GetByID($arItem['ID'])->GetNextElement()->GetFields()['ACTIVE_TO']);
                $dateNow = new DateTime();

                if(($arItem["PROPERTIES"]['MODERATION']['VALUE']!='Y' && ($date>=$dateNow || $payActive == 'N')) || $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID()){
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    //Добавляем обьявления
                    $i++;
                    if (($i == 7 || $i == 14 || $i == 18) || (count((array)$arResult["ITEMS"]) < 6 && $i == 3)) {
                        ?>
                        <div class="grid-item product-grid-item">
                            <div class="advertisement-slider swiper-container">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:advertising.banner",
                                    "slider-ads",
                                    array(
                                        "BS_ARROW_NAV" => "N",
                                        "BS_BULLET_NAV" => "Y",
                                        "BS_CYCLING" => "N",
                                        "BS_EFFECT" => "fade",
                                        "BS_HIDE_FOR_PHONES" => "Y",
                                        "BS_HIDE_FOR_TABLETS" => "N",
                                        "BS_KEYBOARD" => "Y",
                                        "BS_PAUSE" => "Y",
                                        "BS_WRAP" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "COMPONENT_TEMPLATE" => "",
                                        "NOINDEX" => "Y",
                                        "QUANTITY" => "5",
                                        "TYPE" => "asdblock"
                                    )
                                ); ?>
                            </div>
                        </div>
                        <?
                    }
                ?>
                <div class="grid-item <?=$i?> product-grid-item ads-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">
                        <? if ($arItem['PROPERTIES']['PHOTOS']['VALUE']):
                            $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450, 'height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                            ?>
                            <div class="img">
                                <?if($arItem["PROPERTIES"]['MODERATION']['VALUE']=='Y' && $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID() && ($date>=$dateNow || $payActive == 'N')){?>
                                    <div class="overlay">
                                        <p><?=GetMessage("T_ADS_NONE")?></p>
                                    </div>
                                <?}?>
                                <?if($date<$dateNow && $payActive == "Y"){?>
                                    <div class="overlay">
                                        <p><?=GetMessage("T_ADS_BUY")?>
                                            <?/*<span onclick="window.location.href='<?=SITE_DIR?>personal/ads-list/'" class="btn btn-orange">Перейти к оплате</span>*/?>
                                        </p>
                                    </div>
                                <?}?>
                                <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $arItem['NAME'] ?>">
                            </div>
                        <? endif; ?>
                        <div class="text">
                            <h2 class="product-title"><?= $arItem["NAME"] ?></h2>
                            <div class="location-date">
                                <? if (SITE_ID == 's1') {
                                    $locationName = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'];
                                }
                                if (SITE_ID == 'ua') {
                                    $locationId = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['ID'];

                                    $locationName = CIBlockElement::GetByID($locationId)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                                }?>
                                <div class="location"><?= $locationName ?></div>
                                <time datetime="<?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arItem['TIMESTAMP_X']))) ?>"
                                      class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></time>
                            </div>
                            <div class="price"><? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != 0 && $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] != NULL) {
                                    echo $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'] . " BGN";
                                } else {
                                    echo GetMessage("CT_DOGOVORNAYA");
                                } ?></div>
                        </div>
                    </a>
                    <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                       data-favorite-entity="<?= $arItem['ID'] ?>"
                       data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
                    </a>
                </div>
            <?}
                endforeach; ?>
        </div>
    </div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <div id="pager-wrap">
            <?= $arResult["NAV_STRING"] ?>
        </div>
    <? endif; ?>
</div>

