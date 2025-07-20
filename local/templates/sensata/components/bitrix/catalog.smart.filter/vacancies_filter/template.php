<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="vacancies-filter-container mb-5">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smart-filter-form">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>
        <h2 class="vacancies-count-title">
            <span class="text-primary"><?=$arResult["ELEMENT_COUNT"]?></span> вакансия
        </h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            
            <div class="search-bar-wrapper">
                <input type="text" class="form-control-vc" placeholder="Найти вакансию" name="q" value="<?=htmlspecialchars($_REQUEST['q'])?>">
                <button type="submit" class="btn btn-primary" name="set_filter">Найти вакансию</button>
            </div>
        </div>

        <div class="row g-3">
            <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                <?if(empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;?>
                
                <div class="col">
                    <label class="form-label d-block"><?=$arItem["NAME"]?></label>
                    
                    <?// --- ИЗМЕНЕНИЕ ЗДЕСЬ --- ?>
                    <select class="form-select" name="<?=$arItem["VALUES"][array_key_first($arItem["VALUES"])]["CONTROL_NAME_ALT"]?>" onchange="this.form.submit()">
                        <option value="">Выбрать</option>
                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                            <option value="<?=$ar["HTML_VALUE_ALT"]?>" <?=$ar["CHECKED"]? 'selected' : ''?>><?=$ar["VALUE"]?></option>
                        <?endforeach;?>
                    </select>
                </div>
            <?endforeach;?>
        </div>
        
        <div class="d-none">
             <input type="submit" id="set_filter" name="set_filter" value="Подобрать" />
             <input type="submit" id="del_filter" name="del_filter" value="Сбросить" />
        </div>
    </form>
</div>