<?
global $userIdItem,$userIdAd,$iblokId;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["isFormErrors"] == "Y"):?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
<?= $arResult["FORM_NOTE"] ?>
<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <div class="title"><?=GetMessage("FORM_TITLES")?></div>
    <div class="subtitle"><?=GetMessage("FORM_SUBTITLE")?></div>
    <?= $arResult["FORM_HEADER"] ?>
    <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') { ?>
            <? if ($arQuestion['STRUCTURE'][0]['ID'] == 1) { ?>
                <input type="hidden" name="form_hidden_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                       value="https://priwoz.info/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=<?=$iblokId?>&type=ads&lang=ru&ID=<?=$userIdAd?>">
            <? } elseif ($arQuestion['STRUCTURE'][0]['ID'] == 2) { ?>
                <input type="hidden" name="form_hidden_<?= $arQuestion['STRUCTURE'][0]['ID'] ?>"
                       value="https://priwoz.info/bitrix/admin/user_edit.php?lang=ru&ID=<?=$userIdItem?>">
            <? } ?>
        <? } else {
            ?>
            <?= $arQuestion["HTML_CODE"] ?>
            <?
        }
    } //endwhile
    ?>
    <div class="form-text"><?= GetMessage("FORM_OK")?></div>
    <div class="btn-box">
        <input type="submit" class="btn btn-green" name="web_form_submit"
               value="<?= GetMessage("FORM_SUBMIT")?>">
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)