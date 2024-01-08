<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

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

            <?endif?>

