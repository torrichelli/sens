<?
// Подключаем prolog Bitrix, чтобы использовать его функции, но без подключения шаблона сайта
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// Устанавливаем статус 404 Not Found
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

// Подключаем шапку сайта
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

// Устанавливаем заголовок страницы
$APPLICATION->SetTitle("Страница не найдена");
?>

<div class="container text-center" style="padding: 80px 15px;">
    <h1 style="font-size: 6rem; font-weight: 700; color: var(--primary-color);">404</h1>
    <h2 style="font-size: 2rem; margin-bottom: 20px;">Страница не найдена</h2>
    <p class="lead text-muted" style="max-width: 500px; margin: 0 auto 30px;">
        К сожалению, страница, которую вы ищете, не существует или была перемещена.
    </p>
    <a href="/" class="btn btn-primary btn-lg">Вернуться на главную</a>
</div>

<?
// Подключаем подвал сайта
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>