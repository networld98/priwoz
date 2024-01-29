<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
    <div class="title"><?=GetMessage("FORM_ADD_COMM")?></div>
    <div class="subtitle"><?=GetMessage("FORM_WRITE")?></div>
<?=$arResult["FORM_HEADER"]?>

	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
            <div class="form-group">
                <h2>
                    <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                        <span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
                    <?endif;?>
                    <?=$arQuestion["CAPTION"]?> <?if ($arQuestion["REQUIRED"] == "Y"):?>*<?endif;?>
                </h2>
                <label class="form-label">
                    <?=$arQuestion["HTML_CODE"]?>
                </label>
            </div>
	<?
		}
	} //endwhile
	?>
    <div class="required-text"><?=GetMessage("FORM_REQUIRED_FIELDS")?></div>
    <div class="text-xs-center">
        <input type="submit" class="btn btn-green" name="web_form_submit" value="<?=GetMessage("FORM_ADD_COMM")?>">
    </div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)