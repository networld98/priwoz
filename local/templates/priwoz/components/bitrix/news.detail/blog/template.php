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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
CUtil::InitJSCore(array('fx'));
$pictureID = CIBlockElement::GetByID($arResult["ID"])->GetNextElement()->GetFields()["PREVIEW_PICTURE"];
$picture = CFile::ResizeImageGet($pictureID, array('width'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>
<section class="post-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="sticky-block">
                    <div class="author-box">
                        <div class="avatar-box">
                            <div class="avatar">
                                <img src="<?=SITE_DIR?>images/home/ava.png" class="bg-img" alt="ava">
                            </div>
                        </div>
                        <div class="name"><?=GetMessage("T_NEWS_NAME_AUTHOR")?></div>
                    </div>
                    <div class="description"><?=GetMessage("T_NEWS_DESCRIPTION")?></div>
                </div>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="post-wrap">
                    <time datetime="<?= strtolower(strftime('%d.%b.%Y', MakeTimeStamp($arResult['TIMESTAMP_X']))) ?>" class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arResult['TIMESTAMP_X']))) ?></time>
                    <h1 class="section-title"><?=$arResult["NAME"]?></h1>
                    <?if($arResult['PROPERTIES']['YOUTUBE']['VALUE']!='') {?>
                    <div class="video-box youtube-open-trigger" data-youtube="<?=$arResult['PROPERTIES']['YOUTUBE']['VALUE']?>">
                        <img class="bg-img" src="<?= $picture["src"]?>" alt="<?=$arResult["NAME"]?>-video">
                    </div>
                    <?}?>
                    <div class="content">
                        <?=$arResult['PREVIEW_TEXT']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'bx-newsdetail-slider-container',
			leftArrowClassName: 'bx-newsdetail-slider-arrow-container-left',
			rightArrowClassName: 'bx-newsdetail-slider-arrow-container-right',
			controlContainerClassName: 'bx-newsdetail-slider-control'
		});
	});
</script>
