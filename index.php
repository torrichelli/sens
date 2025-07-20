<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная страница");
?>

<?
// Вызов компонента для вывода акций
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"promo_on_main", // Мы создадим этот шаблон ниже
	[
		"IBLOCK_TYPE" => "content", // Укажите ваш тип инфоблока
		"IBLOCK_ID" => "11", // Замените на реальный ID
		"NEWS_COUNT" => "4", // Сколько акций выводить
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"FIELD_CODE" => ["NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"],
		"PROPERTY_CODE" => ["PROMO_SUBTITLE", "PROMO_LINK", "PROMO_IMAGE", "PROMO_END_DATE", "PROMO_STYLE"],
		"CHECK_DATES" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
	],
	false
);
?>

<?
global $arrMainFilter; 
?>

<?// --- 1. СНАЧАЛА ВЫЗЫВАЕМ КОМПОНЕНТ ФИЛЬТРА --- ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"main_page_filter", 
	[
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "3",
		"SECTION_ID" => "",
		"FILTER_NAME" => "arrMainFilter",
		"PREFILTER_NAME" => "smartPreFilter",
		"PRICE_CODE" => [],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
	
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"SAVE_IN_SESSION" => "N",
		"XML_EXPORT" => "N",
		"AJAX_MODE" => "Y", 
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N", 
		"AJAX_OPTION_ADDITIONAL" => "",
	],
	false
);?>






<?// --- 4. ВЫВОДИМ СПИСОК ОБЪЕКТОВ --- ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"estate_cards_on_main",
	[
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "3",
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"FILTER_NAME" => "arrMainFilter", 
		"FIELD_CODE" => ["NAME", "PREVIEW_PICTURE"],
		"PROPERTY_CODE" => [
			"CLASS", "PRICE", "APARTMENTS_SALE", "DELIVERY_DATE", "FINISHING",
            "AREA_1_ROOM_FROM", "PRICE_1_ROOM_FROM", "AREA_2_ROOM_FROM",
            "PRICE_2_ROOM_FROM", "AREA_3_ROOM_FROM", "PRICE_3_ROOM_FROM",
		],
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "/landing/#ELEMENT_CODE#/",
		"CACHE_TYPE" => "A",
		"USE_FILTER" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_TIME" => "36000000",
		"INSTANT_RELOAD" => "Y",
		"AJAX_MODE" => "N", // Важно! Включаем AJAX
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
	],
	false
);
echo '<pre>';
print_r($arrMainFilter);
echo '</pre>';?>

        <button class="show-more-btn custom-btn mx-auto d-block mt-5">Показать больше</button>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>