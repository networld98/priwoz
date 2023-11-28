<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
         <li <?if($arItem['PARAMS']['data-open']){?>class="item-has-child"<?}?>><a href="<?=$arItem["LINK"]?> class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
        <li <?if($arItem['PARAMS']['data-open']){?>class="item-has-child"<?}?>><a href="<?=$arItem["LINK"]?>><?=$arItem["TEXT"]?></a></li>
	<?endif?>
    <?if($arItem['PARAMS']['data-open']){?>
        <ul class="menu sub-menu">
            <?
            $arSelect = array("NAME", "CODE", "UF_ICON");
            $arFilter = array("IBLOCK_ID"=>22);
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {if($ar_result['UF_ICON']){?>
                <li>
                    <a href="/">
                        <?=htmlspecialchars_decode($ar_result['UF_ICON'])?>
                        <?=$ar_result['NAME']?>
                    </a>
                </li>
            <?}
            }?>
        </ul>
    <?}?>
<?endforeach?>
</ul>
<?endif?>