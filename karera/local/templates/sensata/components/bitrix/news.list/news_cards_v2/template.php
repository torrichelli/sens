<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="row g-4">
    <?if(!empty($arResult["ITEMS"])):?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

            // --- НОВЫЙ БЛОК: ФОРМАТИРОВАНИЕ ДАТЫ ---
            $formattedDate = FormatDate(
                "j F Y", 
                MakeTimeStamp($arItem["DATE_CREATE"])
            );
        
            $categoryXmlId = strtolower($arItem["PROPERTIES"]["CATEGORY"]["VALUE_XML_ID"]);
            ?>
            
            <div class="col-md-6 col-lg-3">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news-card-link-v3">
                    <div class="news-card-v3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="news-card__image-wrapper-v3">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="news-card__image-v3">
                            <?if($arItem["PROPERTIES"]["CATEGORY"]["VALUE"]):?>
                                <span class="news-card__category-tag"><?=$arItem["PROPERTIES"]["CATEGORY"]["VALUE"]?></span>
                            <?endif;?>
                        </div>
                        <div class="news-card__content-v3">
                            <h3 class="news-card__title-v3"><?=$arItem["NAME"]?></h3>
                            <div class="news-card__footer-v3">
                                <span class="news-card__date"><img src="<?=SITE_TEMPLATE_PATH?>/images/calendar_icon.svg"><?=$formattedDate?></span>
                                <span class="news-card__details-link-v3">&rarr;</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?endforeach;?>
    <?else:?>
        <div class="col-12"><p>В данной категории новостей не найдено.</p></div>
    <?endif;?>
</div>

<div class="pagination-controls mt-5">
    
    <?// --- Блок "Показывать по" --- ?>
    <div class="show-by-control">
        <span>Показывать по:</span>
        <?
        $arPageSizes = $arParams["PAGE_SIZES"]; // Берем массив из параметров
        $currentPageSize = $arResult["NAV_RESULT"]->nPageSize;
        ?>
        <?foreach ($arPageSizes as $size):?>
            <?if($size == $currentPageSize):?>
                <span class="active"><?=$size?></span>
            <?else:?>
                <a href="<?=$APPLICATION->GetCurPageParam("page_size=".$size, ["page_size", "PAGEN_1"])?>"><?=$size?></a>
            <?endif;?>
        <?endforeach;?>
    </div>

    <?// --- Блок самой пагинации --- ?>
    <?=$arResult["NAV_STRING"]?>

</div>
<?// --- КОНЕЦ БЛОКА ПАГИНАЦИИ --- ?>