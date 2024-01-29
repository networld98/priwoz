<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

//one css for all system.auth.* forms
?>
<section class="sign-in-section">
    <div class="container">
        <div class="sign-in-wrap">
            <div class="map-overlay">
                <div class="text-box">
                    <div class="title"><?=GetMessage("AUTH_REGISTER_TITLE")?></div>
                    <div class="subtitle"><?=GetMessage("AUTH_REGISTER_SUBTITLE")?></div>
                </div>
            </div>
            <div class="sign-in-box">
                <?
                if(!empty($arParams["~AUTH_RESULT"])):
                    $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                    ?>
                    <div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
                <?endif?>

                <?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
                    <div class="alert alert-success"><?echo GetMessage("AUTH_EMAIL_SENT")?></div>
                <?endif?>

                <?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
                    <div class="alert alert-warning"><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></div>
                <?endif?>

                <div class="bx-authform">
                    <?
                    if($arParams["~AUTH_RESULT"]["TYPE"] != "OK"){

                    $arResult["AUTH_SERVICES"] = false;
                    if(CModule::IncludeModule("socialservices")) {
                        $oAuthManager = new CSocServAuthManager();
                        $arServices = $oAuthManager->GetActiveAuthServices($arResult);
                        if(!empty($arServices)) $arResult["AUTH_SERVICES"] = $arServices;
                    }

                    if($arResult["AUTH_SERVICES"]):?>
                        <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "flat",
                            array(
                                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                                "AUTH_URL"=>$arResult["AUTH_URL"],
                                "POST"=>$arResult["POST"],
                                "POPUP"=>"Y",
                                "SUFFIX"=>"form",
                            ),
                            $component,
                            array("HIDE_ICONS"=>"Y")
                        );?>

                    <?endif?>
                    <h3 class="bx-title"><?=GetMessage("AUTH_REGISTER_EMAIL")?></h3>
                    <?}?>
                    <?if($arResult["SHOW_SMS_FIELD"] == true):?>

                    <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">

                        <input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />

                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-label-container"><span class="bx-authform-starrequired">*</span><?echo GetMessage("main_register_sms_code")?></div>
                            <div class="bx-authform-input-container">
                                <input type="text" name="SMS_CODE" maxlength="255" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" />
                            </div>
                        </div>

                        <div class="bx-authform-formgroup-container">
                            <input type="submit" class="btn btn-green" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />
                        </div>


    <script>
    new BX.PhoneAuth({
        containerId: 'bx_register_resend',
        errorContainerId: 'bx_register_error',
        interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
        data:
            <?=CUtil::PhpToJSObject([
                'signedData' => $arResult["SIGNED_DATA"],
            ])?>,
        onError:
            function(response)
            {
                var errorNode = BX('bx_register_error');
                errorNode.innerHTML = '';
                for(var i = 0; i < response.errors.length; i++)
                {
                    errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
                }
                errorNode.style.display = '';
            }
    });
    </script>

    <div id="bx_register_error" style="display:none" class="alert alert-danger"></div>

    <div id="bx_register_resend"></div>

    <?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>

        <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="REGISTRATION" />


            <?if($arResult["EMAIL_REGISTRATION"]):?>
                <div class="bx-authform-formgroup-container">
                    <div class="bx-authform-input-container">
                    <label class="form-label -with-icon">
                        <span class="input-icon -name"></span>
                        <input type="text" class="form-control" name="USER_EMAIL" maxlength="255"  placeholder="<?=GetMessage("AUTH_EMAIL")?>" value="<?=$arResult["USER_EMAIL"]?>" />
                    </label>
                    </div>
                </div>
            <?endif?>
            <?if($arResult["PHONE_REGISTRATION"]):?>
                <div class="bx-authform-formgroup-container">
                    <div class="bx-authform-input-container">
                        <label class="form-label -with-icon">
                            <span class="input-icon -name"></span>
                            <input type="text" class="form-control" name="USER_PHONE_NUMBER" maxlength="255"  placeholder="<?echo GetMessage("main_register_phone_number")?>" value="<?=$arResult["USER_PHONE_NUMBER"]?>" />
                            <?if($arResult["SECURE_AUTH"]):?>
                                <div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>
                                <script type="text/javascript">
                                    document.getElementById('bx_auth_secure').style.display = '';
                                </script>
                            <?endif?>
                        </label>
                    </div>
                </div>
            <?endif?>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-input-container">
                    <label class="form-label password-label -with-icon">
                        <span class="input-icon -password"></span>
                        <input type="password" class="form-control"  name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_PASSWORD_REQ")?>" autocomplete="off" />
                        <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                    </label>
                </div>
            </div>

            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-input-container">
                    <label class="form-label password-label -with-icon">
                        <span class="input-icon -password"></span>
                        <?if($arResult["SECURE_AUTH"]):?>
                            <div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none"><div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div></div>

                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure_conf').style.display = '';
                            </script>
                        <?endif?>
                        <input type="password"  class="form-control"  name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_CONFIRM")?>" />
                        <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                    </label>
                </div>
            </div>

    <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />

            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    <span class="bx-authform-starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>
                </div>
                <div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
                <div class="bx-authform-input-container">
                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                </div>
            </div>
    <?endif?>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                </div>
                <div class="bx-authform-input-container">
                    <?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                        array(
                            "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                            "IS_CHECKED" => "Y",
                            "AUTO_SAVE" => "N",
                            "IS_LOADED" => "Y",
                            "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                            "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                            "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                            "REPLACE" => array(
                                "button_caption" => GetMessage("AUTH_REGISTER"),
                                "fields" => array(
                                    rtrim(GetMessage("AUTH_NAME"), ":"),
                                    rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                    rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                    rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                    rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                )
                            ),
                        )
                    );?>
                </div>
            </div>
            <div class="bx-authform-link-container">
                <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a>
            </div>
            <div class="bx-authform-formgroup-container">
                <input type="submit" class="btn btn-green" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
            </div>
            <div class="hint">Нажимая кнопку “Зарегистрироваться” вы соглашаетесь с нашей <a href="#">Политикой конфендициальности</a></div>

<!--            <div class="bx-authform-description-container">-->
<!--                <span class="bx-authform-starrequired">*</span>--><?//=GetMessage("AUTH_REQ")?>
<!--            </div>-->

        </form>

    <script type="text/javascript">
    document.bform.USER_NAME.focus();
    </script>

    <?endif?>
                </div>
            </div>
        </div>
    </div>
</section>
