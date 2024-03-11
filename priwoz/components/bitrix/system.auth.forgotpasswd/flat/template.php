<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
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
                <div class="bx-authform">
                    <?
                    if (!empty($arParams["~AUTH_RESULT"])):
                        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                        ?>
                        <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
                    <? endif ?>

                    <h3 class="bx-title"><?= GetMessage("AUTH_GET_CHECK_STRING") ?></h3>

                    <p class="bx-authform-content-container"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></p>

                    <form name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
                        <? if ($arResult["BACKURL"] <> ''): ?>
                            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <? endif ?>
                        <input type="hidden" name="AUTH_FORM" value="Y">
                        <input type="hidden" name="TYPE" value="SEND_PWD">

                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-input-container">
                                <label class="form-label -with-icon">
                                    <span class="input-icon -name"></span>
                                    <input class="form-control" type="text" name="USER_LOGIN" maxlength="255"
                                           value="<?= $arResult["USER_LOGIN"] ?>" placeholder="<? echo GetMessage("AUTH_LOGIN_EMAIL") ?>"/>
                                    <input class="form-control"  type="hidden" name="USER_EMAIL"/>
                                </label>
                                <div class="bx-authform-note-container"><? echo GetMessage("forgot_pass_email_note") ?></div>
                            </div>
                        </div>
                        <? if ($arResult["PHONE_REGISTRATION"]): ?>
                            <div class="bx-authform-formgroup-container">
                                <div class="bx-authform-label-container"><? echo GetMessage("forgot_pass_phone_number") ?></div>
                                <div class="bx-authform-input-container">
                                    <input type="text" name="USER_PHONE_NUMBER" maxlength="255"
                                           value="<?= $arResult["USER_PHONE_NUMBER"] ?>"/>
                                </div>
                                <div class="bx-authform-note-container"><? echo GetMessage("forgot_pass_phone_number_note") ?></div>
                            </div>
                        <? endif ?>

                        <? if ($arResult["USE_CAPTCHA"]): ?>
                            <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>

                            <div class="bx-authform-formgroup-container">
                                <div class="bx-authform-label-container"><? echo GetMessage("system_auth_captcha") ?></div>
                                <div class="bx-captcha"><img
                                            src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                            width="180" height="40" alt="CAPTCHA"/></div>
                                <div class="bx-authform-input-container">
                                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                                </div>
                            </div>

                        <? endif ?>
                        <div class="bx-authform-link-container">
                            <a href="<?= $arResult["AUTH_AUTH_URL"] ?>"><b><?= GetMessage("AUTH_AUTH") ?></b></a>
                        </div>
                        <div class="bx-authform-formgroup-container">
                            <input type="submit" class="btn btn-green" name="send_account_info"
                                   value="<?= GetMessage("AUTH_SEND") ?>"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.bform.onsubmit = function () {
        document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
    };
    document.bform.USER_LOGIN.focus();
</script>
