<?
global $userIdItem,$userIdAd,$iblokId;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["isFormErrors"] == "Y"):?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
<?= $arResult["FORM_NOTE"] ?>
<? if ($arResult["isFormNote"] != "Y") {
    ?>
    <div class="title">Пожаловаться</div>
    <div class="subtitle">Отметьте нарушения:</div>
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
    <? /*
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
*/
    ?>
    <div class="form-text">Нарушения обязательно проверит модератор</div>
    <div class="btn-box">
        <input type="submit" class="btn btn-green" name="web_form_submit"
               value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>">
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)