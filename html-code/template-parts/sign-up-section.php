<section class="sign-in-section">
    <div class="container">
        <div class="sign-in-wrap">
            <div class="map-overlay">
                <div class="text-box">
                    <div class="title">Priwoz</div>
                    <div class="subtitle">от наших для наших</div>
                </div>
            </div>
            <div class="sign-in-box">
                <div class="bx-authform">
                    <div class="bx-authform-social">
                        <ul>
                            <li>
                                <a id="bx_socserv_icon_Facebook" class="facebook bx-authform-social-icon" href="javascript:void(0)" onclick="BX.util.popup('https://www.facebook.com/dialog/oauth?client_id=722405839754600&amp;redirect_uri=https%3A%2F%2Fpriwoz.info%2Fbitrix%2Ftools%2Foauth%2Ffacebook.php&amp;scope=email,user_friends&amp;display=popup&amp;state=site_id%3Ds1%26backurl%3D%252Fpersonal%252F%253Fcheck_key%253Df6ff31a2868b0253b28070f7609787fb%26redirect_url%3D%252Fpersonal%252F', 680, 600)" title="Facebook">Продолжить через Fasebook</a>
                            </li>
                            <li>
                                <a id="bx_socserv_icon_GoogleOAuth" class="google bx-authform-social-icon" href="javascript:void(0)" onclick="BX.util.popup('https://accounts.google.com/o/oauth2/auth?client_id=866408741810-otdjj6ousv0v9v6tfqph1dtkm5cnm6fm.apps.googleusercontent.com&amp;redirect_uri=https%3A%2F%2Fpriwoz.info%2Fbitrix%2Ftools%2Foauth%2Fgoogle.php&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&amp;response_type=code&amp;access_type=offline&amp;state=provider%3DGoogleOAuth%26site_id%3Ds1%26backurl%3D%252Fpersonal%252F%253Fcheck_key%253Df6ff31a2868b0253b28070f7609787fb%26mode%3Dopener%26redirect_url%3D%252Fpersonal%252F', 580, 400)" title="Google">Продолжить через Google</a>
                            </li>
                            <li>
                                <a id="bx_socserv_icon_Apple" class="apple bx-authform-social-icon" href="javascript:void(0)"  title="Apple">Продолжить через Аpple</a>
                            </li>
                        </ul>
                    </div>

                    <h3 class="bx-title">Регистрация по email или телефону</h3>

                    <form name="form_auth" method="post" target="_top" action="/personal/?login=yes">

                        <input type="hidden" name="AUTH_FORM" value="Y">
                        <input type="hidden" name="TYPE" value="AUTH">
                        <input type="hidden" name="backurl" value="/personal/">

                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-input-container">
                                <label class="form-label -with-icon">
                                    <span class="input-icon -name"></span>
                                    <input type="text" class="form-control" name="USER_LOGIN" maxlength="255" value="" placeholder="ваш еmail или телефон">
                                </label>
                            </div>
                        </div>
                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-input-container">
                                <label class="form-label password-label -with-icon">
                                    <span class="input-icon -password"></span>
                                    <input type="password" class="form-control" name="USER_PASSWORD" maxlength="255" autocomplete="off" placeholder="ваш пароль">
                                    <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-input-container">
                                <label class="form-label password-label -with-icon">
                                    <span class="input-icon -password"></span>
                                    <input type="password" class="form-control" name="USER_PASSWORD_CONFIRM" maxlength="255" autocomplete="off" placeholder="повторите пароль">
                                    <span class="toggle-password-button"><i class="icon icon-eye"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="bx-authform-link-container">
                            <a href="/" rel="nofollow">Вернуться на страницу Вход</a>
                        </div>

                        <div class="bx-authform-formgroup-container">
                            <input type="submit" class="btn btn-green" name="Register" value="Зарегистрироваться">
                        </div>

                        <div class="hint">Нажимая кнопку “Зарегистрироваться” вы соглашаетесь с нашей <a href="#">Политикой конфендициальности</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>