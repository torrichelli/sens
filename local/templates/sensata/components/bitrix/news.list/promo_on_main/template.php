<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// --- НОВАЯ ЛОГИКА РАЗДЕЛЕНИЯ БАННЕРОВ ---
$timerItem = null;
$simpleItems = [];

// Ищем баннер, у которого заполнена дата окончания. Он и будет главным.
foreach ($arResult["ITEMS"] as $key => $item) {
    if (!empty($item["PROPERTIES"]["PROMO_END_DATE"]["VALUE"])) {
        $timerItem = $item;
        unset($arResult["ITEMS"][$key]); // Удаляем его из общего массива
        break; 
    }
}

// Если баннер с датой не найден, берем первый попавшийся на роль главного
if (!$timerItem && !empty($arResult["ITEMS"])) {
    $timerItem = array_shift($arResult["ITEMS"]);
}

// Все остальные элементы - простые баннеры
$simpleItems = $arResult["ITEMS"];
?>

<section class="hero-2col-section">
    <div class="hero-2col-container">
        <?if($timerItem):
            // Определяем класс стиля для главного баннера
            $timerItemClass = $timerItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] ?: 'accent-style';
        ?>
        <div class="hero-col hero-col-1">
            <div class="hero-col1-item hero-col1-item-top <?=$timerItemClass?>">
                <a href="<?=$timerItem["PROPERTIES"]["PROMO_LINK"]["VALUE"]?>" class="hero-item-link">
                    <div class="card-main-content">
                        <?if($timerItem["PROPERTIES"]["PROMO_END_DATE"]["VALUE"]):?>
                        <div class="timer-block" data-end-date="<?=FormatDate("Y-m-d H:i:s", MakeTimeStamp($timerItem["PROPERTIES"]["PROMO_END_DATE"]["VALUE"]))?>">
                            <div class="timer-label">До окончания программы:</div>
                            <div class="timer-values">
                                <div class="timer-item"><span class="timer-value" data-timer="days">00</span><span class="timer-unit">дней</span></div>
                                <span class="timer-separator">:</span>
                                <div class="timer-item"><span class="timer-value" data-timer="hours">00</span><span class="timer-unit">часов</span></div>
                                <span class="timer-separator">:</span>
                                <div class="timer-item"><span class="timer-value" data-timer="minutes">00</span><span class="timer-unit">минут</span></div>
                                <span class="timer-separator">:</span>
                                <div class="timer-item"><span class="timer-value" data-timer="seconds">00</span><span class="timer-unit">секунд</span></div>
                            </div>
                        </div>
                        <?endif;?>
                        <p class="card-title large-title"><?=$timerItem["NAME"]?></p>
                    </div>
                    <div class="card-footer-content">
                        <span class="custom-btn card-button">Подробнее</span>
                    </div>
                </a>
            </div>
            <div class="hero-col1-bottom-items">
                <?
                $bottomItems = array_slice($simpleItems, 0, 2);
                foreach($bottomItems as $item):
                    $itemClass = $item["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] ?: 'light-style';
                ?>
                <div class="hero-col1-item hero-col1-item-bottom <?=$itemClass?>">
                    <a href="<?=$item["PROPERTIES"]["PROMO_LINK"]["VALUE"]?>" class="hero-item-link">
                        <div class="card-main-content">
                            <p class="card-title small-title"><?=$item["NAME"]?></p>
                            <?if($item["PROPERTIES"]["PROMO_SUBTITLE"]["VALUE"]):?>
                            <div class="card-description"><p><?=$item["PROPERTIES"]["PROMO_SUBTITLE"]["VALUE"]?></p></div>
                            <?endif;?>
                        </div>
                        <div class="card-footer-content top-right-icon">
                            <span class="custom-btn-icon card-button-icon-only"><svg viewBox="0 0 32 32"><path fill="currentColor" d="m22.933 15.852-10.55 10.55-1.924-1.923 8.615-8.615-8.609-8.497 1.911-1.936z"></path></svg></span>
                        </div>
                        <?if($item["PROPERTIES"]["PROMO_IMAGE"]["VALUE"]):?>
                        <div class="card-thumb-image-area">
                            <img src="<?=CFile::GetPath($item["PROPERTIES"]["PROMO_IMAGE"]["VALUE"])?>" alt="<?=$item["NAME"]?>" class="card-thumb-image">
                        </div>
                        <?endif;?>
                    </a>
                </div>
                <?endforeach;?>
            </div>
        </div>
        <?endif;?>

        <?
        $sideItem = array_slice($simpleItems, 2, 1)[0];
        if($sideItem):
            $sideItemClass = $sideItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] ?: 'accent-style with-image';
        ?>
        <div class="hero-col hero-col-2">
            <div class="hero-col2-item <?=$sideItemClass?>">
                 <a href="<?=$sideItem["PROPERTIES"]["PROMO_LINK"]["VALUE"]?>" class="hero-item-link">
                    <div class="card-main-content">
                        <p class="card-title large-title"><?=$sideItem["NAME"]?></p>
                        <?if($sideItem["PROPERTIES"]["PROMO_SUBTITLE"]["VALUE"]):?>
                            <p style="font-size: 14px; color: aliceblue;"><?=$sideItem["PROPERTIES"]["PROMO_SUBTITLE"]["VALUE"]?></p>
                        <?endif;?>
                    </div>
                    <?if($sideItem["PROPERTIES"]["PROMO_IMAGE"]["VALUE"]):?>
                    <div class="card-image-area">
                         <img src="<?=CFile::GetPath($sideItem["PROPERTIES"]["PROMO_IMAGE"]["VALUE"])?>" alt="<?=$sideItem["NAME"]?>" class="card-main-image">
                    </div>
                    <?endif;?>
                    <div class="card-footer-content bottom-left">
                         <span class="custom-btn card-button">Подробнее</span>
                    </div>
                </a>
            </div>
        </div>
        <?endif;?>
    </div>
</section>