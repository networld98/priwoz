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
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>

<div class="products-wrap">
    <div class="grid products-masonry">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
<?php
Bitrix\Main\Loader::includeModule('neti.favorite');
$defaultClass = \Bitrix\Main\Config\Option::get('neti.favorite',
    'removeClass');
?>
<?$i=0;
foreach($arResult["ITEMS"] as $arItem):?>
	<?
    $i++;
    if(($i==6 || $i==12 || $i==18) || (count((array)$arResult["ITEMS"])<6 && $i==3 )){?>
    <div class="grid-item product-grid-item">
          <?$APPLICATION->IncludeComponent(
            "bitrix:advertising.banner",
            "",
            Array(
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
        );?>
    </div>
    <?}
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="grid-item product-grid-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?= $arItem["DETAIL_PAGE_URL"]?>" class="box">
            <?if($arItem['PROPERTIES']['PHOTOS']['VALUE']):
                $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width'=>450, 'height'=>450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <div class="img">
                    <img class="bg-img" src="<?=$file['src']?>" alt="<?=$arItem['NAME']?>">
                </div>
            <?endif;?>
            <div class="text">
                <h2 class="product-title"><?= $arItem["NAME"]?></h2>
                <div class="location-date">
                    <div class="location"><?=$arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME']?></div>
                    <time datetime="<?=strtolower(FormatDate("d m Y", MakeTimeStamp($arItem['TIMESTAMP_X']))) ?>" class="date"><?=strtolower(FormatDate("d M Y", MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></time>
                </div>
                <div class="price"><?if($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']!= 0 && $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']!= NULL){ echo $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']." BGN";}else{ echo "Договорная";}?></div>
            </div>
        </a>
        <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
           data-favorite-entity="<?=$arItem['ID'] ?>"
           data-iblock-id="<?=$arItem['IBLOCK_ID'] ?>">
        </a>
    </div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="load-more-box">
        <a href="/" class="blue-link">Все объявления</a>
    </div>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
