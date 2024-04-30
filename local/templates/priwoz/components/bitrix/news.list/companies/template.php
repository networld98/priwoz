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
use Bitrix\Main\Config\Option;
$payActive  = Option::get("priwoz.option", "pay_on_company");
?>
<div class="companies-wrap" id="companies-wrap">
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
            //Получаем дату окончания действия елемента и текущую
            $date=DateTime::createFromFormat('d.m.Y H:i:s', CIBlockElement::GetByID($arItem['ID'])->GetNextElement()->GetFields()['ACTIVE_TO']);
            $dateNow = new DateTime();
            $i++;
            if ($i == 3 || $i == 12 || $i == 18) {
                ?>
                <div class="grid-item company-grid-item">
                    <div class="advertisement-slider swiper-container">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "slider-company",
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
                            "CACHE_TYPE" => "N",
                            "COMPONENT_TEMPLATE" => "",
                            "NOINDEX" => "Y",
                            "QUANTITY" => "5",
                            "TYPE" => "companiesblock"
                        )
                    ); ?>
                    </div>
                </div>
            <?
            }elseif ($i % 2 == 0) {
                $arSelect = array("NAME", "PROPERTY_YOUTUBE_PREVIEW", "PROPERTY_YOUTUBE", "PROPERTY_YOUTUBE_IN_MAIN", "PROPERTY_COMPANY", "PREVIEW_PICTURE", "TIMESTAMP_X");
                $arFilter = array("IBLOCK_ID"=>25, "PROPERTY_COMPANY_VALUE" != NULL, "PROPERTY_YOUTUBE_VALUE"!= NULL,"PROPERTY_YOUTUBE_IN_MAIN_VALUE" => "Y" );
                $res = CIBlockElement::GetList(Array("name" => "asc"), $arFilter, false, Array(), $arSelect);
                while($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    if($arFields["PROPERTY_COMPANY_VALUE"] && $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"] && !in_array($arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"],$videoArray)){
                        $companyLogo = CIBlockElement::GetByID($arFields["PROPERTY_COMPANY_VALUE"])->GetNextElement()->GetProperties()["LOGO"]["VALUE"];
                        $logo = CFile::ResizeImageGet($companyLogo, array('width' => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $picture = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width' => 400), BX_RESIZE_IMAGE_EXACT, true);
                        $videoArray[] = $arFields["PROPERTY_YOUTUBE_IN_MAIN_VALUE"];
                        ?>
                    <div class="grid-item company-grid-item">
                        <div class="box -video youtube-open-trigger" data-youtube="<?=$arFields["PROPERTY_YOUTUBE_VALUE"]?>">
                            <div class="img">
                                <?if($arFields['PROPERTY_YOUTUBE_PREVIEW_VALUE']!='Y'){?>
                                    <img class="bg-img" src="<?= $picture["src"]?>" alt="<?=$arFields["NAME"]?>-video">
                                <?}else{?>
                                    <img class="bg-img" src="https://i.ytimg.com/vi/<?=$arFields['PROPERTY_YOUTUBE_VALUE']?>/maxresdefault.jpg" alt="<?=$arFields["NAME"]?>-video">
                                <?}?>
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
            }
            if(($arItem["PROPERTIES"]['MODERATION']['VALUE']!='Y' && ($date>=$dateNow || $payActive == 'N')) || $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID()){

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $logo = CFile::ResizeImageGet($arItem["PROPERTIES"]['LOGO']['VALUE'], array('width' => 100,'height'=> 100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $picture = CFile::ResizeImageGet($arItem['PROPERTIES']['PHOTOS']['VALUE'][0], array('width' => 450,'height'=> 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <div class="grid-item company-grid-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="box">
                <div class="img<?if(!$picture && $logo){?> -default<?}?>">
                    <?
                    if($arItem["PROPERTIES"]['TOP']['VALUE']=='Y'){?>
                        <svg width="72" height="35" viewBox="0 0 72 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9368 42.9043C9.36459 41.5568 6.74882 40.1782 4.68853 38.1616C0.839762 34.393 -0.566762 28.7352 0.202561 23.603C0.972243 18.4716 3.69529 13.8258 7.08974 9.87875C10.1271 6.34621 13.8095 3.23173 18.2213 1.46546C22.6324 -0.300812 27.8384 -0.606218 32.3064 1.3006C35.339 2.59481 37.9256 4.83242 41.063 5.84591C46.1265 7.48093 51.5765 5.64528 56.848 6.24572C62.3369 6.87084 67.4796 10.3379 70.0248 15.1289C72.8 20.3537 72.4382 26.6649 70.2581 31.9999C68.0779 37.3355 64.2558 41.8479 60.2216 46.021C55.4145 50.994 49.54 55.899 42.3889 55.9985C37.2125 56.0707 32.3301 53.5863 27.7171 51.1703C22.4571 48.4148 17.1968 45.6594 11.9368 42.9043Z" fill="#52A823"/>
                            <path d="M22.793 18.9375V36H19.957V18.9375H22.793ZM27.1406 18.9375V21.3281H15.6562V18.9375H27.1406ZM40.6406 26.0742V28.9805C40.6406 30.1836 40.5 31.2383 40.2188 32.1445C39.9453 33.0508 39.5469 33.8086 39.0234 34.418C38.5078 35.0195 37.8828 35.4727 37.1484 35.7773C36.4219 36.082 35.6094 36.2344 34.7109 36.2344C33.8203 36.2344 33.0078 36.082 32.2734 35.7773C31.5469 35.4727 30.918 35.0195 30.3867 34.418C29.8633 33.8086 29.457 33.0508 29.168 32.1445C28.8867 31.2383 28.7461 30.1836 28.7461 28.9805V26.0742C28.7461 24.8555 28.8867 23.7891 29.168 22.875C29.4492 21.9531 29.8516 21.1836 30.375 20.5664C30.9062 19.9492 31.5352 19.4844 32.2617 19.1719C32.9961 18.8594 33.8047 18.7031 34.6875 18.7031C35.5859 18.7031 36.3984 18.8594 37.125 19.1719C37.8594 19.4844 38.4883 19.9492 39.0117 20.5664C39.5352 21.1836 39.9375 21.9531 40.2188 22.875C40.5 23.7891 40.6406 24.8555 40.6406 26.0742ZM37.8164 28.9805V26.0508C37.8164 25.1836 37.7461 24.4414 37.6055 23.8242C37.4727 23.1992 37.2734 22.6914 37.0078 22.3008C36.7422 21.9023 36.4141 21.6094 36.0234 21.4219C35.6406 21.2266 35.1953 21.1289 34.6875 21.1289C34.1953 21.1289 33.7539 21.2266 33.3633 21.4219C32.9805 21.6094 32.6523 21.9023 32.3789 22.3008C32.1133 22.6914 31.9102 23.1992 31.7695 23.8242C31.6367 24.4414 31.5703 25.1836 31.5703 26.0508V28.9805C31.5703 29.832 31.6406 30.5664 31.7812 31.1836C31.9219 31.793 32.125 32.293 32.3906 32.6836C32.6641 33.0664 32.9961 33.3516 33.3867 33.5391C33.7773 33.7266 34.2188 33.8203 34.7109 33.8203C35.2109 33.8203 35.6562 33.7266 36.0469 33.5391C36.4375 33.3516 36.7617 33.0664 37.0195 32.6836C37.2852 32.293 37.4844 31.793 37.6172 31.1836C37.75 30.5664 37.8164 29.832 37.8164 28.9805ZM55.0781 18.9375V36H52.2422V21.3281H46.4297V36H43.582V18.9375H55.0781Z" fill="white"/>
                        </svg>
                    <?}?>
                    <?if($arItem["PROPERTIES"]['MODERATION']['VALUE']=='Y' && $arItem["PROPERTIES"]['AUTHOR']['VALUE']==$USER->GetID() && ($date>=$dateNow || $payActive == 'N')){?>
                        <div class="overlay">
                            <p><?=GetMessage("T_ADS_NONE")?></p>
                        </div>
                    <?}?>
                    <?if($date<$dateNow && $payActive == "Y"){?>
                        <div class="overlay">
                            <p><?=GetMessage("T_ADS_BUY")?>
                                <?/*<span onclick="window.location.href='<?=SITE_DIR?>personal/company-list/'" class="btn btn-orange">Перейти к оплате</span>*/?>
                            </p>
                        </div>
                    <?}?>
                    <?
                    if($picture){?>
                    <img class="bg-img" src="<?= $picture["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <?}else{?>
                        <div class="default-text"><?=GetMessage("T_DEFAULT_PHOTO")?></div>
                    <?}?>
                    <?if($logo){?>
                        <img class="company-logo" src="<?= $logo["src"] ?>" alt="<?= $arItem['NAME'] ?>">
                    <?}?>
                </div>
                <div class="text">
                    <h2 class="company-title"><?= $arItem['NAME'] ?></h2>
                    <div class="category-location">
                        <? if (SITE_ID == 's1') {
                            $locationName = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'];
                        }
                        if (SITE_ID == 'ua') {
                            $locationId = $arItem["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['ID'];
                            $locationName = CIBlockElement::GetByID($locationId)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                        }?>
                        
                        <?
                        if(SITE_ID=='s1'){
                            if($arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['DISPLAY_VALUE']){
                                $categoryName = $arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['VALUE']]['NAME'] ;
                            }else{
                                $categoryName = $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['NAME'] ;
                            }
                        }elseif(SITE_ID=='ua'){
                            if($arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['DISPLAY_VALUE']){
                                $id = $arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['LINK_ELEMENT_VALUE'][$arItem["DISPLAY_PROPERTIES"]['SUBCATEGORY']['VALUE']]['ID'];
                                $categoryName = CIBlockElement::GetByID($id)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                            }else{
                                $id = $arItem["DISPLAY_PROPERTIES"]['CATEGORY']['LINK_SECTION_VALUE'][$arItem["DISPLAY_PROPERTIES"]['CATEGORY']['VALUE']]['ID'];
                                $categoryName  = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>22, 'ID'=>$id), false, array('UF_NAME_UA'))->GetNext()['UF_NAME_UA'];
                            }
                        }
                        ?>
                        <div class="category"><?= $categoryName ?></div>
                        <div class="location"><?= $locationName ?></div>
                    </div>
                </div>
                </a>
                <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                   data-favorite-entity="<?= $arItem['ID'] ?>"
                   data-iblock-id="<?= $arItem['IBLOCK_ID'] ?>">
                </a>
            </div>
        <?}
            endforeach; ?>
    </div>
    <? if (count($arResult["ITEMS"]) == 0): ?>
        <section class="not-found-section">
            <div class="container">
                <div class="bg-box">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-xl-4">
                             <h5><? ShowNote(GetMessage("CT_NOT_COMPANY")); ?></h5>
                        </div>
                        <div class="col-xs-12 col-md-6 col-xl-5">
                            <div class="img">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/404-cat.png" alt="404 Priwoz">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]&& $APPLICATION->GetCurPage() != SITE_DIR):?>
        <div id="pager-wrap">
            <?= $arResult["NAV_STRING"] ?>
        </div>
    <?else:?>
        <div class="load-more-box">
            <a href="<?=SITE_DIR?>companies/" class="btn btn-gray"><?=GetMessage("T_COM_ALL")?></a>
        </div>
    <?endif;?>
</div>

