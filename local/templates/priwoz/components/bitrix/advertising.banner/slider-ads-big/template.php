<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="swiper-wrapper">
    <? shuffle($arResult['BANNERS_PROPERTIES']);
    foreach ($arResult['BANNERS_PROPERTIES'] as $key => $banner) {
        if ($banner['AD_TYPE'] == 'image') {
            $file = CFile::ResizeImageGet($banner['IMAGE_ID'], array('width' => 1570, 'height' => 160), BX_RESIZE_IMAGE_EXACT, true); ?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-3">
                    <a href="<?= $banner['URL'] ?>">
                        <img <?if($banner['CODE']!=NULL){?>class="d-sm-none d-md-block"<?}?> src="<?= $file['src'] ?>" alt="<?= $banner['NAME'] ?>">
                        <?if($banner['CODE']!=NULL){?>
                            <?=  str_replace('<img', '<img class="d-none d-sm-block d-md-none"', $banner['CODE']); ?>
                        <?}?>

                    </a>
                </div>
            </div>
        <? } elseif ($banner['AD_TYPE'] == 'html') {?>
            <div class="swiper-slide">
                <div class="advertisement advertisement-type-3">
                    <?= $banner['CODE'] ?>
                </div>
            </div>
        <? }
    } ?>
</div>