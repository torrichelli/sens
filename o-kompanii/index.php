<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"about_page_template", // Название нашего нового шаблона
	[
		"IBLOCK_TYPE" => "content", // Укажите ваш тип инфоблока, где лежат данные
		"IBLOCK_ID" => "13", // <-- ЗАМЕНИТЕ НА ID ИНФОБЛОКА "Контент страницы 'О компании'"
		"ELEMENT_ID" => "47", // <-- ЗАМЕНИТЕ НА ID ЭЛЕМЕНТА, КОТОРЫЙ ВЫ СОЗДАЛИ
		"ELEMENT_CODE" => "",
		"FIELD_CODE" => ["NAME", "PREVIEW_TEXT", "DETAIL_TEXT"],
		"PROPERTY_CODE" => [ // Перечисляем все наши кастомные свойства
			"HERO_TITLE",
			"HERO_SUBTITLE",
			"HERO_BACKGROUND",
			"STAT_1_NUMBER", "STAT_1_TEXT",
			"STAT_2_NUMBER", "STAT_2_TEXT",
			"STAT_3_NUMBER", "STAT_3_TEXT",
			"STAT_4_NUMBER", "STAT_4_TEXT",
			"INTRO_TEXT",
			"PRINCIPLES_ICONS",
			"PRINCIPLES_TITLES",
			"PRINCIPLES_TEXTS",
			"PARTNER_LOGOS"
		],
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
	],
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>