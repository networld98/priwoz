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
$payActive  = Option::get("priwoz.option", "pay_on_company");
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
                $arSelect = array("NAME", "PROPERTY_YOUTUBE_PREVIEW", "PROPERTY_YOUTUBE", "PROPERTY_YOUTUBE_IN_MAIN", "PROPERTY_COMPANY", "PREVIEW_PICTURE", "TIMESTAMP_X");
                $arFilter = array("IBLOCK_ID"=>25, "PROPERTY_COMPANY_VALUE" != NULL, "PROPERTY_YOUTUBE_VALUE"!= NULL,"PROPERTY_YOUTUBE_IN_MAIN_VALUE" => "Y" );
                $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    if($arFields["PROPERTY_COMPANY_VALUE"] && $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"] && !in_array($arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"],$videoArray)){
                        $companyLogo = CIBlockElement::GetByID($arFields["PROPERTY_COMPANY_VALUE"])->GetNextElement()->GetProperties()["LOGO"]["VALUE"];
                        $logo = CFile::ResizeImageGet($companyLogo, array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $picture = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width' => 400), BX_RESIZE_IMAGE_EXACT, true);
                        $videoArray[] = $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"];
                        print_r($arFields['PROPERTY_TOP_VALUE']);
                        ?>
                    <div class="grid-item company-grid-item">
                        <div class="box -video youtube-open-trigger" data-youtube="<?=$arFields["PROPERTY_YOUTUBE_VALUE"]?>">
                            <div class="img">
                                <?if($arFields['PROPERTY_YOUTUBE_PREVIEW_VALUE']!='Y'){?>
                                    <img class="bg-img" src="<?= $picture["src"]?>" alt="<?=$arFields["NAME"]?>-video">
                                <?}else{?>
                                    <img class="bg-img" src="https://i.ytimg.com/vi/<?=$arFields['PROPERTY_YOUTUBE_VALUE']?>/maxresdefault.jpg" alt="<?=$arFields["NAME"]?>-video">
                                <?}?>
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
                <div class="img<?if(!$picture && $logo){?> -default<?}?>">
                    <?
                    if($arItem["PROPERTIES"]['TOP']['VALUE']=='Y'){?>
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 70 87.5" x="0px" y="0px"><path d="M50,28.7H38.14a1,1,0,0,1-1-.9,7.73,7.73,0,0,1,.46-3.07c.06-.16.11-.34.17-.52a6.31,6.31,0,0,0,.39-1.57,7.74,7.74,0,0,0-.48-3.19c-1-2.31-2.23-2.31-2.63-2.31a2.29,2.29,0,0,0-.55.07A17,17,0,0,1,31.63,28l-3.23,4.7s0,0,0,.06v11.8a2.23,2.23,0,0,0,.78,1.27,2,2,0,0,0,1.31.43l14.24-.08a1.37,1.37,0,0,0,1-.38,1.42,1.42,0,0,0,.45-1.07,1.44,1.44,0,0,0-1-1.36,1,1,0,0,1-.71-1.11,1,1,0,0,1,1-.85h1.51a1.41,1.41,0,0,0,1-.43,1.4,1.4,0,0,0,.41-1,1.43,1.43,0,0,0-1.43-1.43,1,1,0,0,1,0-2h1.22a1.37,1.37,0,0,0,1-.42,1.4,1.4,0,0,0,.42-1,1.47,1.47,0,0,0-1.5-1.48,1,1,0,0,1-1-1,1,1,0,0,1,.83-1l.24,0H50a1.43,1.43,0,0,0,1.42-1.44,1.34,1.34,0,0,0-.41-1A1.36,1.36,0,0,0,50,28.7Z"/><path d="M58.86,32.2a5.41,5.41,0,0,1-1.8-6.71,3.42,3.42,0,0,0-2.8-4.84,5.41,5.41,0,0,1-4.91-4.91,3.42,3.42,0,0,0-4.82-2.81h0a5.42,5.42,0,0,1-6.7-1.79,3.42,3.42,0,0,0-5.59,0,5.42,5.42,0,0,1-6.72,1.81,3.41,3.41,0,0,0-4.84,2.8,5.41,5.41,0,0,1-4.91,4.91,3.41,3.41,0,0,0-2.8,4.84,5.42,5.42,0,0,1-1.79,6.71,3.42,3.42,0,0,0,0,5.59,5.42,5.42,0,0,1,1.81,6.71,3.42,3.42,0,0,0,2.8,4.85,5.41,5.41,0,0,1,4.91,4.91,3.42,3.42,0,0,0,4.84,2.8,5.44,5.44,0,0,1,6.71,1.79,3.41,3.41,0,0,0,5.59,0,5.42,5.42,0,0,1,6.71-1.8,3.44,3.44,0,0,0,4.85-2.8,5.41,5.41,0,0,1,4.91-4.91,3.43,3.43,0,0,0,2.8-4.84s0,0,0,0a5.41,5.41,0,0,1,1.81-6.67,3.42,3.42,0,0,0,0-5.6Zm-7.72,1.15a3.51,3.51,0,0,1-.56,4.13,3.62,3.62,0,0,1-.77.58,3.41,3.41,0,0,1-2,5.17,3.42,3.42,0,0,1,.33,1.45,3.3,3.3,0,0,1-1,2.44,3.25,3.25,0,0,1-2.43,1l-14.25.08A3.94,3.94,0,0,1,28,47.4a2.4,2.4,0,0,1-2,1.13H18.68a1,1,0,0,1-1-1V31.3a1,1,0,0,1,1-1H26a2.39,2.39,0,0,1,1.32.4L30,26.83a15,15,0,0,0,2.47-10.17,1,1,0,0,1,.5-1,4.54,4.54,0,0,1,2.11-.53c1.35,0,3.22.62,4.48,3.54a9.71,9.71,0,0,1,.63,4,8,8,0,0,1-.49,2.17c0,.16-.11.33-.16.5a10,10,0,0,0-.35,1.36H50a3.35,3.35,0,0,1,2.44,1,3.31,3.31,0,0,1,1,2.38A3.44,3.44,0,0,1,51.14,33.35Z"/><path d="M26.36,32.53A.4.4,0,0,0,26,32.3H19.68V46.53H26a.42.42,0,0,0,.41-.41V44.67a3.1,3.1,0,0,1-.05-.54Z"/><path d="M65.28,29.78a4.38,4.38,0,0,1-1.44-5.42,6.38,6.38,0,0,0-5.22-9,4.37,4.37,0,0,1-4-4,6.38,6.38,0,0,0-9-5.21A4.37,4.37,0,0,1,40.21,4.7a6.27,6.27,0,0,0-2.27-2A6.38,6.38,0,0,0,35,2a6.3,6.3,0,0,0-5.22,2.71,4.37,4.37,0,0,1-5.42,1.45,6.38,6.38,0,0,0-9,5.21,4.38,4.38,0,0,1-4,4,6.38,6.38,0,0,0-5.21,9A4.37,4.37,0,0,1,4.7,29.79a6.38,6.38,0,0,0,0,10.43,4.36,4.36,0,0,1,1.45,5.41,6.37,6.37,0,0,0,5.21,9,4.37,4.37,0,0,1,4,4,6.38,6.38,0,0,0,9,5.22,4.37,4.37,0,0,1,5.42,1.46,6.37,6.37,0,0,0,10.43,0,4.39,4.39,0,0,1,5.38-1.46l0,0a6.38,6.38,0,0,0,9-5.22,4.37,4.37,0,0,1,4-4,6.37,6.37,0,0,0,5.21-9,4.39,4.39,0,0,1,1.47-5.42h0a6.37,6.37,0,0,0,0-10.42ZM60,39.45a3.42,3.42,0,0,0-1.12,4.21l0,0a5.42,5.42,0,0,1-4.45,7.64,3.42,3.42,0,0,0-3.1,3.1,5.41,5.41,0,0,1-7.67,4.43A3.43,3.43,0,0,0,39.43,60,5.35,5.35,0,0,1,35,62.31h0A5.37,5.37,0,0,1,30.57,60a3.42,3.42,0,0,0-4.24-1.15,5.41,5.41,0,0,1-7.67-4.43,3.42,3.42,0,0,0-3.1-3.1,5.42,5.42,0,0,1-4.44-7.67A3.41,3.41,0,0,0,10,39.44a5.43,5.43,0,0,1,0-8.87,3.43,3.43,0,0,0,1.15-4.24,5.41,5.41,0,0,1,4.43-7.67,3.42,3.42,0,0,0,3.1-3.1,5.42,5.42,0,0,1,7.67-4.44A3.41,3.41,0,0,0,30.56,10a5.43,5.43,0,0,1,8.87,0,3.42,3.42,0,0,0,4.21,1.16l0,0a5.42,5.42,0,0,1,7.67,4.44,3.42,3.42,0,0,0,3.1,3.1,5.41,5.41,0,0,1,4.43,7.67A3.42,3.42,0,0,0,60,30.56a5.42,5.42,0,0,1,0,8.89Z"/></svg>                    <?}?>
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
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]&& $APPLICATION->GetCurPage() != SITE_DIR):?>
        <div id="pager-wrap">
            <?= $arResult["NAV_STRING"] ?>
        </div>
    <?else:?>
        <div class="load-more-box">
            <a href="<?=SITE_DIR?>companies/" class="btn btn-gray"><?=GetMessage("T_COM_ALL")?></a>
        </div>
    <?endif;?>
</div>

