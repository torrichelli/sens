<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="actual-offers section-padding-top">
    <div class="actual-offers__grid">

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="offer-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="offer-card__image-container">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="offer-card__carousel-image">
                <div class="offer-card__badges-on-image">
                    <?if($arItem["PROPERTIES"]["CLASS"]["VALUE"]):?>
                        <span class="property-status-comfort" style="color: black;"><?=$arItem["PROPERTIES"]["CLASS"]["VALUE"]?></span>
                    <?endif;?>
                </div>
            </div>
            <div class="offer-card__info">
                <div class="offer-card__main-content">
                    <div class="offer-card__title-section">
                        <h3 class="offer-card__title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h3>
                    </div>
                    <div class="offer-card__price-section">
                        <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]):?>
                            <p class="offer-card__price">от <?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?> ₸</p>
                        <?endif;?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="offer-card__details-link">Подробнее</a>
                    </div>
                </div>
                <div class="offer-card__expanded-details">
                    <?if($arItem["PROPERTIES"]["APARTMENTS_SALE"]["VALUE"]):?>
                        <p class="offer-card__availability"><?=$arItem["PROPERTIES"]["APARTMENTS_SALE"]["VALUE"]?> квартир в продаже</p>
                    <?endif;?>
                    
                    <ul class="offer-card__apartment-types">
    <?if(!empty($arItem["PROPERTIES"]["AREA_1_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_1_ROOM_FROM"]["VALUE"])):?>
        <li>
            <span>1-комнатные</span>
            <span>от <?=$arItem["PROPERTIES"]["AREA_1_ROOM_FROM"]["VALUE"]?> м²</span>
            <?// Просто выводим текстовое значение как есть ?>
            <span>от <?=$arItem["PROPERTIES"]["PRICE_1_ROOM_FROM"]["VALUE"]?> ₸</span>
        </li>
    <?endif;?>

    <?if(!empty($arItem["PROPERTIES"]["AREA_2_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_2_ROOM_FROM"]["VALUE"])):?>
        <li>
            <span>2-комнатные</span>
            <span>от <?=$arItem["PROPERTIES"]["AREA_2_ROOM_FROM"]["VALUE"]?> м²</span>
            <span>от <?=$arItem["PROPERTIES"]["PRICE_2_ROOM_FROM"]["VALUE"]?> ₸</span>
        </li>
    <?endif;?>

    <?if(!empty($arItem["PROPERTIES"]["AREA_3_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_3_ROOM_FROM"]["VALUE"])):?>
        <li>
            <span>3-комнатные</span>
            <span>от <?=$arItem["PROPERTIES"]["AREA_3_ROOM_FROM"]["VALUE"]?> м²</span>
            <span>от <?=$arItem["PROPERTIES"]["PRICE_3_ROOM_FROM"]["VALUE"]?> ₸</span>
        </li>
    <?endif;?>
</ul>

                    <?if($arItem["PROPERTIES"]["DELIVERY_DATE"]["VALUE"]):?>
                        <p class="offer-card__delivery-date">Срок сдачи: <?=$arItem["PROPERTIES"]["DELIVERY_DATE"]["VALUE"]?></p>
                    <?endif;?>
                </div>
            </div>
            <div class="offer-card__footer-info">
                 <?if($arItem["PROPERTIES"]["FINISHING"]["VALUE"]):?>
                    <span class="badge badge--finishing"><?=$arItem["PROPERTIES"]["FINISHING"]["VALUE"]?></span>
                <?endif;?>
            </div>
        </div>
    <?endforeach;?>

    </div>
</section>