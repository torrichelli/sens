<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div style="background: #fff; border: 2px solid red; padding: 20px; margin: 150px 20px 20px;">
    <h3>Отладочная информация (Шаблон detail.php)</h3>

    <h4>1. Массив $arResult:</h4>
    <p>
        Этот массив должен содержать переменные, которые компонент извлек из URL. 
        Если массив [VARIABLES] пуст или в нем нет [ELEMENT_CODE], значит, проблема в настройках ЧПУ.
    </p>
    <pre><?print_r($arResult);?></pre>

</div>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"vacancy_detail",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
	),
	$component
);?>