<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (is_string($_REQUEST["backurl"]) && strpos($_REQUEST["backurl"], "/") === 0)
{
	LocalRedirect($_REQUEST["backurl"]);
}
$APPLICATION->SetTitle("Авторизація");
?>
<div class="container mt-4">
    <p>Ви зареєстровані та успішно авторизувалися.</p>

    <p>Використовуйте адміністративну панель у верхній частині екрана для швидкого доступу до функцій управління структурою та інформаційним наповненням сайту. Набір кнопок верхньої панелі відрізняється різними розділами сайту. Так окремі набори дій передбачені керувати статичним вмістом сторінок, динамічними публікаціями (новиною, каталогом, фотогалереєю) тощо.</p>

    <p><a href="<?=SITE_DIR?>">Повернутися на головну сторінку</a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>