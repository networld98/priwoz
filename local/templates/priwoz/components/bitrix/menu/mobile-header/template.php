<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
    <li <?if($arItem['PARAMS']['data-open']){?>class="item-has-child"<?}?>><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$arItem["TEXT"]?> <?if($arItem['PARAMS']['data-open']){?><span class="arrow"></span><?}?></a>
    <?if($arItem['PARAMS']['data-open']){?>
        <ul class="menu sub-menu">
            <?
            $arSelect = array("NAME", "CODE", "UF_ICON");
            $arFilter = array("IBLOCK_ID" => 22, "ACTIVE" => "Y");
            $obSections = CIBlockSection::GetList(array("name" => "asc"), $arFilter, false, $arSelect);
            while($ar_result = $obSections->GetNext())
            {if($ar_result['UF_ICON']){?>
                <li>
                    <a href="/companies/?category=<?=$ar_result['CODE']?>">
                        <?=htmlspecialchars_decode($ar_result['UF_ICON'])?>
                        <?=$ar_result['NAME']?>
                    </a>
                </li>
            <?}
            }?>
        </ul>
    </li>
    <?}else{?>
        </li>
    <?}?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

<?endif?>