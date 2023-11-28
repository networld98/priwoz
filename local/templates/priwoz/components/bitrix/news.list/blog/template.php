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
<div class="blog-posts">
    <?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
  /* echo "<pre>";print_r($arItem['PROPERTIES']['YOUTUBE']['VALUE']);
        echo "</pre>";*/
    ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arItem['PROPERTIES']['YOUTUBE']['VALUE']) {?>
                <div class="box -video video-open-trigger" data-video="/images/home/video_example.mp4">
            <?}else{?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"]?>" class="box">
            <?}?>
                <div class="img">
                    <img src="<?= $picture["src"]?>" class="bg-img" alt="<?=$arItem['NAME']?>">
                    <div class="date"><?=strtolower(FormatDate("d M Y", MakeTimeStamp($arItem['TIMESTAMP_X']))) ?></div>
                </div>
                <div class="text">
                    <h3><?=$arItem['NAME']?></h3>
                </div>
            <? if ($arItem['PROPERTIES']['YOUTUBE']['VALUE']) { ?>
                </div>
            <? } else { ?>
                </a>
            <? } ?>
        </div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="btn-box d-xs-block d-md-none">
        <a href="/" class="btn btn-gray">посмотреть блог</a>
    </div>
<?endif;?>

