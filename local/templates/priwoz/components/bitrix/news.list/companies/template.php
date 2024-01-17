<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');
?>
<div class="companies-wrap">
    <div class="grid companies-masonry">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        <?php
        Bitrix\Main\Loader::includeModule('neti.favorite');
        $defaultClass = \Bitrix\Main\Config\Option::get('neti.favorite',
            'removeClass');
        ?>
        <?
        $videoArray = [];
        ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $i++;
            if ($i == 3 || $i == 12 || $i == 18) {
                ?>
                <div class="grid-item company-grid-item">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        array(
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
                            "TYPE" => "companiesblock"
                        )
                    ); ?>
                </div>
            <?
            }elseif ($i % 2 == 0) {
                $arSelect = array("NAME", "PROPERTY_YOUTUBE","PROPERTY_YOUTUBE_IN_MAIN","PROPERTY_COMPANY", "PREVIEW_PICTURE", "TIMESTAMP_X");
                $arFilter = array("IBLOCK_ID"=>25, "PROPERTY_COMPANY_VALUE" != NULL, "PROPERTY_YOUTUBE_VALUE"!= NULL,"PROPERTY_YOUTUBE_IN_MAIN_VALUE" => "Y" );
                $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    if($arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"] && !in_array($arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"],$videoArray)){
                        $companyLogo = CIBlockElement::GetByID($arFields["PROPERTY_COMPANY_VALUE"])->GetNextElement()->GetProperties()["LOGO"]["VALUE"];
                        $logo = CFile::ResizeImageGet($companyLogo, array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $picture = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $videoArray[] = $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"];
                        ?>
                    <div class="grid-item company-grid-item">
                        <div class="box -video youtube-open-trigger" data-youtube="<?=$arFields["PROPERTY_YOUTUBE_VALUE"]?>">
                            <div class="img">
                                <img class="bg-img" src="<?=$picture['src']?>" alt="<?=$arFields["NAME"]?>">
                                <img class="company-logo" src="<?=$logo['src']?>" alt="<?=$arFields["NAME"]?>">
                                <div class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arFields['TIMESTAMP_X']))) ?></div>
                            </div>
                            <div class="text">
                                <h2 class="company-title"><?=$arFields["NAME"]?></h2>
                            </div>
                        </div>
                    </div>
                        <?
                    }
                }
                ?>

                <?
            }
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <div class="grid-item company-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">
                <div class="img">
                    <?
                    $logo = CFile::ResizeImageGet($arItem["PROPERTIES"]['LOGO']['VALUE'], array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <img class="bg-img" src="<?= $picture["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <img class="company-logo" src="<?= $logo["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                </div>
                <div class="text">
                    <h2 class="company-title"><?= $arItem['NAME'] ?></h2>
                    <div class="category-location">
                        <div class="category"><?= $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['NAME'] ?></div>
                        <div class="location"><?= $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'] ?></div>
                    </div>
                </div>
                </a>
                <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                   data-favorite-entity="<?= $arItem['ID'] ?>"
                   data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
                </a>
            </div>
        <? endforeach; ?>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
