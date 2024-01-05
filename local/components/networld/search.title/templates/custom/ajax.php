<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
    <table class="title-search-result">
        <span>Первые <?=$arParams['TOP_COUNT']?> результатов</span>
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                <tr>
                    <?if(isset($arItem["ICON"])):?>
                        <td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?><?if($arItem['SPEC'] != NULL){?>(<?=$arItem['SPEC']?>)<?}?></a></td>
                    <?else:?>
                        <td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
                    <?endif;?>
                </tr>
            <?endforeach;?>
        <?endforeach;?>
    </div><div class="title-search-fader"></div>
<?endif;
?>