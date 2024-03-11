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
use Bitrix\Main\Config\Option;
$payActive  = Option::get("priwoz.option", "pay_on");
?>
<div class="companies-wrap" id="companies-wrap">
    <div class="grid companies-masonry">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        <?php
        Bitrix\Main\Loader::includeModule('neti.favorite');
        $defaultClass = \Bitrix\Main\Config\Option::get('neti.favorite',
            'removeClass');
        ?>
        <?
        $videoArray = [];
        ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            //Получаем дату окончания действия елемента и текущую
            $date=DateTime::createFromFormat('d.m.Y H:i:s', CIBlockElement::GetByID($arItem['ID'])->GetNextElement()->GetFields()['ACTIVE_TO']);
            $dateNow = new DateTime();
            $i++;
            if ($i == 3 || $i == 12 || $i == 18) {
                ?>
                <div class="grid-item company-grid-item">
                    <div class="advertisement-slider swiper-container">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "slider-company",
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
                            "TYPE" => "companiesblock"
                        )
                    ); ?>
                    </div>
                </div>
            <?
            }elseif ($i % 2 == 0) {
                $arSelect = array("NAME", "PROPERTY_YOUTUBE","PROPERTY_YOUTUBE_IN_MAIN","PROPERTY_COMPANY", "PREVIEW_PICTURE", "TIMESTAMP_X");
                $arFilter = array("IBLOCK_ID"=>25, "PROPERTY_COMPANY_VALUE" != NULL, "PROPERTY_YOUTUBE_VALUE"!= NULL,"PROPERTY_YOUTUBE_IN_MAIN_VALUE" => "Y" );
                $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    if($arFields["PPROPERTY_COMPANY"] && $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"] && !in_array($arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"],$videoArray)){
                        $companyLogo = CIBlockElement::GetByID($arFields["PROPERTY_COMPANY_VALUE"])->GetNextElement()->GetProperties()["LOGO"]["VALUE"];
                        $logo = CFile::ResizeImageGet($companyLogo, array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $picture = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width' => 400), BX_RESIZE_IMAGE_EXACT, true);
                        $videoArray[] = $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"];
                        ?>
                    <div class="grid-item company-grid-item">
                        <div class="box -video youtube-open-trigger" data-youtube="<?=$arFields["PROPERTY_YOUTUBE_VALUE"]?>">
                            <div class="img">
                                <img class="bg-img" src="<?=$picture['src']?>" alt="<?=$arFields["NAME"]?>">
                                <img class="company-logo" src="<?=$logo['src']?>" alt="<?=$arFields["NAME"]?>">
                                <div class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arFields['TIMESTAMP_X']))) ?></div>
                            </div>
                            <div class="text">
                                <h2 class="company-title"><?=$arFields["NAME"]?></h2>
                            </div>
                        </div>
                    </div>
                        <?
                    }
                }
            }
            if(($arItem["PROPERTIES"]['MODERATION']['VALUE']!='Y' && ($date>=$dateNow || $payActive == 'N')) || $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID()){

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $logo = CFile::ResizeImageGet($arItem["PROPERTIES"]['LOGO']['VALUE'], array('width' => 100,'height'=> 100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $picture = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450,'height'=> 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <div class="grid-item company-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">
                <div class="img <?if(!$picture && $logo){?>-default<?}?>">
                    <?if($arItem["PROPERTIES"]['MODERATION']['VALUE']=='Y' && $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID() && ($date>=$dateNow || $payActive == 'N')){?>
                        <div class="overlay">
                            <p><?=GetMessage("T_ADS_NONE")?></p>
                        </div>
                    <?}?>
                    <?if($date<$dateNow && $payActive == "Y"){?>
                        <div class="overlay">
                            <p><?=GetMessage("T_ADS_BUY")?>
                                <?/*<span onclick="window.location.href='<?=SITE_DIR?>personal/company-list/'" class="btn btn-orange">Перейти к оплате</span>*/?>
                            </p>
                        </div>
                    <?}?>
                    <?
                    if($picture){?>
                    <img class="bg-img" src="<?= $picture["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <?}else{?>
                        <div class="default-text"><?=GetMessage("T_DEFAULT_PHOTO")?></div>
                    <?}?>
                    <?if($logo){?>
                        <img class="company-logo" src="<?= $logo["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <?}?>
                </div>
                <div class="text">
                    <h2 class="company-title"><?= $arItem['NAME'] ?></h2>
                    <div class="category-location">
                        <? if (SITE_ID == 's1') {
                            $locationName = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'];
                        }
                        if (SITE_ID == 'ua') {
                            $locationId = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['ID'];
                            $locationName = CIBlockElement::GetByID($locationId)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                        }?>
                        
                        <?
                        if(SITE_ID=='s1'){
                            if($arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['DISPLAY_VALUE']){
                                $categoryName = $arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['VALUE']]['NAME'] ;
                            }else{
                                $categoryName = $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['NAME'] ;
                            }
                        }elseif(SITE_ID=='ua'){
                            if($arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['DISPLAY_VALUE']){
                                $id = $arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['VALUE']]['ID'];
                                $categoryName = CIBlockElement::GetByID($id)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                            }else{
                                $id = $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['ID'];
                                $categoryName  = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>22, 'ID'=>$id), false, array('UF_NAME_UA'))->GetNext()['UF_NAME_UA'];
                            }
                        }
                        ?>
                        <div class="category"><?= $categoryName ?></div>
                        <div class="location"><?= $locationName ?></div>
                    </div>
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
    <? if (count($arResult["ITEMS"]) == 0): ?>
        <section class="not-found-section">
            <div class="container">
                <div class="bg-box">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-xl-4">
                             <h5><? ShowNote(GetMessage("CT_NOT_COMPANY")); ?></h5>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-5">
                            <div class="img">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/404-cat.png" alt="404 Priwoz">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
</div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
