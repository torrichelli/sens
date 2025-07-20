<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ипотека");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"mortgage_page", // Наш главный шаблон для страницы
	[
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "17", // <-- ЗАМЕНИТЕ НА ID
		"ELEMENT_ID" => "60", // <-- ЗАМЕНИТЕ НА ID
		"FIELD_CODE" => ["NAME"],
		"PROPERTY_CODE" => [
            "PAGE_TITLE", "PAGE_SUBTITLE", "PROGRAMS_TITLE", "PARTNERS_TITLE", 
            "HOW_TO_APPLY_TITLE", "DOCS_TITLE", "FAQ_TITLE"
        ],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
        
        // Передаем ID инфоблоков с программами и банками
        "MORTGAGE_PROGRAMS_IBLOCK_ID" => "18", // <-- ЗАМЕНИТЕ НА ID
        "BANK_PARTNERS_IBLOCK_ID" => "19" // <-- ЗАМЕНИТЕ НА ID
	],
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>