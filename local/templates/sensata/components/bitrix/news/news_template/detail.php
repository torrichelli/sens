<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
?>
    <div class="container-fluid header-container">

        <?// --- ВЫЗОВ КОМПОНЕНТА ДЛЯ ОТОБРАЖЕНИЯ ДЕТАЛЬНОЙ НОВОСТИ --- ?>
        <?$ElementID = $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "news_detail_template", // Название нашего нового шаблона
            Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"], 
                "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                "LIST_PAGE_URL" => $arResult["FOLDER"],

                "SET_TITLE" => "Y", 
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",

                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "Y", 
                "ADD_ELEMENT_CHAIN" => "Y",

                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
            ),
            $component
        );?>

    </div>