<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if (is_string($_REQUEST["backurl"]) && strpos($_REQUEST["backurl"], "/") === 0) {
    LocalRedirect($_REQUEST["backurl"]);
}
$APPLICATION->SetTitle("Авторизация");
?>
    <section class="personal-section">
        <div class="container">
            <div class="row post-section">
                <div class="col-xs-12">
                    <h2 class="section-title">Вы зарегистрированы и успешно авторизовались.</h2>
                    <p class="content">Используйте административную панель в верхней части экрана для быстрого доступа к функциям
                        управления структурой и информационным наполнением сайта. Набор кнопок верхней панели отличается
                        для различных разделов сайта. Так отдельные наборы действий предусмотрены для управления
                        статическим содержимым страниц, динамическими публикациями (новостями, каталогом, фотогалереей)
                        и т.п.</p>

                    <p><a class="blue-link" href="<?= SITE_DIR ?>">Вернуться на главную страницу</a></p>
                </div>
            </div>
        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>