<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section id="vacancies" class="vacancies-section">
    <div class="container">
        <?
        // Объявляем глобальную переменную для связи фильтра и списка
        global $arrVacanciesFilter;
        $ajaxBlockId = "vacancies-list-container";
        ?>

        <?// 1. ВЫЗЫВАЕМ КОМПОНЕНТ ФИЛЬТРА ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "vacancies_filter", 
            [
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "SECTION_ID" => "",
                "FILTER_NAME" => "arrVacanciesFilter",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "Y",
                "AJAX_OPTION_ADDITIONAL" => $ajaxBlockId,
            ],
            $component // Важно передавать $component для правильной работы в комплексном компоненте
        );?>
        
        <?// 2. КОНТЕЙНЕР-ОБЕРТКА ДЛЯ СПИСКА ВАКАНСИЙ ?>
        <div id="<?=$ajaxBlockId?>">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "vacancies_list", 
                [
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                    "SORT_BY1" => $arParams["SORT_BY1"],
                    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                    "FILTER_NAME" => "arrVacanciesFilter",
                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                ],
                $component
            );?>
        </div>
    </div>
</section>