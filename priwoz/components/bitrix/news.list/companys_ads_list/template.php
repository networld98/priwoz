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
$payActive = "Y";
if(count((array)$arResult["ITEMS"])>0){?>
<section class="products-overview-min-section -company">
    <div class="bg-overlay">
        <div class="container">
            <div class="section-title -min"><?= GetMessage("CT_TITLE") ?></div>
            <div class="products-wrap">
                <div id="products-wrap">
                    <div class="grid products-masonry" id="products-masonry">
                        <div class="grid-sizer"></div>
                        <div class="gutter-sizer"></div>
                        <? $i = 0;

                        //Получаем дату окончания действия елемента и текущую
                        $date=DateTime::createFromFormat('d.m.Y H:i:s', CIBlockElement::GetByID($arItem['ID'])->GetNextElement()->GetFields()['ACTIVE_TO']);
                        $dateNow = new DateTime();

                        foreach ($arResult["ITEMS"] as $arItem):
                        if(($arItem["PROPERTIES"]['MODERATION']['VALUE']!='Y' &&  ($date>=$dateNow || $payActive == 'N'))  || $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID()){
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="grid-item product-grid-item ads-item"
                                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">
                                    <? if ($arItem['PROPERTIES']['PHOTOS']['VALUE']):
                                        $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450, 'height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
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
                                            } ?>
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
        </div>
    </div>
</section>
<?}?>
