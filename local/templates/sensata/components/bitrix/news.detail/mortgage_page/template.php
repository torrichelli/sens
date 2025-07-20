<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

    <section class="mortgage-hero-section text-center pt-5 pb-4">
        <div class="container">
            <h1 class="page-main-title"><?=$arResult["PROPERTIES"]["PAGE_TITLE"]["VALUE"] ?: $arResult["NAME"]?></h1>
            <?if($arResult["PROPERTIES"]["PAGE_SUBTITLE"]["~VALUE"]["TEXT"]):?>
                <p class="lead text-muted col-md-8 mx-auto"><?=$arResult["PROPERTIES"]["PAGE_SUBTITLE"]["~VALUE"]["TEXT"]?></p>
            <?endif;?>
        </div>
    </section>

    <?// --- ВЫВОД ИПОТЕЧНЫХ ПРОГРАММ --- ?>
    <section class="mortgage-programs-section section-padding">
        <div class="container">
            <?if(!empty($arResult["PROPERTIES"]["PROGRAMS_TITLE"]["VALUE"])):?>
                <h2 class="section-title text-center mb-5"><?=$arResult["PROPERTIES"]["PROGRAMS_TITLE"]["VALUE"]?></h2>
            <?endif;?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "mortgage_programs_list",
                [
                    "IBLOCK_TYPE" => "content", // Укажите правильный тип инфоблока
                    "IBLOCK_ID" => $arParams["MORTGAGE_PROGRAMS_IBLOCK_ID"],
                    "NEWS_COUNT" => "10",
                    "SORT_BY1" => "SORT", "SORT_ORDER1" => "ASC",
                    "PROPERTY_CODE" => ["FEATURES", "BUTTON_TEXT"],
                    "FIELD_CODE" => ["NAME", "PREVIEW_TEXT"],
                    "CACHE_TYPE" => "A", "CACHE_TIME" => "36000000",
                ],
                $component
            );?>
        </div>
    </section>

    <?// --- ВЫВОД БАНКОВ-ПАРТНЕРОВ --- ?>
    <section class="bank-partners-section section-padding bg-light">
        <div class="container">
            <?if(!empty($arResult["PROPERTIES"]["PARTNERS_TITLE"]["VALUE"])):?>
                <h2 class="section-title text-center mb-5"><?=$arResult["PROPERTIES"]["PARTNERS_TITLE"]["VALUE"]?></h2>
            <?endif;?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "bank_partners_list",
                [
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => $arParams["BANK_PARTNERS_IBLOCK_ID"],
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "SORT", "SORT_ORDER1" => "ASC",
                    "PROPERTY_CODE" => ["LOGO", "PARTNER_URL"],
                    "FIELD_CODE" => ["NAME"],
                    "CACHE_TYPE" => "A", "CACHE_TIME" => "36000000",
                ],
                $component
            );?>
        </div>
    </section>
    
    <?// --- ДИНАМИЧЕСКИЙ БЛОК "КАК ПОЛУЧИТЬ ИПОТЕКУ" --- ?>
    <?if(!empty($arResult["PROPERTIES"]["STEPS_TITLES"]["VALUE"])):?>
    <section class="how-to-apply-section section-padding">
        <div class="container">
            <h2 class="section-title text-center mb-5"><?=$arResult["PROPERTIES"]["HOW_TO_APPLY_TITLE"]["VALUE"]?></h2>
            <div class="row g-4">
                <?foreach($arResult["PROPERTIES"]["STEPS_TITLES"]["VALUE"] as $key => $title):?>
                    <div class="col-md-6 col-lg-3">
                        <div class="step-card text-center">
                            <div class="step-number"><?=$key + 1?></div>
                            <h5 class="step-title"><?=$title?></h5>
                            <p><?=$arResult["PROPERTIES"]["STEPS_TEXTS"]["VALUE"][$key]?></p>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </section>
    <?endif;?>
    
    <?// --- ДИНАМИЧЕСКИЙ БЛОК "НЕОБХОДИМЫЕ ДОКУМЕНТЫ" --- ?>
    <?if(!empty($arResult["PROPERTIES"]["DOCS_LIST"]["VALUE"])):?>
    <section class="documents-section section-padding bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4"><?=$arResult["PROPERTIES"]["DOCS_TITLE"]["VALUE"]?></h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="list-group list-group-flush">
                        <?foreach($arResult["PROPERTIES"]["DOCS_LIST"]["VALUE"] as $doc):?>
                            <li class="list-group-item">
                                <img src="<?=$templateFolder?>/images/document-icon.svg" alt="" class="icon-list-item"> <?=$doc?>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?endif;?>

    <?// --- ДИНАМИЧЕСКИЙ БЛОК "FAQ" --- ?>
    <?if(!empty($arResult["PROPERTIES"]["FAQ_QUESTIONS"]["VALUE"])):?>
    <section class="faq-section section-padding">
        <div class="container">
            <h2 class="section-title text-center mb-5"><?=$arResult["PROPERTIES"]["FAQ_TITLE"]["VALUE"]?></h2>
            <div class="accordion" id="faqAccordion">
                <?foreach($arResult["PROPERTIES"]["FAQ_QUESTIONS"]["VALUE"] as $key => $question):
                    $collapseId = "faqCollapse".$key;
                    $headingId = "faqHeading".$key;
                ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="<?=$headingId?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?=$collapseId?>" aria-expanded="false" aria-controls="<?=$collapseId?>">
                                <?=$question?>
                            </button>
                        </h3>
                        <div id="<?=$collapseId?>" class="accordion-collapse collapse" aria-labelledby="<?=$headingId?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?=$arResult["PROPERTIES"]["FAQ_ANSWERS"]["~VALUE"][$key]["TEXT"]?>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </section>
    <?endif;?>

    <?// --- Форма консультации (статичная) --- ?>
    <section id="contact-form-section" class="cta-form-section section-padding bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="form-wrapper p-4 p-md-5 border rounded-3 bg-white shadow-sm">
                        <h2 class="section-title text-center mb-3">Получить консультацию по ипотеке</h2>
                        <p class="text-center text-muted mb-4">Оставьте свои данные, и наш специалист свяжется с вами в ближайшее время.</p>
                        <form id="mortgageConsultationForm">
                            <div class="mb-3">
                                <label for="userNameConsult" class="form-label">Ваше имя</label>
                                <input type="text" class="form-control form-control-lg" id="userNameConsult" name="userNameConsult" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPhoneConsult" class="form-label">Номер телефона</label>
                                <input type="tel" class="form-control form-control-lg" id="userPhoneConsult" name="userPhoneConsult" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="agreementConsult" name="agreementConsult" checked required>
                                <label class="form-check-label" for="agreementConsult"><small>Я согласен на обработку персональных данных.</small></label>
                            </div>
                            <button type="submit" class="custom-btn w-100 btn-lg">Отправить заявку</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>