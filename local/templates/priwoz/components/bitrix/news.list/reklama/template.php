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

use Bitrix\Main\Config\Option;

$adsCount = Option::get("priwoz.option", "ads_count");
$adsPercent = Option::get("priwoz.option", "ads_percent");
$adsText = Option::get("priwoz.option", "ads_text");
$adsOkTitle = Option::get("priwoz.option", "ads_ok_title");
$adsOkText = Option::get("priwoz.option", "ads_ok_text");
?>
<section class="community-overview-section">
    <div class="container">
        <div class="title-box">
            <div class="row align-items-md-baseline">
                <div class="col-xs-12">
                    <h1 class="section-title"><?$APPLICATION->ShowTitle(false)?></h1>
                </div>
            </div>
        </div>
        <div class="post-section">
            <div class="post-wrap">
                <?if($_GET['pay'] == 'ok'){?>
                    <div class="pay-ok-message">
                        <h2 class="community-title"><?=$adsOkTitle?></h2><div class="description-ok"><p><?=$adsOkText?></p></div>
                    </div>
                <?}?>
                <p><?=$adsText?></p>
                <div class="table-reklama">
                    <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $props = CIBlockElement::GetByID($arItem["ID"])->GetNextElement()->GetProperties();?>
                        <div class="reklama-item" >
                            <label for="item-<?=$arItem['ID']?>">
                                <input type="checkbox" value="<?=$props["PRICE"]["VALUE"]?>" data-id="<?=$arItem['ID']?>" data-name="(<?=$arItem['ID']?>)<?=$arItem["NAME"]?>">
                                <?=$arItem['NAME']?>
                            </label>
                            <a class="btn btn-orange" href="<?=$props["LINK"]["VALUE"]?>">Перейти</a> <span>цена <strong><?=$props["PRICE"]["VALUE"]?></strong> грн./мес.</span>
                        </div>
                    <?endforeach;?>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-4">
                            <label class="form-label -with-icon">
                                <span class="input-icon -name"></span>
                                <input type="text" name="NAME" maxlength="50" class="form-control" value=""
                                       placeholder="Имя" autocomplete="off">
                            </label>
                            <label class="form-label -with-icon">
                                <span class="input-icon -phone"></span>
                                <input type="text" class="form-control" name="PERSONAL_MOBILE" maxlength="255" value=""
                                       placeholder="Номер телефона">
                            </label>
                            <label class="form-label -with-icon">
                                <span class="input-icon -telegram"></span>
                                <input type="text" class="form-control" name="UF_TELEGRAM" maxlength="255" value=""
                                       placeholder="Ник в Telegram">
                            </label>
                        </div>
                        <div class="form-group col-xs-12 col-md-8 sum-block">
                                <div>Сумма <strong><span id="summ-reklama">0</span> грн.</strong>
                                    <br>
                                    <br>
                                    <a href="#" id="pay-btn" class="overlay-link disabled">
                                        <div class="btn btn-green btn-buy">Оплатить</div>
                                    </a>
                                    <br>
                                    <br>
                                </div>
                                <p>Скидка <strong><?=$adsPercent?>%</strong> от суммы, при отметке от <?=$adsCount?> групп.</p>
                        </div>
                    </div>
                  
                </div>
               
            </div>
        </div>
    </div>
</section>
<script>
    //Проверка выбраной рекламы и пересчет цен перед оплатой
    function updateSelectedValues() {
        let totalValue = 0;
        let selectedNames = [];
        let selectedIds = [];
        let selectedCount = 0;
        let monoValue = 0;

        $('.reklama-item input:checked').each(function() {
            totalValue += parseFloat($(this).val());
            selectedNames.push($(this).data('name'));
            selectedIds.push($(this).data('id'));
            selectedCount++;
        });
        // Применение скидки 10%, если выбрано два или более чекбоксов
        if (selectedCount >= <?=$adsCount?>) {
            totalValue = totalValue / 100 * (100 - <?=$adsPercent?>);
        }
        monoValue =  totalValue * 100;
        // Проверка дополнительных полей
        let name = $('input[name="NAME"]').val();
        let personalMobile = $('input[name="PERSONAL_MOBILE"]').val();
        let ufTelegram = $('input[name="UF_TELEGRAM"]').val();

        if(selectedCount !=0 && name!='' && (personalMobile!='' || ufTelegram!='')){
            $('#pay-btn').removeClass('disabled');
        }else{
            $('#pay-btn').addClass('disabled');
        }
        $('#summ-reklama').text(totalValue);
        $('#selected-names').text('Selected names: ' + selectedNames.join(','));
        $('#selected-ids').text('Selected IDs: ' + selectedIds.join(','));
        $('#pay-btn').attr('href', '/local/scripts/monoPay/pay.php?ids='+selectedIds.join(',')+'&p='+monoValue+'&telegram='+ufTelegram+'&name='+name+'&tel='+personalMobile+'&names='+selectedNames.join(',')+'&link=/reklama/index.php?pay=ok');
    }
</script>