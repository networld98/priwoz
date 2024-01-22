<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
$imgFile = SITE_TEMPLATE_PATH . '/images/icons/upload-file.svg';
?>
<h1 class="page-title">Профиль</h1>
<div class="bx-auth-profile profile-form">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=$arResult["FORM_TARGET"]?>">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table class="profile-table data-table">
	<tbody>
		<tr>
			<td><?echo GetMessage("main_profile_code")?><span class="starrequired">*</span></td>
			<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
		</tr>
	</tbody>
</table>

<p><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_profile_send")?>" /></p>

</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_profile_resend',
	errorContainerId: 'bx_profile_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_profile_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_profile_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_profile_resend"></div>

<?else:?>

<script type="text/javascript">
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if ($arResult["opened"] <> '')
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

    <div class="upload-file-custom">
        <div class="upload-title-label"><?=GetMessage('USER_PHOTO')?></div>
        <div class="upload-image-box">
            <?
            if ($arResult['arUser']['PERSONAL_PHOTO']) {
                $imgFile = CFile::ResizeImageGet($arResult['arUser']['PERSONAL_PHOTO'], array('width' => 100, 'height' => 100), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
            } ?>
            <input name="PERSONAL_PHOTO" id="PERSONAL_PHOTO" class="typefile" size="20" type="file" accept=".png, .jpg, .jpeg, .pdf">
            <label for="PERSONAL_PHOTO" for="customFileInput" id="customFileInputLabel" class="upload-image -default"
                   data-default="<?=SITE_TEMPLATE_PATH?>/images/icons/upload-file.svg"
                   data-pdf="<?=SITE_TEMPLATE_PATH?>/images/icons/PDF_Logo.svg">
                <img id="previewImage" class="preview-image"
                     src="<?=$imgFile?>" alt="Preview">
            </label>
            <span class="bx-input-file-desc">
                  <input type="checkbox" name="PERSONAL_PHOTO_del" value="Y" id="PERSONAL_PHOTO_del">
                  <label for="PERSONAL_PHOTO_del">Удалить файл</label>
            </span>
            <div class="hint">Допустимые форматы: png, jpg, pdf до 1 mb</div>
        </div>
    </div>

    <h2>Контактные данные *</h2>
    <div class="row">
        <div class="form-group col-xs-12 col-md-6">
            <label class="form-label -with-icon">
                <span class="input-icon -name"></span>
                <input type="text" name="NAME" maxlength="50" class="form-control"  value="<?=$arResult["arUser"]["NAME"]?>" placeholder="<?=GetMessage('NAME')?>" autocomplete="off" />
            </label>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label class="form-label -with-icon">
                <span class="input-icon -name"></span>
                <input type="text" name="LAST_NAME" maxlength="50" class="form-control"  value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="<?=GetMessage('LAST_NAME')?>" autocomplete="off" />
            </label>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label class="form-label -with-icon">
                <span class="input-icon -email"></span>
                <input type="text" name="EMAIL" maxlength="50" class="form-control"  value="<? echo $arResult["arUser"]["EMAIL"]?>" placeholder="<?=GetMessage('EMAIL')?>" autocomplete="off" />
            </label>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label class="form-label -with-icon">
                <span class="input-icon -phone"></span>
                <input type="text" name="PERSONAL_PHONE" class="form-control"  maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" placeholder="<?=GetMessage('USER_PHONE')?>">
            </label>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label class="form-label -with-icon">
                <span class="input-icon -phone"></span>
                <input type="text" class="form-control" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" placeholder="<?=GetMessage('USER_MOBILE')?>">
            </label>
        </div>
        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
            <div class="form-group col-xs-12 col-md-6">
                <label class="form-label -with-icon">
                    <span class="input-icon -<?=strtolower($arUserField['LIST_COLUMN_LABEL'])?>"></span>
                    <input type="text" class="form-control" name="<?=$arUserField['FIELD_NAME']?>" maxlength="255" value="<?=$arUserField['VALUE']?>" placeholder="<?=$arUserField['LIST_COLUMN_LABEL']?>">
                </label>
            </div>
        <?endforeach;?>
    </div>

    <?if($arResult['CAN_EDIT_PASSWORD']):?>
        <h2>Ваш пароль</h2>
        <div class="row">
            <div class="form-group col-xs-12 col-md-6">
                <div class="input-group">
                    <label class="form-label password-label -with-icon">
                        <span class="input-icon -password"></span>
                        <input type="password" class="bx-auth-input form-control" id="passwordInput"
                               name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off"  placeholder="<?=GetMessage('NEW_PASSWORD_REQ')?>">
                        <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                    </label>
                        <?if($arResult["SECURE_AUTH"]):?>
                            <span class="bx-auth-secure" id="bx_auth_secure"
                                  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
                                    <div class="bx-auth-secure-icon"></div>
                                </span>
                                            <noscript>
                                <span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
                                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                </span>
                            </noscript>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure').style.display = 'inline-block';
                            </script>
                            </td>
                            </tr>
                        <? endif ?>
                </div>
            </div>
            <div class="form-group col-xs-12 col-md-6">
                <div class="input-group">
                    <label class="form-label password-label -with-icon">
                        <span class="input-icon -password"></span>
                        <input type="password" class="form-control" id="confirmPasswordInput"
                               name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>">
                        <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                    </label>
                </div>
            </div>
        </div>
    <?endif?>
    <div class="text-xs-center">
        <input type="submit" name="save" class="btn btn-green" value="сохранить">
    </div>
</form>
<?/*
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}*/
?>

<?endif?>

</div>