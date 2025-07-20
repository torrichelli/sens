<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <div class="container-fluid header-container">
        <div class="page-header-simple">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "custom_breadcrumb",
                Array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "IS_NEWS_LIST" => "Y",
                    "SITE_ID" => SITE_ID
                    )
            );?>
            <h1 class="page-main-title">Новости</h1>
        </div>

        <div class="news-page-section">
            <?// --- НАЧАЛО БЛОКА ФИЛЬТРОВ ---
            global $arrNewsFilter;
            $current_filter = htmlspecialchars($_REQUEST["F"]);
            if (!empty($current_filter)) {
                $arrNewsFilter = ["=PROPERTY_CATEGORY_VALUE" => $current_filter];
            }

            $arCategories = [];
            // Убедитесь, что у свойства "Категория" символьный код CATEGORY
            $property_enums = CIBlockPropertyEnum::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"CATEGORY"]);
            while($enum_fields = $property_enums->GetNext()) {
                $arCategories[] = $enum_fields;
            }
            ?>
            <?if(!empty($arCategories)):?>
                <div class="news-filter-tabs mb-5">
                    <a href="<?=$APPLICATION->GetCurPage()?>" class="news-filter-btn <?=empty($current_filter) ? 'active' : ''?>">Все</a>
                    <?foreach($arCategories as $arCategory):?>
                        <a href="<?=$APPLICATION->GetCurPageParam("F=".urlencode($arCategory["VALUE"]), ["F"])?>"
                           class="news-filter-btn <?=$current_filter == $arCategory["VALUE"] ? 'active' : ''?>">
                            <?=$arCategory["VALUE"]?>
                        </a>
                    <?endforeach;?>
                </div>
            <?endif;?>

           <?
            // --- Логика для "Показывать по" ---
            $arPageSizes = [4, 8, 16]; // Доступные варианты
            $pageSize = (int)$_REQUEST["page_size"];
            if (!in_array($pageSize, $arPageSizes)) {
                $pageSize = 8; 
            }
            ?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "news_cards_v2", 
                Array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => $pageSize, 
                    "SORT_BY1" => $arParams["SORT_BY1"],
                    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "FILTER_NAME" => "arrNewsFilter",
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_TEMPLATE" => "custom_pagination",
                    "PAGE_SIZES" => $arParams["PAGE_SIZES"],
                ),
                $component
            );?>
        </div>
    </div>