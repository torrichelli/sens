<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
// --- ОБРАБОТЧИК ФОРМЫ ОТКЛИКА ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_apply_form"])) {
    // ... (код обработки формы, который мы добавим позже, если нужно) ...
}
?>

<div class="container vacancy-detail-page">
    <div class="row">
        <?// --- ОСНОВНОЙ КОНТЕНТ ВАКАНСИИ --- ?>
        <div class="col-lg-8">
            <h1 class="vacancy-detail-title"><?=$arResult["NAME"]?></h1>
            <div class="vacancy-detail-meta">
                <?if($arResult["PROPERTIES"]["REGION"]["VALUE"]):?><span><?=$arResult["PROPERTIES"]["REGION"]["VALUE"]?></span><?endif;?>
                <?if($arResult["PROPERTIES"]["WORK_FORMAT"]["VALUE"]):?><span><?=$arResult["PROPERTIES"]["WORK_FORMAT"]["VALUE"]?></span><?endif;?>
                <?if($arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"]):?><span><?=$arResult["PROPERTIES"]["EXPERIENCE"]["VALUE"]?></span><?endif;?>
            </div>
            <div class="vacancy-detail-content">
                <?if(!empty($arResult["PROPERTIES"]["RESPONSIBILITIES"]["~VALUE"]["TEXT"])):?>
                    <h3 class="vacancy-section-title">Чем предстоит заниматься</h3>
                    <?=$arResult["PROPERTIES"]["RESPONSIBILITIES"]["~VALUE"]["TEXT"]?>
                <?endif;?>

                <?if(!empty($arResult["PROPERTIES"]["REQUIREMENTS"]["~VALUE"]["TEXT"])):?>
                    <h3 class="vacancy-section-title">Что мы ожидаем от вас</h3>
                    <?=$arResult["PROPERTIES"]["REQUIREMENTS"]["~VALUE"]["TEXT"]?>
                <?endif;?>
            </div>
        </div>

        <?// --- САЙДБАР С КНОПКОЙ И ПРЕИМУЩЕСТВАМИ --- ?>
        <div class="col-lg-4">
            <aside class="vacancy-sidebar">
                <a href="#apply-form-section" class="btn btn-primary btn-lg w-100">Откликнуться</a>
                <?if(!empty($arResult["PROPERTIES"]["WE_OFFER"]["~VALUE"]["TEXT"])):?>
                    <div class="perks-block">
                        <h4 class="perks-title">Что мы предлагаем</h4>
                        <?=$arResult["PROPERTIES"]["WE_OFFER"]["~VALUE"]["TEXT"]?>
                    </div>
                <?endif;?>
            </aside>
        </div>
    </div>

    <?// --- ФОРМА ОТКЛИКА --- ?>
    <section id="apply-form-section" class="pt-5 mt-5 border-top">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center mb-4">Отклик на вакансию</h2>
                <div class="career-apply-form">
                    <form action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data">
                        <?// ... здесь будет код самой формы, как мы делали ранее ... ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>