<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="swiper-wrapper">
    <?
    foreach ($arResult['BANNERS_PROPERTIES'] as $key => $banner) {
        if ($banner['AD_TYPE'] == 'image') {
            $file = CFile::ResizeImageGet($banner['IMAGE_ID'], array('width' => 370, 'height' => 600), BX_RESIZE_IMAGE_EXACT, true); ?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-1">
                    <a <?if($banner['URL_TARGET']){?>target="<?= $banner['URL_TARGET']?>" <?}?>href="<?= $banner['URL'] ?>" class="box -adv">
                        <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $banner['NAME'] ?>">
                    </a>
                </div>
            </div>
        <? } elseif ($banner['AD_TYPE'] == 'html') {?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-1">
                    <?= $banner['CODE'] ?>
                </div>
            </div>
        <? }
    } ?>
</div>