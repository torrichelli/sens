<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

// Подключаем необходимые JS и CSS файлы
$this->addExternalJS($templateFolder."/script.js");
$this->addExternalCss($templateFolder."/style.css");
?>

<section class="properties-section">
    <div class="container-fluid header-container">
        <?
        $currentCityName = "во всех городах";
        $cityValues = [];
        $cityPropertyFound = false;

        foreach ($arResult["ITEMS"] as $arItem) {
            if ($arItem["CODE"] == "CITY") {
                $cityValues = $arItem["VALUES"];
                $cityPropertyFound = true;
                break;
            }
        }

        if ($cityPropertyFound) {
            foreach ($cityValues as $arValue) {
                if (isset($_GET[$arValue["CONTROL_NAME"]]) && $_GET[$arValue["CONTROL_NAME"]] == $arValue["HTML_VALUE"]) {
                    $cityName = $arValue["VALUE"];
                    
                    $prepositionalCity = $cityName;
                    if ($cityName == "Все города") $prepositionalCity = "всех городах";
                    if ($cityName == "Астана") $prepositionalCity = "Астане";
                    if ($cityName == "Алматы") $prepositionalCity = "Алматы";
                    
                    $currentCityName = "" . $prepositionalCity;
                    break;
                }
            }
        }
        ?>

        <div class="section-header-with-filter-title">
            <h2 class="section-title filter-section-title">Наши проекты в
                <span class="city-selector" id="citySelectorBtn" tabindex="0" role="button" aria-haspopup="true" aria-expanded="false">
                    <?=$currentCityName?>
                    <svg class="city-selector-icon" viewBox="0 0 16 16" fill="currentColor">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </span>
            </h2>
            
            <div class="city-selector-dropdown" id="cityDropdown">
                <a href="<?=$arResult["SEF_DEL_FILTER_URL"]?>" class="city-dropdown-item">Все города</a>
                <?foreach($cityValues as $arValue):?>
                    <a href="<?=$arResult["FORM_ACTION"]?>?<?=$arValue["CONTROL_NAME"]?>=<?=$arValue["HTML_VALUE"]?>" 
                       class="city-dropdown-item <?if($arValue["CHECKED"]) echo 'active';?>">
                        <?=$arValue["VALUE"]?>
                    </a>
                <?endforeach;?>
            </div>
        </div>

        <div class="advanced-property-filters">
            <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" 
                  action="<?echo $arResult["FORM_ACTION"]?>" 
                  method="get" 
                  class="smart-filter-form">
                
                <?foreach($arResult["HIDDEN"] as $arItem):?>
                    <input type="hidden" 
                           name="<?echo $arItem["CONTROL_NAME"]?>" 
                           id="<?echo $arItem["CONTROL_ID"]?>" 
                           value="<?echo $arItem["HTML_VALUE"]?>" />
                <?endforeach;?>

                <div class="filters-main-panel">
                    <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                        <?if(empty($arItem["VALUES"])) continue;?>
                        
                        <?// Пропускаем CITY - он выводится отдельно ?>
                        <?if($arItem["CODE"] == "CITY") continue;?>

                        <?// Вывод для ЛОКАЦИИ ?>
                        <?if($arItem["CODE"] == "LOCATION"):?>
                            <div class="filter-group location-filter">
                                <label class="filter-group-label">Выберите локацию</label>
                                <div class="location-input-wrapper">
                                    <select class="location-input-field" 
                                            name="<?=$arItem["VALUES"][array_key_first($arItem["VALUES"])]["CONTROL_NAME_ALT"]?>" 
                                            onchange="smartFilter.click(this)">
                                        <option value="">Все районы</option>
                                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                                            <option value="<?=$ar["HTML_VALUE_ALT"]?>" 
                                                    <?=$ar["CHECKED"]? 'selected' : ''?>>
                                                <?=$ar["VALUE"]?>
                                            </option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?endif?>

                        <?// Вывод для ЦЕНЫ ?>
                        <?if(isset($arItem["PRICE"])):?>
                            <div class="filter-group price-filter">
                                <label class="filter-group-label">Задайте стоимость, млн ₸</label>
                                <div class="price-range-inputs">
                                    <span class="price-prefix">от</span>
                                    <input class="price-input-field" 
                                           type="text" 
                                           name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" 
                                           id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" 
                                           value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" 
                                           size="5" 
                                           onkeyup="smartFilter.keyup(this)" />
                                    <span class="price-separator-dash">—</span>
                                    <span class="price-prefix">до</span>
                                    <input class="price-input-field" 
                                           type="text" 
                                           name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" 
                                           id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" 
                                           value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" 
                                           size="5" 
                                           onkeyup="smartFilter.keyup(this)" />
                                </div>
                            </div>
                        <?endif?>

                        <?// Вывод для ДАТА СДАЧИ ?>
                        <?if($arItem["CODE"] == "COMPLETION_DATE"):?>
                            <div class="filter-group completion-date-filter">
                                <label class="filter-group-label">Дата сдачи до</label>
                                <div class="completion-date-tabs">
                                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                                        <label class="date-tab-btn <?=$ar["CHECKED"] ? 'active' : ''?>">
                                            <input type="checkbox"
                                                   value="<?=$ar["HTML_VALUE"]?>"
                                                   name="<?=$ar["CONTROL_NAME"]?>"
                                                   id="<?=$ar["CONTROL_ID"]?>"
                                                   <?=$ar["CHECKED"]? 'checked="checked"': ''?>
                                                   onclick="smartFilter.click(this)"
                                                   class="d-none" />
                                            <?=$ar["VALUE"]?>
                                        </label>
                                    <?endforeach;?>
                                </div>
                            </div>
                        <?endif?>
                    <?endforeach;?>
                </div>

                <div class="filters-tags-panel">
                    <div class="tags-list">
                        <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                            <?if($arItem["CODE"] == "CLASS"):?>
                                <?foreach($arItem["VALUES"] as $val => $ar):?>
                                    <label class="tag-btn <?=$ar["CHECKED"] ? 'active' : ''?>">
                                        <input type="checkbox" 
                                               value="<?=$ar["HTML_VALUE"]?>" 
                                               name="<?=$ar["CONTROL_NAME"]?>" 
                                               id="<?=$ar["CONTROL_ID"]?>" 
                                               <?=$ar["CHECKED"]? 'checked="checked"': ''?> 
                                               onclick="smartFilter.click(this)" 
                                               class="d-none" />
                                        <?=$ar["VALUE"]?>
                                    </label>
                                <?endforeach;?>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
                    <div class="filters-controls">
                        <span class="found-projects-text" id="modef_num">
                            Найдено <?=$arResult["ELEMENT_COUNT"]?> проектов
                        </span>
                        <input class="clear-filters-btn" 
                               type="submit" 
                               id="del_filter" 
                               name="del_filter" 
                               value="Очистить фильтр" />
                    </div>
                </div>
                
                <div class="d-none">
                    <input type="submit" id="set_filter" name="set_filter" value="Подобрать" />
                </div>
            </form>
        </div>
    </div>
</section>

<script>
BX.ready(function() {
    window.smartFilter = new JCSmartFilter(
        '<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
        '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>',
        <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>
    );
});
</script>