<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="swiper-wrapper">
    <? shuffle($arResult['BANNERS_PROPERTIES']);
    foreach ($arResult['BANNERS_PROPERTIES'] as $key => $banner) {
        if ($banner['AD_TYPE'] == 'image') {
            $file = CFile::ResizeImageGet($banner['IMAGE_ID'], array('width' => 320, 'height' => 500), BX_RESIZE_IMAGE_EXACT, true); ?>
            <div class="swiper-slide">
                <a href="<?= $banner['URL'] ?>" class="box -adv">
                    <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $banner['NAME'] ?>">
                </a>
            </div>
        <? } elseif ($banner['AD_TYPE'] == 'html') {?>
            <div class="swiper-slide">
                <div class="advertisement">
                    <?= $banner['CODE'] ?>
                </div>
            </div>
        <? }
    } ?>
</div>