<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>
<div class="bx-newslist">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row">
<?$i=0;
foreach($arResult["ITEMS"] as $arItem):?>
	<?
    $i++;
    if(($i==6 || $i==12 || $i==18) || (count((array)$arResult["ITEMS"])<6 && $i==3 )){?>
    <div class="bx-newslist-container col-sm-6 col-md-3">
        <div class="bx-newslist-block">
          <?$APPLICATION->IncludeComponent(
            "bitrix:advertising.banner",
            "",
            Array(
                "BS_ARROW_NAV" => "N",
                "BS_BULLET_NAV" => "Y",
                "BS_CYCLING" => "N",
                "BS_EFFECT" => "fade",
                "BS_HIDE_FOR_PHONES" => "Y",
                "BS_HIDE_FOR_TABLETS" => "N",
                "BS_KEYBOARD" => "Y",
                "BS_PAUSE" => "Y",
                "BS_WRAP" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "",
                "NOINDEX" => "Y",
                "QUANTITY" => "5",
                "TYPE" => "asdblock"
            )
        );?>
        </div>
    </div>
    <?}
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="bx-newslist-container col-sm-6 col-md-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<div class="bx-newslist-block">
		<?if($arItem['PROPERTIES']['PHOTOS']['VALUE']):
            $file = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width'=>450, 'height'=>450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <div class="bx-newslist-img">
                <img src="<?=$file['src']?>" alt="<?=$arItem['NAME']?>">
            </div>
		<?endif;?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<h3 class="bx-newslist-title">
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
				<?else:?>
					<?echo $arItem["NAME"]?>
				<?endif;?>
			</h3>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="bx-newslist-content">
			<?echo $arItem["PREVIEW_TEXT"];?>
			</div>
		<?endif;?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<?if($code == "SHOW_COUNTER"):?>
				<div class="bx-newslist-view"><i class="fa fa-eye"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
					<?=intval($value);?>
				</div>
			<?elseif(
				$value
				&& (
					$code == "SHOW_COUNTER_START"
					|| $code == "DATE_ACTIVE_FROM"
					|| $code == "ACTIVE_FROM"
					|| $code == "DATE_ACTIVE_TO"
					|| $code == "ACTIVE_TO"
					|| $code == "DATE_CREATE"
					|| $code == "TIMESTAMP_X"
				)
			):?>
				<?
				$value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($value, CSite::GetDateFormat()));
				?>
				<div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
					<?=$value;?>
				</div>
			<?elseif($code == "TAGS" && $value):?>
				<div class="bx-newslist-tags"><i class="fa fa-tag"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
					<?=$value;?>
				</div>
			<?elseif(
				$value
				&& (
					$code == "CREATED_USER_NAME"
					|| $code == "USER_NAME"
				)
			):?>
				<div class="bx-newslist-author"><i class="fa fa-user"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
					<?=$value;?>
				</div>
			<?endif;?>
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<?
			if(is_array($arProperty["DISPLAY_VALUE"]))
				$value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
			else
				$value = $arProperty["DISPLAY_VALUE"];
			?>
			<?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT"):?>
				<div class="bx-newslist-comments"><i class="fa fa-comments"></i> <?=$arProperty["NAME"]?>:
					<?=$value;?>
				</div>
			<?endif;?>
		<?endforeach;?>
		<div class="row">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="col-xs-5">
				<div class="bx-newslist-date"><i class="fa fa-calendar-o"></i> <?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
			</div>
		<?endif?>
		<?if($arParams["USE_RATING"]=="Y"):?>
			<div class="col-xs-7 text-right">
				<?$APPLICATION->IncludeComponent(
					"bitrix:iblock.vote",
					"flat",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_ID" => $arItem["ID"],
						"MAX_VOTE" => $arParams["MAX_VOTE"],
						"VOTE_NAMES" => $arParams["VOTE_NAMES"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
						"SHOW_RATING" => "N",
					),
					$component
				);?>
			</div>
		<?endif?>
		</div>
		<div class="row">
			<div class="col-xs-5">
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<div class="bx-newslist-more"><a class="btn btn-primary btn-xs" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("CT_BNL_GOTO_DETAIL")?></a></div>
			<?endif;?>
			</div>
		<?/*
		if ($arParams["USE_SHARE"] == "Y")
		{
			?>
			<div class="col-xs-7 text-right">
				<noindex>
				<?
				$APPLICATION->IncludeComponent("bitrix:main.share", $arParams["SHARE_TEMPLATE"], array(
						"HANDLERS" => $arParams["SHARE_HANDLERS"],
						"PAGE_URL" => $arItem["~DETAIL_PAGE_URL"],
						"PAGE_TITLE" => $arItem["~NAME"],
						"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
						"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
						"HIDE" => $arParams["SHARE_HIDE"],
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				?>
				</noindex>
			</div>
			<?
		}
		*/?>
		</div>
	</div>
	</div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
