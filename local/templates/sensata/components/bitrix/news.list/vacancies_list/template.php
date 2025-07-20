<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="vacancies-list">
    <?if(!empty($arResult["ITEMS"])):?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
            ?>
            <div class="vacancy-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="vacancy-card-body">
                    <div class="vacancy-card-header">
                        <?if($arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"]):?>
                            <span class="vacancy-category"><?=$arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"]?></span>
                        <?endif;?>
                    </div>
                    <h3 class="vacancy-title"><?=$arItem["NAME"]?></h3>
                    <div class="vacancy-meta">
                        <?if($arItem["PROPERTIES"]["WORK_FORMAT"]["VALUE"]):?>
                            <span><?=$arItem["PROPERTIES"]["WORK_FORMAT"]["VALUE"]?></span>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["REGION"]["VALUE"]):?>
                            <span><?=$arItem["PROPERTIES"]["REGION"]["VALUE"]?></span>
                        <?endif;?>
                        <?if($arItem["PROPERTIES"]["EXPERIENCE"]["VALUE"]):?>
                            <span><?=$arItem["PROPERTIES"]["EXPERIENCE"]["VALUE"]?></span>
                        <?endif;?>
                    </div>
                </div>
                <div class="vacancy-card-action">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-outline-primary">Подробнее</a>
                </div>
            </div>
        <?endforeach;?>
    <?else:?>
        <div class="text-center py-5">
            <p>По вашему запросу вакансий не найдено. Попробуйте изменить параметры фильтра.</p>
        </div>
    <?endif;?>
</div>

<?// Пагинация ?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <nav class="mt-5 d-flex justify-content-center">
        <?=$arResult["NAV_STRING"]?>
    </nav>
<?endif;?>