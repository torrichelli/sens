<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
?>
<div class="about-page">
    <?// Проверяем, что данные элемента получены ?>
    <?if($arResult):?>
        
        <?
        // --- Готовим переменные для удобства ---
        $heroTitle = $arResult["PROPERTIES"]["HERO_TITLE"]["VALUE"];
        $heroSubtitle = $arResult["PROPERTIES"]["HERO_SUBTITLE"]["~VALUE"]["TEXT"];
        $heroBgPath = CFile::GetPath($arResult["PROPERTIES"]["HERO_BACKGROUND"]["VALUE"]);
        ?>
        
        <?// --- Секция HERO --- ?>
        <section class="about-hero-section" style="background-image: url('<?=$heroBgPath?>');">
            <div class="about-hero-overlay"></div>
            <div class="container-fluid header-container position-relative" style="z-index: 2;">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8 text-center about-hero-content">
                        <?if($heroTitle):?>
                            <h1 class="about-hero-title display-4 mb-4"><?=$heroTitle?></h1>
                        <?endif;?>
                        <?if($heroSubtitle):?>
                            <div class="about-hero-subtitle lead mb-5">
                                <?=$heroSubtitle?>
                            </div>
                        <?endif;?>

                        <div class="about-hero-stats row g-3">
                            <?for($i = 1; $i <= 4; $i++):
                                $statNum = $arResult["PROPERTIES"]["STAT_{$i}_NUMBER"]["VALUE"];
                                $statText = $arResult["PROPERTIES"]["STAT_{$i}_TEXT"]["VALUE"];
                                if($statNum && $statText):?>
                                    <div class="col-6 col-md-3">
                                        <div class="stat-item">
                                            <div class="stat-number"><?=$statNum?></div>
                                            <div class="stat-label"><?=$statText?></div>
                                        </div>
                                    </div>
                                <?endif;
                            endfor;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?// --- Секция ВВЕДЕНИЕ --- ?>
        <?if(!empty($arResult["PROPERTIES"]["INTRO_TEXT"]["~VALUE"]["TEXT"])):?>
        <section class="about-introduction-section section-padding">
            <div class="container-fluid header-container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                         <?=$arResult["PROPERTIES"]["INTRO_TEXT"]["~VALUE"]["TEXT"]?>
                    </div>
                </div>
            </div>
        </section>
        <?endif;?>
        
        <?// --- Секция НАПРАВЛЕНИЯ ДЕЯТЕЛЬНОСТИ --- ?>
        <?if(!empty($arResult["PROPERTIES"]["PRINCIPLES_TITLES"]["VALUE"])):?>
        <section class="key-principles-section section-padding bg-light">
            <div class="container-fluid header-container">
                <h2 class="section-title text-center mb-5">Наши направления деятельности</h2>
                <div class="row g-4 justify-content-center">
                    <?foreach($arResult["PROPERTIES"]["PRINCIPLES_TITLES"]["VALUE"] as $key => $title):
                        $iconId = $arResult["PROPERTIES"]["PRINCIPLES_ICONS"]["VALUE"][$key];
                        $iconSrc = CFile::GetPath($iconId);
                        $text = $arResult["PROPERTIES"]["PRINCIPLES_TEXTS"]["VALUE"][$key];
                    ?>
                        <div class="col-md-6 col-lg-3 d-flex">
                            <div class="principle-card text-center p-4 w-100">
                                <?if($iconSrc):?>
                                <div class="principle-icon mb-3">
                                    <img src="<?=$iconSrc?>" alt="<?=$title?>" class="img-fluid">
                                </div>
                                <?endif;?>
                                <h4 class="principle-title mb-2"><?=$title?></h4>
                                <p class="principle-text text-muted small"><?=$text?></p>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        </section>
        <?endif;?>

        <?// --- Секция ПАРТНЕРЫ (с анимацией и ссылками) --- ?>
<?if(!empty($arResult["PROPERTIES"]["PARTNER_LOGOS"]["VALUE"])):?>
<section class="partners-section section-padding">
    <div class="container-fluid header-container">
        <h2 class="section-title text-center mb-5">Наши партнеры</h2>
        <div class="partner-logos-scroll-container">
            <div class="partner-logos-strip">
                <?
                $partner_logos = $arResult["PROPERTIES"]["PARTNER_LOGOS"]["VALUE"];
                $partner_links = $arResult["PROPERTIES"]["PARTNER_LINKS"]["VALUE"];

                // --- Выводим первый набор логотипов ---
                foreach($partner_logos as $key => $logoId):
                    $logoSrc = CFile::GetPath($logoId);
                    $link = !empty($partner_links[$key]) ? htmlspecialchars($partner_links[$key]) : '#';
                ?>
                <div class="partner-logo-item">
                    <a href="<?=$link?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?=$logoSrc?>" alt="Логотип Партнера">
                    </a>
                </div>
                <?endforeach;?>

                <?// --- Выводим ВТОРОЙ (дублирующий) набор логотипов для бесшовной анимации --- ?>
                <?foreach($partner_logos as $key => $logoId):
                    $logoSrc = CFile::GetPath($logoId);
                    $link = !empty($partner_links[$key]) ? htmlspecialchars($partner_links[$key]) : '#';
                ?>
                <div class="partner-logo-item">
                    <a href="<?=$link?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?=$logoSrc?>" alt="Логотип Партнера">
                    </a>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</section>
<?endif;?>

    <?endif; // Конец проверки if($arResult) ?>
</div>