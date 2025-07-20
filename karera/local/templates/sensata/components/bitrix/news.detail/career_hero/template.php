<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// Получаем путь к фоновому изображению
$heroBgPath = !empty($arResult["PROPERTIES"]["CAREER_HERO_IMAGE"]["VALUE"]) ? CFile::GetPath($arResult["PROPERTIES"]["CAREER_HERO_IMAGE"]["VALUE"]) : "";
?>

<?// --- НАЧАЛО ОБНОВЛЕННОЙ СЕКЦИИ --- ?>
<section class="career-hero-section" style="background-image: url('<?=$heroBgPath?>');">
    <div class="career-hero-overlay"></div> <?// Добавляем слой для затемнения и лучшей читаемости текста ?>
    <div class="container text-center">
        <?if(!empty($arResult["PROPERTIES"]["CAREER_HERO_TITLE"]["VALUE"])):?>
            <h1 class="career-hero-title"><?=$arResult["PROPERTIES"]["CAREER_HERO_TITLE"]["VALUE"]?></h1>
        <?else:?>
            <h1 class="career-hero-title"><?=$arResult["NAME"]?></h1>
        <?endif;?>
        
        <?if(!empty($arResult["PROPERTIES"]["CAREER_HERO_SUBTITLE"]["VALUE"])):?>
            <p class="career-hero-subtitle"><?=$arResult["PROPERTIES"]["CAREER_HERO_SUBTITLE"]["VALUE"]?></p>
        <?endif;?>

        <a href="#vacancies" class="btn btn-primary btn-lg">Хочу в команду!</a>
    </div>
</section>
<?// --- КОНЕЦ ОБНОВЛЕННОЙ СЕКЦИИ --- ?>