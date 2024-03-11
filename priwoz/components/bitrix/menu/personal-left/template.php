<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <div class="sidebar">
        <div class="personal-widget">
            <?if(\Bitrix\Main\Engine\CurrentUser::get()->getId()){
                if($USER->GetParam("PERSONAL_PHOTO")){
                    $userPhoto = CFile::GetPath($USER->GetParam("PERSONAL_PHOTO"));
                }else{
                    $userPhoto = SITE_TEMPLATE_PATH."/images/icons/user.svg";
                }?>
                <div class="author-box">
<!--<div class="avatar"><img src="--><?//= CFile::ResizeImageGet($USER->GetParam("PERSONAL_PHOTO"), array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']; ?><!--" class="bg-img" alt="--><?//= \Bitrix\Main\Engine\CurrentUser::get()->getFullName() ?><!--"></div>-->
                <div class="avatar"><img src="<?=$userPhoto?>" class="bg-img" alt="<?=\Bitrix\Main\Engine\CurrentUser::get()->getFullName()?>"></div>
                <div class="name"><?=\Bitrix\Main\Engine\CurrentUser::get()->getFullName()?></div>
            </div>
            <?}?>
            <ul class="menu">
                <?
                foreach($arResult as $arItem):
                    if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                        continue;
                    ?>
                    <?if($arItem["SELECTED"]):?>
                    <li><a href="<?=$arItem["LINK"]?>" <?if($arItem['PARAMS']['data-open']){?>data-open="<?=$arItem['PARAMS']['data-open']?>"<?}?> class="selected active"><?=$arItem['PARAMS']['icon']?><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li><a href="<?=$arItem["LINK"]?>" <?if($arItem['PARAMS']['data-open']){?>data-open="<?=$arItem['PARAMS']['data-open']?>"<?}?>><?=$arItem['PARAMS']['icon']?><?=$arItem["TEXT"]?></a></li>
                <?endif?>

                <?endforeach?>
            </ul>
            <?endif?>
        </div>
    </div>
