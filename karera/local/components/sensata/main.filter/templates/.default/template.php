<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
?>

<?// Компонент умного фильтра ?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.smart.filter",
    "main_page_filter", // Ваш шаблон оформления фильтра
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "3",
        "SECTION_ID" => "",
        "FILTER_NAME" => $arResult["FILTER_NAME"],
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "SAVE_IN_SESSION" => "N",
        "INSTANT_RELOAD" => "Y",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PRICE_CODE" => [],
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "-",
        "SECTION_DESCRIPTION" => "-",
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);?>

<?// Компонент списка объектов ?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "estate_cards_on_main", // Ваш шаблон оформления списка
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "3",
        "NEWS_COUNT" => "6",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "FILTER_NAME" => $arResult["FILTER_NAME"],
        "USE_FILTER" => "Y",
        "PROPERTY_CODE" => ["CLASS", "PRICE", "APARTMENTS_SALE", "DELIVERY_DATE", "FINISHING"],
        "CACHE_TYPE" => "A",
        "CACHE_FILTER" => "Y",
        "CACHE_TIME" => "36000000",
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);?>