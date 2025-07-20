<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="row g-4">
    <?if(!empty($arResult["ITEMS"])):?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
            ?>
            <div class="col-lg-4 col-md-6">
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
                                <span class="news-card__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
                                <span class="news-card__details-link-v3">&rarr;</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?endforeach;?>
    <?else:?>
        <p>В данной категории новостей не найдено.</p>
    <?endif;?>
</div>

<?// Пагинация ?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="mt-5 d-flex justify-content-center">
        <?=$arResult["NAV_STRING"]?>
    </div>
<?endif;?>