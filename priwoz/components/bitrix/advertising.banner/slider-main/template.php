<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="swiper-wrapper">
    <? shuffle($arResult['BANNERS_PROPERTIES']);
    foreach ($arResult['BANNERS_PROPERTIES'] as $key => $banner) {
        if ($banner['IMAGE_ID']) {
            $file = CFile::ResizeImageGet($banner['IMAGE_ID'], array('width' => 1570, 'height' => 130), BX_RESIZE_IMAGE_EXACT, true); ?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-1">
                    <a href="<?= $banner['URL'] ?>" class="box">
                        <img class="bg-img" src="<?= $file['src'] ?>" alt="<?= $banner['NAME'] ?>">
                    </a>
                </div>
            </div>
        <? } else {
            ?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-1">
                    <?= $banner['CODE'] ?>
                </div>
            </div>
        <? }
    } ?>
</div>