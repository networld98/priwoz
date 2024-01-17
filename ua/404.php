<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("
Сторінка не знайдена");?>
    <section class="not-found-section">
        <div class="container">
            <div class="bg-box">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-xl-4">
                        <h1 class="title">404</h1>
                        <div class="back-text">
                            Щось пішло не так. Можна скористатися меню сайту або повернутися на
                            <a href="/">головну</a>
                        </div>
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>