<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
    <table class="title-search-result">
        <tr>
            Первые 10 результатов
        </tr>
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                <tr>
                    <?if(isset($arItem["ICON"])):?>
                        <td class="title-search-item"><a href="<?if($arItem['PARAM2'] == 20 || $arItem['PARAM2'] == 21 || $arItem['PARAM2'] == 22 ){?>https://lib.webdoc.clinic<?}?><?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?> <?if($arItem['SPEC'] != NULL && $arItem['PARAM2'] == 10){?>(<?=$arItem['SPEC']?>)<?}?></a></td>
                    <?else:?>
                        <td class="title-search-more"><a href="<?if($arItem['PARAM2'] == 20 || $arItem['PARAM2'] == 21 || $arItem['PARAM2'] == 22 ){?>https://lib.webdoc.clinic<?}?><?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
                    <?endif;?>
                </tr>
            <?endforeach;?>
        <?endforeach;?>
    </table><div class="title-search-fader"></div>
<?endif;
?>