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
    <?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>400,'height'=> 400), BX_RESIZE_IMAGE_EXACT, true);
    ?>
        <div class="<? if($APPLICATION->GetCurPage() != SITE_DIR."blog/"){?>item<?}else{?>grid-item blog-grid-item<?}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arItem['PROPERTIES']['YOUTUBE']['VALUE']!='' && $arItem['PROPERTIES']['YOUTUBE_IN_MAIN']['VALUE'] == 'Y' && $APPLICATION->GetCurPage() == "/") {?>
                <div class="box -video youtube-open-trigger" data-youtube="<?=$arItem['PROPERTIES']['YOUTUBE']['VALUE']?>">
            <?}else{?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"]?>" class="box">
            <?}?>
                <div class="img">
                    <img src="<?= $picture["src"]?>" class="bg-img" alt="<?=$arItem['NAME']?>">
                    <div class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></div>
                </div>
                <div class="text">
                    <h3><?=$arItem['NAME']?></h3>
                </div>
            <? if ($arItem['PROPERTIES']['YOUTUBE']['VALUE'] && $arItem['PROPERTIES']['YOUTUBE_IN_MAIN']['VALUE'] == 'Y' && $APPLICATION->GetCurPage() == "/") {?>
                </div>
            <? } else { ?>
                </a>
            <? } ?>
        </div>
<?endforeach;?>

