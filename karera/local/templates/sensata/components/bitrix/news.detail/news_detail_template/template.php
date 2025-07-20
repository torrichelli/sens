<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
?>
<div class="news-detail-page">
    <div class="page-header-simple mb-4">
        <?// Выводим хлебные крошки ?>
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "custom_breadcrumb", Array("START_FROM" => "0", "PATH" => "", "SITE_ID" => SITE_ID));?>
    </div>

    <?// Выводим заголовок новости ?>
    <h1 class="page-main-title large-title mb-3"><?=$arResult["NAME"]?></h1>

    <?// Выводим дату и категорию ?>
    <div class="news-detail-meta">
         <?
        // --- НАЧАЛО БЛОКА ФОРМАТИРОВАНИЯ ДАТЫ СОЗДАНИЯ ---
        if(!empty($arResult["DATE_CREATE"])) {
            $formattedDate = FormatDate(
                "j F Y", 
                MakeTimeStamp($arResult["DATE_CREATE"])
            );
        } else {
            // Если дата создания пуста, используем дату активности
            $formattedDate = $arResult["DISPLAY_ACTIVE_FROM"];
        }
        // --- КОНЕЦ БЛОКА ---
        ?>
        <?if($formattedDate):?>
            <span class="news-card__date"><?=$formattedDate?></span>
        <?endif;?>

        <?if(!empty($arResult["PROPERTIES"]["CATEGORY"]["VALUE"])):?>
            <span class="news-detail-category"><?=$arResult["PROPERTIES"]["CATEGORY"]["VALUE"]?></span>
        <?endif;?>
    </div>

    <?// Выводим детальное изображение, если оно есть ?>
    <?if($arResult["DETAIL_PICTURE"]["SRC"]):?>
        <img class="img-fluid  mb-4 news-detail-image"
             src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
             alt="<?=$arResult["NAME"]?>"/>
    <?endif?>

    <?// Выводим полный текст новости ?>
    <div class="news-detail-content">
        <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
            <?echo $arResult["DETAIL_TEXT"];?>
        <?else:?>
            <?echo $arResult["PREVIEW_TEXT"];?>
        <?endif?>
    </div>

    <div class="news-detail-back-link-wrapper mt-5">
         <a href="<?=$arParams["LIST_PAGE_URL"]?>" class="news-detail-back-link">
            &larr; Вернуться к списку новостей
         </a>
    </div>
</div>