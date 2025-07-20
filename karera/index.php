<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карьера");
?>
    
   <?// --- НАЧАЛО ДИНАМИЧЕСКОЙ HERO-СЕКЦИИ --- ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "career_hero", // Наш новый шаблон для Hero-секции
        [
            "IBLOCK_TYPE" => "content", // Укажите ваш тип инфоблока
            "IBLOCK_ID" => "16", // <-- ЗАМЕНИТЕ НА ID ИНФОБЛОКА "Контент страницы 'Карьера'"
            "ELEMENT_ID" => "58", // <-- ЗАМЕНИТЕ НА ID ЭЛЕМЕНТА, КОТОРЫЙ ВЫ СОЗДАЛИ
            "FIELD_CODE" => ["NAME"],
            "PROPERTY_CODE" => ["CAREER_HERO_TITLE", "CAREER_HERO_SUBTITLE", "CAREER_HERO_IMAGE"],
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
        ],
        false
    );?>


   <?$APPLICATION->IncludeComponent(
        "bitrix:news",
        "career_template", // Название нашего шаблона для раздела
        [
            "IBLOCK_TYPE" => "content",
            "IBLOCK_ID" => "15", // <-- ЗАМЕНИТЕ НА ID
            "NEWS_COUNT" => "10",
            "USE_FILTER" => "Y",
            "FILTER_NAME" => "arrVacanciesFilter",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "ASC",
            
            // --- НАСТРОЙКИ ЧПУ ---
            "SEF_MODE" => "Y",
            "SEF_FOLDER" => "/karera/",
            "SEF_URL_TEMPLATES" => [
                "news" => "",
                "section" => "",
                "detail" => "#ELEMENT_CODE#/",
            ],
            
            "LIST_FIELD_CODE" => ["NAME"],
            "LIST_PROPERTY_CODE" => ["SPECIALIZATION", "REGION", "EMPLOYMENT_TYPE", "WORK_FORMAT", "EXPERIENCE"],

            "DETAIL_FIELD_CODE" => ["NAME", "DETAIL_TEXT"],
            "DETAIL_PROPERTY_CODE" => ["SPECIALIZATION", "REGION", "EMPLOYMENT_TYPE", "WORK_FORMAT", "EXPERIENCE", "RESPONSIBILITIES", "REQUIREMENTS", "WE_OFFER"],

            "CACHE_TYPE" => "A",
            "CACHE_FILTER" => "Y",
            "CACHE_TIME" => "36000000",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TEMPLATE" => ".default",
        ],
        false
    );?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>