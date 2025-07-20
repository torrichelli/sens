<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="ajax-filter-results-container">
    <?if(!empty($arResult["ITEMS"])):?>
        <section class="actual-offers">
            <div class="actual-offers__grid">

            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                // Готовим данные для вывода
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                $price = $arItem["PROPERTIES"]["PRICE"]["VALUE"];
                $class = $arItem["PROPERTIES"]["CLASS"]["VALUE"];
                $finishing = $arItem["PROPERTIES"]["FINISHING"]["VALUE"];
                $delivery_date = $arItem["PROPERTIES"]["DELIVERY_DATE"]["VALUE"];
                $apartments_sale = $arItem["PROPERTIES"]["APARTMENTS_SALE"]["VALUE"];
                $image_src = $arItem["PREVIEW_PICTURE"]["SRC"] ?: $templateFolder."/images/no_photo.png";
                ?>

                <div class="offer-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="offer-card__image-container">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img src="<?=$image_src?>" alt="<?=htmlspecialcharsbx($arItem["NAME"])?>" class="offer-card__carousel-image">
                        </a>
                        <?if($class):?>
                        <div class="offer-card__badges-on-image">
                            <span class="property-status-comfort" style="color: black;"><?=htmlspecialcharsbx($class)?></span>
                        </div>
                        <?endif;?>
                    </div>
                    <div class="offer-card__info">
                        <div class="offer-card__main-content">
                            <div class="offer-card__title-section">
                                <h3 class="offer-card__title">
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=htmlspecialcharsbx($arItem["NAME"])?></a>
                                </h3>
                            </div>
                            <?if($price):?>
                            <div class="offer-card__price-section">
                                <p class="offer-card__price">от <?=number_format($price, 0, ' ', ' ')?> ₸</p>
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="offer-card__details-link">Подробнее</a>
                            </div>
                            <?endif;?>
                        </div>
                        <div class="offer-card__expanded-details">
                            <?if($apartments_sale):?>
                            <p class="offer-card__availability"><?=htmlspecialcharsbx($apartments_sale)?> квартиры в продаже</p>
                            <?endif;?>
                            
                            <ul class="offer-card__apartment-types">
                                <?// Проверяем 1-комнатные ?>
                                <?if(!empty($arItem["PROPERTIES"]["AREA_1_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_1_ROOM_FROM"]["VALUE"])):?>
                                    <li>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span>1-комнатные</span></a>
                                        <span>от <?=$arItem["PROPERTIES"]["AREA_1_ROOM_FROM"]["VALUE"]?> м²</span>
                                        <span>от <?=number_format($arItem["PROPERTIES"]["PRICE_1_ROOM_FROM"]["VALUE"], 0, ' ', ' ')?> ₸</span>
                                    </li>
                                <?endif;?>

                                <?// Проверяем 2-комнатные ?>
                                <?if(!empty($arItem["PROPERTIES"]["AREA_2_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_2_ROOM_FROM"]["VALUE"])):?>
                                    <li>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span>2-комнатные</span></a>
                                        <span>от <?=$arItem["PROPERTIES"]["AREA_2_ROOM_FROM"]["VALUE"]?> м²</span>
                                        <span>от <?=number_format($arItem["PROPERTIES"]["PRICE_2_ROOM_FROM"]["VALUE"], 0, ' ', ' ')?> ₸</span>
                                    </li>
                                <?endif;?>

                                <?// Проверяем 3-комнатные  ?>
                                <?if(!empty($arItem["PROPERTIES"]["AREA_3_ROOM_FROM"]["VALUE"]) && !empty($arItem["PROPERTIES"]["PRICE_3_ROOM_FROM"]["VALUE"])):?>
                                    <li>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span>3-комнатные</span></a>
                                        <span>от <?=$arItem["PROPERTIES"]["AREA_3_ROOM_FROM"]["VALUE"]?> м²</span>
                                        <span>от <?=number_format($arItem["PROPERTIES"]["PRICE_3_ROOM_FROM"]["VALUE"], 0, ' ', ' ')?> ₸</span>
                                    </li>
                                <?endif;?>
                            </ul>

                            <?if($delivery_date):?>
                            <p class="offer-card__delivery-date">Срок сдачи: <?=htmlspecialcharsbx($delivery_date)?></p>
                            <?endif;?>
                        </div>
                    </div>
                    <?if($finishing):?>
                    <div class="offer-card__footer-info">
                        <span class="badge badge--finishing"><?=htmlspecialcharsbx($finishing)?></span>
                    </div>
                    <?endif;?>
                </div>
            <?endforeach;?>

            </div>
        </section>
    <?else:?>
        <div class="no-results-message">
            <div class="no-results-content">
                <h3>По заданным критериям ничего не найдено</h3>
                <p>Попробуйте изменить параметры фильтра или <a href="<?=$APPLICATION->GetCurPageParam("", array("set_filter", "del_filter"), false)?>">сбросить фильтр</a></p>
            </div>
        </div>
    <?endif;?>

    <?// Скрытый элемент для обновления счетчика в фильтре ?>
    <script>
        BX.ready(function() {
            var countElement = BX('modef_num');
            if (countElement) {
                countElement.innerHTML = 'Найдено <?=count($arResult["ITEMS"])?> проектов';
            }
        });
    </script>
</div>