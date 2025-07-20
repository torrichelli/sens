<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$APPLICATION->ShowTitle()?></title>

    <?
    use Bitrix\Main\Page\Asset;
    Asset::getInstance()->addString('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">');
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.js");
    Asset::getInstance()->addString('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>');
    
    $APPLICATION->ShowHead();
    ?>
</head>
<body>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>

    <div class="page-wrapper">
        <header class="main-header">
            <div class="header-top">
                <div class="container-fluid header-container">
                    <div class="horizontal-border-top">
                        <?$APPLICATION->IncludeComponent( // Верхнее меню
                            "bitrix:menu",
                            "top_nav", // Имя шаблона компонента, мы его создадим
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top", // Указываем тип меню "top"
                                "USE_EXT" => "N"
                            )
                        );?>
                        <div class="header-actions">
                          <div class="social-links">
                            <?$APPLICATION->IncludeComponent( // Редактируемые иконки соцсетей
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/header_socials.php",
                                    "EDIT_TEMPLATE" => ""
                                )
                            );?>
                        </div>
                            <button class="btn btn-outline-secondary" id="headerTopCallBtn">
                                <?$APPLICATION->IncludeComponent( // Редактируемый текст кнопки
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH . "/include/header_call_btn_text.php",
                                        "EDIT_TEMPLATE" => ""
                                    )
                                );?>
                            </button>
                            <div class="language-selector" id="languageSelectorBtn">
                                <span>RU</span>
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/Vector.svg" alt="Language">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-main">
                <div class="container-fluid header-container">
                    <div class="header-content">
                        <div class="logo-wrapper">
                             <?$APPLICATION->IncludeComponent( // Редактируемый логотип
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/header_logo.php",
                                    "EDIT_TEMPLATE" => ""
                                )
                            );?>
                        </div>
                        <button class="burger-menu-button" aria-label="Открыть меню" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_nav", 
	[
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => [
		],
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "main",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "main_nav"
	],
	false
);?>
                        <div class="user-actions desktop-only-flex">
                             <?$APPLICATION->IncludeComponent( // Блок "Избранное" и "Войти"
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/header_user_actions.php",
                                    "EDIT_TEMPLATE" => ""
                                )
                            );?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<?
// Проверяем, является ли текущая страница главной ИЛИ страницей "О компании"
if (CSite::InDir('/index.php') || CSite::InDir('/o-kompanii/')) {
    // Если это одна из этих страниц, отступа сверху не будет
    $main_class = "main-content"; 
} else {
    // На всех остальных страницах отступ будет
    $main_class = "main-content section-padding-top"; 
}
?>
<main class="<?=$main_class?>">