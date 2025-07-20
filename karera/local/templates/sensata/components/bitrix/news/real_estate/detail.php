<?
// --- НАЧАЛО ОБРАБОТЧИКА ФОРМЫ ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_call_request"])) {
    // Простая защита от ботов
    if (isset($_POST["form_check"]) && empty($_POST["form_check"])) {
        
        $userName = htmlspecialchars($_POST["user_name"]);
        $userPhone = htmlspecialchars($_POST["user_phone"]);
        $userCity = htmlspecialchars($_POST["user_city"]);
        $pageTitle = htmlspecialchars($_POST["page_title"]);

        if (!empty($userName) && !empty($userPhone) && !empty($userCity)) {
            $arEventFields = [
                "USER_NAME" => $userName,
                "USER_PHONE" => $userPhone,
                "USER_CITY" => $userCity,
                "PAGE_TITLE" => $pageTitle,
                "EMAIL_TO" => COption::GetOptionString("main", "email_from"), // Отправляем на email администратора сайта
            ];
            
            CEvent::Send("REQUEST_CALL_FORM", SITE_ID, $arEventFields);
            
            // Перенаправляем пользователя, чтобы показать сообщение об успехе
            LocalRedirect($APPLICATION->GetCurPageParam("success=Y", ["success"], false)."#contacts");
            exit();
        }
    }
}
// --- КОНЕЦ ОБРАБОТЧИКА ФОРМЫ ---?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var string $templateFolder */
$this->setFrameMode(true);

if (empty($arResult["ID"]) && !empty($arResult["VARIABLES"]["ELEMENT_CODE"]) && CModule::IncludeModule("iblock")) {
    $arFilter = [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
        "ACTIVE" => "Y",
        "CHECK_PERMISSIONS" => "N"
    ];
    $obElement = CIBlockElement::GetList([], $arFilter, false, false, [])->GetNextElement();
    if ($obElement) {
        $arResult = $obElement->GetFields();
        $arResult["PROPERTIES"] = $obElement->GetProperties();
    }
}
$this->addExternalCss("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css");
$this->addExternalCss($templateFolder."/style.css");
$this->addExternalJS("https://unpkg.com/imask");
$this->addExternalCss("https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css");
$this->addExternalJS("https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js");
$this->addExternalJS("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js");
if (file_exists($_SERVER['DOCUMENT_ROOT'].$templateFolder.'/scriptss.js')) {
    $this->addExternalJS($templateFolder."/scriptss.js");
}
?>
<?if(!empty($arResult["ID"])):?>
    <section id="hero" class="py-4">
        <div class="container">
            <div class="hero-slider-wrapper">
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?
                        $photos = [];
                        if (!empty($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) {
                            foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $photoId) {
                                $photoFile = CFile::GetFileArray($photoId);
                                if ($photoFile) {
                                    $photos[] = $photoFile;
                                }
                            }
                        } elseif (!empty($arResult["DETAIL_PICTURE"]["SRC"])) {
                            $photos[] = $arResult["DETAIL_PICTURE"];
                        }

                        if (!empty($photos)) {
                            foreach ($photos as $key => $photo) {
                        ?>
                                <div class="carousel-item <?if ($key == 0) echo 'active';?>"
                                     style="background-image: url('<?=$photo["SRC"]?>'); background-size: cover; background-position: center; height: 600px;">
                                </div>
                        <?
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="static-hero-content">
                    <div class="carousel-caption">
                        <span class="project-tag">Проект</span>
                        <h1 class="slide-title"><?=$arResult["NAME"]?></h1>
                        <?if($arResult["PREVIEW_TEXT"]):?>
                            <p class="slide-subtitle"><?=$arResult["PREVIEW_TEXT"]?></p>
                        <?endif;?>
                        <div class="slide-features">
                            <?if(!empty($arResult["PROPERTIES"]["FEATURES_HERO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["FEATURES_HERO"]["VALUE"])):?>
                                <?foreach($arResult["PROPERTIES"]["FEATURES_HERO"]["VALUE"] as $feature):?>
                                    <span class="badge badge-main"><?=$feature?></span>
                                <?endforeach;?>
                            <?endif;?>
                        </div>
                    </div>
                </div>
                <?if (count($photos) > 1): ?>
                    <div class="static-hero-controls">
                        <div class="carousel-indicators">
                            <?foreach ($photos as $key => $photo):?>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?=$key?>" class="<?if($key == 0) echo 'active';?>" aria-current="true" aria-label="Slide <?=$key+1?>"></button>
                            <?endforeach;?>
                        </div>
                    </div>
                <?endif;?>
            </div>
        </div>
    </section>

    <section class="info-bar-section">
        <div class="container">
            <div class="info-bar">
                <div class="info-bar-left">
                    <p><strong><?=$arResult["PROPERTIES"]["DELIVERY_DATE_DETAIL"]["VALUE"]?></strong></p>
                </div>
                <div class="info-bar-right">
                    <p><i class="fas fa-map-marker-alt me-2"></i> <?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="about-project" class="about-project-section">
        <div class="container about-container">
            <div class="row align-items-center">
                <div class="col-lg-6 about-section1">
                    <div class="about-project-content">
                        <?if($arResult["DETAIL_TEXT"]):?>
                            <?=$arResult["DETAIL_TEXT"]?>
                        <?endif;?>
                        <?if(!empty($arResult["PROPERTIES"]["BOOKLET_FILE"]["VALUE"]) || !empty($arResult["PROPERTIES"]["CALCULATOR_LINK"]["VALUE"])):?>
                            <div class="about-project-buttons">
                                <?if(!empty($arResult["PROPERTIES"]["BOOKLET_FILE"]["VALUE"])):
                                    $bookletLink = CFile::GetPath($arResult["PROPERTIES"]["BOOKLET_FILE"]["VALUE"]);
                                ?>
                                    <a href="<?=$bookletLink?>" class="btn btn-light-custom" target="_blank" download><i class="fas fa-download me-2"></i>Скачать буклет</a>
                                <?endif;?>
                                <?if(!empty($arResult["PROPERTIES"]["CALCULATOR_LINK"]["VALUE"])):?>
                                    <a href="<?=$arResult["PROPERTIES"]["CALCULATOR_LINK"]["VALUE"]?>" class="btn btn-gradient" target="_blank">Посетить сайт</a>
                                <?endif;?>
                            </div>
                        <?endif;?>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <?if(!empty($arResult["PROPERTIES"]["ABOUT_PROJECT_GALLERY"]["VALUE"]) && is_array($arResult["PROPERTIES"]["ABOUT_PROJECT_GALLERY"]["VALUE"])):?>
                        <div id="projectGallery" class="carousel slide carousel-fade project-gallery" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?foreach($arResult["PROPERTIES"]["ABOUT_PROJECT_GALLERY"]["VALUE"] as $key => $photoId):
                                    $photo = CFile::GetFileArray($photoId);
                                    if($photo):?>
                                        <div class="carousel-item <?if($key == 0) echo 'active';?>">
                                            <img src="<?=$photo["SRC"]?>" class="d-block w-100" alt="<?=$photo["DESCRIPTION"] ?: $arResult["NAME"]?>">
                                            <a href="<?=$photo["SRC"]?>" class="glightbox project-gallery-expand" data-gallery="project-gallery" aria-label="Увеличить фото">
                                                <i class="fas fa-expand"></i>
                                            </a>
                                            <?if($photo["DESCRIPTION"]):?>
                                                <div class="gallery-caption"><?=$photo["DESCRIPTION"]?></div>
                                            <?endif;?>
                                        </div>
                                    <?endif;
                                endforeach;?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#projectGallery" data-bs-slide="prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#projectGallery" data-bs-slide="next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <h2 class="feature-title"><?=$arResult["PROPERTIES"]["CLASS"]["VALUE"]?></h2>
                    <p class="feature-subtitle text-muted">Класс жилья</p>
                </div>
                <div class="col-md-3">
                    <h2 class="feature-title"><?=$arResult["PROPERTIES"]["CEILING_HEIGHT"]["VALUE"]?></h2>
                    <p class="feature-subtitle text-muted">Высота потолков</p>
                </div>
                <div class="col-md-3">
                    <h2 class="feature-title"><?=$arResult["PROPERTIES"]["WINDOW_HEIGHT"]["VALUE"]?></h2>
                    <p class="feature-subtitle text-muted">Высота окон</p>
                </div>
                <div class="col-md-3">
                    <?if(!empty($arResult["PROPERTIES"]["FEATURE_4_TEXT"]["VALUE"])):?>
                         <h2 class="feature-title"><?=$arResult["PROPERTIES"]["FEATURE_4_TEXT"]["VALUE"]?></h2>
                    <?else:?>
                         <h2 class="feature-title"><?=$arResult["PROPERTIES"]["FINISHING"]["VALUE"]?></h2>
                    <?endif;?>
                    <p class="feature-subtitle text-muted">Отделка</p>
                </div>
            </div>
        </div>
    </section>

    <?if(!empty($arResult["PROPERTIES"]["PANORAMA_EMBED_CODE"]["~VALUE"]["TEXT"])):?>
    <section id="panorama" class="panorama-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Панорама</h2>
            </div>
            <div class="panorama-embed-wrapper">
                <?=$arResult["PROPERTIES"]["PANORAMA_EMBED_CODE"]["~VALUE"]["TEXT"]?>
            </div>
        </div>
    </section>
    <?endif;?>

    <?
    if (!empty($arResult["PROPERTIES"]["NEARBY_PLACES"]["VALUE"]) && CModule::IncludeModule("iblock")):
        $arNearbyPlaces = [];
        $arNearbyFilter = [ "IBLOCK_ID" => $arResult["PROPERTIES"]["NEARBY_PLACES"]["LINK_IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["NEARBY_PLACES"]["VALUE"], "ACTIVE" => "Y" ];
        $arNearbySelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "DETAIL_PICTURE"];
        $rsNearbyElements = CIBlockElement::GetList([], $arNearbyFilter, false, false, $arNearbySelect);
        while ($arNearbyElement = $rsNearbyElements->GetNext()) {
            if ($arNearbyElement["DETAIL_PICTURE"]) { $arNearbyElement["DETAIL_PICTURE"] = CFile::GetFileArray($arNearbyElement["DETAIL_PICTURE"]); }
            $arNearbyPlaces[] = $arNearbyElement;
        }
        if (!empty($arNearbyPlaces)):
            $arNearbyChunks = array_chunk($arNearbyPlaces, 3);
    ?>
    <section id="nearby" class="nearby-section">
        <div class="container">
            <div class="nearby-wrapper">
                <h2 class="section-title">Что интересного рядом</h2>
                <div id="nearbyCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?foreach($arNearbyChunks as $key => $arChunk):?>
                            <div class="carousel-item <?if($key == 0) echo 'active';?>">
                                <div class="row g-4">
                                    <?foreach($arChunk as $arPlace):?>
                                        <div class="col-md-4">
                                            <div class="card nearby-card">
                                                <?if(!empty($arPlace["DETAIL_PICTURE"]["SRC"])):?>
                                                    <img src="<?=$arPlace["DETAIL_PICTURE"]["SRC"]?>" class="card-img-top" alt="<?=$arPlace["NAME"]?>">
                                                <?endif;?>
                                                <div class="card-body">
                                                    <h5 class="card-title"><?=$arPlace["NAME"]?></h5>
                                                    <?if($arPlace["DETAIL_TEXT"]):?>
                                                        <p class="card-text text-muted"><?=$arPlace["DETAIL_TEXT"]?></p>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach;?>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
                <div class="carousel-custom-controls">
                    <div class="progress-container">
                        <div class="progress-bar-custom"></div>
                    </div>
                    <div class="carousel-pagination-container">
                        <span class="carousel-pagination">1 / <?=count($arNearbyChunks)?></span>
                        <div class="carousel-nav-buttons">
                            <button class="btn-nav" type="button" data-bs-target="#nearbyCarousel" data-bs-slide="prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="btn-nav" type="button" data-bs-target="#nearbyCarousel" data-bs-slide="next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?
        endif;
    endif;
    ?>

    <?
    if (!empty($arResult["PROPERTIES"]["MAIN_FEATURES"]["VALUE"]) && CModule::IncludeModule("iblock")):
        $arMainFeatures = [];
        $arFeaturesFilter = [ "IBLOCK_ID" => $arResult["PROPERTIES"]["MAIN_FEATURES"]["LINK_IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["MAIN_FEATURES"]["VALUE"], "ACTIVE" => "Y" ];
        $arFeaturesSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "DETAIL_PICTURE"];
        $rsFeaturesElements = CIBlockElement::GetList(["SORT"=>"ASC"], $arFeaturesFilter, false, ["nTopCount" => 4], $arFeaturesSelect);
        while ($arFeatureElement = $rsFeaturesElements->GetNext()) {
            if ($arFeatureElement["DETAIL_PICTURE"]) { $arFeatureElement["DETAIL_PICTURE"] = CFile::GetFileArray($arFeatureElement["DETAIL_PICTURE"]); }
            $arMainFeatures[] = $arFeatureElement;
        }

        if (!empty($arMainFeatures)):
    ?>
    <section id="main-features" class="main-features-section">
        <div class="container">
            <h2 class="section-title text-center">Особенности</h2>
            <div class="row g-4">
                <?foreach($arMainFeatures as $arFeature):?>
                    <div class="col-md-6">
                        <div class="feature-item">
                            <?if(!empty($arFeature["DETAIL_PICTURE"]["SRC"])):?>
                                <img src="<?=$arFeature["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arFeature["NAME"]?>">
                            <?endif;?>
                            <div class="feature-caption"><?=$arFeature["NAME"]?></div>
                            <button type="button" class="btn-feature-play"
                                data-bs-toggle="modal"
                                data-bs-target="#featureDetailModal"
                                data-title="<?=htmlspecialchars($arFeature['NAME'])?>"
                                data-text="<?=htmlspecialchars($arFeature['DETAIL_TEXT'])?>"
                                data-image="<?=$arFeature["DETAIL_PICTURE"]["SRC"]?>">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </section>
    <?
        endif;
    endif;
    ?>

    <?// --- СЕКЦИЯ АРХИТЕКТУРА --- ?>
    <?if(!empty($arResult["PROPERTIES"]["ARCH_IMAGE"]["VALUE"])):?>
        <section id="architecture" class="architecture-section">
            <div class="container">
                <div class="architecture-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="architecture-content">
                                <?if(!empty($arResult["PROPERTIES"]["ARCH_TITLE"]["VALUE"])):?>
                                    <h2 class="section-title"><?=$arResult["PROPERTIES"]["ARCH_TITLE"]["VALUE"]?></h2>
                                <?endif;?>
                                <?if(!empty($arResult["PROPERTIES"]["ARCH_TEXT"]["~VALUE"]["TEXT"])):?>
                                    <div class="text-muted">
                                        <?=$arResult["PROPERTIES"]["ARCH_TEXT"]["~VALUE"]["TEXT"]?>
                                    </div>
                                <?endif;?>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="architecture-image-wrapper">
                                <?$arch_image_src = CFile::GetPath($arResult["PROPERTIES"]["ARCH_IMAGE"]["VALUE"]);?>
                                <img src="<?=$arch_image_src?>" alt="<?=$arResult["PROPERTIES"]["ARCH_TITLE"]["VALUE"]?>">
                                <a href="<?=$arch_image_src?>" class="glightbox project-gallery-expand" data-gallery="architecture-gallery" aria-label="Увеличить фото">
                                    <i class="fas fa-expand"></i>
                                </a>
                                <?if(!empty($arResult["PROPERTIES"]["HOTSPOT_TEXT"]["VALUE"])):?>
                                    <?foreach($arResult["PROPERTIES"]["HOTSPOT_TEXT"]["VALUE"] as $key => $text):
                                        $icon_class = $arResult["PROPERTIES"]["HOTSPOT_ICON"]["VALUE"][$key];
                                        $pos_top = $arResult["PROPERTIES"]["HOTSPOT_TOP"]["VALUE"][$key];
                                        $pos_left = $arResult["PROPERTIES"]["HOTSPOT_LEFT"]["VALUE"][$key];
                                    ?>
                                        <?if(!empty($text) && !empty($pos_top) && !empty($pos_left)):?>
                                        <div class="arch-hotspot"
                                             style="top: <?=$pos_top?>%; left: <?=$pos_left?>%;"
                                             data-bs-toggle="tooltip"
                                             data-bs-placement="top"
                                             title="<?=htmlspecialchars($text)?>">
                                            <?if(!empty($icon_class)):?>
                                                <i class="fas <?=$icon_class?>"></i>
                                            <?endif;?>
                                        </div>
                                        <?endif;?>
                                    <?endforeach;?>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?endif;?>


    <?// --- СЕКЦИЯ ДОСУГ --- ?>
    <?if(!empty($arResult["PROPERTIES"]["LEISURE_IMAGE"]["VALUE"]) && is_array($arResult["PROPERTIES"]["LEISURE_IMAGE"]["VALUE"])):?>
        <section id="leisure" class="leisure-section">
            <div class="container">
                <div class="leisure-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="leisure-content">
                                <?if(!empty($arResult["PROPERTIES"]["LEISURE_TITLE"]["VALUE"])):?>
                                    <h2 class="section-title"><?=$arResult["PROPERTIES"]["LEISURE_TITLE"]["VALUE"]?></h2>
                                <?endif;?>
                                <?if(!empty($arResult["PROPERTIES"]["LEISURE_TEXT"]["~VALUE"]["TEXT"])):?>
                                    <div class="text-muted">
                                        <?=$arResult["PROPERTIES"]["LEISURE_TEXT"]["~VALUE"]["TEXT"]?>
                                    </div>
                                <?endif;?>

                                <?if(!empty($arResult["PROPERTIES"]["LEISURE_FEATURES"]["~VALUE"])):?>
                                <div class="leisure-features">
                                    <div class="row">
                                        <?foreach($arResult["PROPERTIES"]["LEISURE_FEATURES"]["~VALUE"] as $key => $feature_text):
                                            $icon_class = $arResult["PROPERTIES"]["LEISURE_FEATURES"]["DESCRIPTION"][$key];
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="feature-pill">
                                                <i class="fas <?=$icon_class ?: 'fa-check'?>"></i>
                                                <span><?=$feature_text?></span>
                                            </div>
                                        </div>
                                        <?endforeach;?>
                                    </div>
                                </div>
                                <?endif;?>
                            </div>
                        </div>
                        <div class="col-lg-7 mt-4 mt-lg-0">
                            <div id="leisureCarousel" class="carousel slide leisure-image-wrapper project-gallery" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?foreach($arResult["PROPERTIES"]["LEISURE_IMAGE"]["VALUE"] as $key => $photoId):
                                        $photo = CFile::GetFileArray($photoId);
                                        if($photo):?>
                                            <div class="carousel-item <?if($key == 0) echo 'active';?>">
                                                <img src="<?=$photo["SRC"]?>" class="d-block w-100" alt="<?=$photo["DESCRIPTION"] ?: $arResult["PROPERTIES"]["LEISURE_TITLE"]["VALUE"]?>">
                                            </div>
                                        <?endif;
                                    endforeach;?>
                                </div>
                                <a href="#" class="glightbox project-gallery-expand" data-gallery="leisure-gallery" aria-label="Увеличить фото">
                                    <i class="fas fa-expand"></i>
                                </a>
                                <button class="carousel-control-prev" type="button" data-bs-target="#leisureCarousel" data-bs-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#leisureCarousel" data-bs-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?endif;?>


    <?// --- СЕКЦИЯ АТМОСФЕРА --- ?>
    <?if(!empty($arResult["PROPERTIES"]["ATMOSPHERE_GALLERY"]["VALUE"])):?>
        <section id="atmosphere" class="atmosphere-section">
            <div class="container">
                <div class="atmosphere-wrapper">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-7">
                            <div id="atmosphereCarousel" class="carousel slide atmosphere-gallery project-gallery" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?foreach($arResult["PROPERTIES"]["ATMOSPHERE_GALLERY"]["VALUE"] as $key => $photoId):
                                        $photo = CFile::GetFileArray($photoId);
                                        if($photo):
                                    ?>
                                        <div class="carousel-item <?if($key == 0) echo 'active';?>">
                                            <img src="<?=$photo["SRC"]?>" class="d-block w-100" alt="Интерьер холла <?=$key+1?>">
                                        </div>
                                    <?endif; endforeach;?>
                                </div>
                                <a href="#" class="glightbox project-gallery-expand" data-gallery="atmosphere-gallery" aria-label="Увеличить фото">
                                    <i class="fas fa-expand"></i>
                                </a>
                                <button class="carousel-control-prev" type="button" data-bs-target="#atmosphereCarousel" data-bs-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#atmosphereCarousel" data-bs-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="atmosphere-content">
                                <?if(!empty($arResult["PROPERTIES"]["ATMOSPHERE_TITLE"]["VALUE"])):?>
                                    <h2 class="section-title"><?=$arResult["PROPERTIES"]["ATMOSPHERE_TITLE"]["VALUE"]?></h2>
                                <?endif;?>
                                <?if(!empty($arResult["PROPERTIES"]["ATMOSPHERE_TEXT"]["~VALUE"]["TEXT"])):?>
                                    <div class="text-muted">
                                        <?=$arResult["PROPERTIES"]["ATMOSPHERE_TEXT"]["~VALUE"]["TEXT"]?>
                                    </div>
                                <?endif;?>

                                <?if(!empty($arResult["PROPERTIES"]["ATMOSPHERE_FEATURES"]["~VALUE"])):?>
                                <div class="atmosphere-features">
                                    <div class="row">
                                        <?foreach($arResult["PROPERTIES"]["ATMOSPHERE_FEATURES"]["~VALUE"] as $key => $feature_text):
                                            $icon_class = $arResult["PROPERTIES"]["ATMOSPHERE_FEATURES"]["DESCRIPTION"][$key];
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="feature-pill">
                                                <i class="fas <?=$icon_class ?: 'fa-check'?>"></i>
                                                <span><?=$feature_text?></span>
                                            </div>
                                        </div>
                                        <?endforeach;?>
                                    </div>
                                </div>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?endif;?>


    <?
    // --- НАЧАЛО БЛОКА ПЛАНИРОВОК ---
    if (!empty($arResult["PROPERTIES"]["LAYOUTS"]["VALUE"]) && CModule::IncludeModule("iblock")):
        $arLayouts = [];
        $layoutsIblockId = $arResult["PROPERTIES"]["LAYOUTS"]["LINK_IBLOCK_ID"];

        $arLayoutsFilter = [
            "IBLOCK_ID" => $layoutsIblockId,
            "ID" => $arResult["PROPERTIES"]["LAYOUTS"]["VALUE"],
            "ACTIVE" => "Y"
        ];
        
        $arLayoutsSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_LAYOUT_IMAGE", "PROPERTY_LAYOUT_AREA", "PROPERTY_LAYOUT_PRICE", "PROPERTY_LAYOUT_ROOMS"];
        
        $rsLayouts = CIBlockElement::GetList(["SORT" => "ASC"], $arLayoutsFilter, false, false, $arLayoutsSelect);
        while ($arLayout = $rsLayouts->GetNext()) {
            if ($arLayout["PROPERTY_LAYOUT_IMAGE_VALUE"]) {
                $arLayout["IMAGE_SRC"] = CFile::GetPath($arLayout["PROPERTY_LAYOUT_IMAGE_VALUE"]);
            }
            $arLayouts[] = $arLayout;
        }

        if (!empty($arLayouts)):
    ?>
    <section id="layouts" class="layouts-v2-section">
        <div class="container">
            <div class="layouts-v2-wrapper">
                <div class="layouts-v2-header">
                    <div class="layouts-v2-filters">
                        <button class="btn-filter active" data-filter="all">Все</button>
                        <button class="btn-filter" data-filter="1">1</button>
                        <button class="btn-filter" data-filter="2">2</button>
                        <button class="btn-filter" data-filter="3">3</button>
                        <button class="btn-filter" data-filter="4">4</button>
                        <button class="btn-filter" data-filter="5+">5+</button>
                    </div>
                    <h2 class="section-title">Планировочные решения</h2>
                </div>

                <div id="layoutsCarousel" class="carousel slide layouts-carousel-style">
                    <div class="carousel-inner">
                        <?foreach($arLayouts as $key => $arLayout):?>
                            <div class="carousel-item <?if($key == 0) echo 'active';?>" 
                                 data-rooms="<?=$arLayout["PROPERTY_LAYOUT_ROOMS_VALUE"]?>"
                                 data-area="<?=$arLayout["PROPERTY_LAYOUT_AREA_VALUE"]?>"
                                 data-price="<?=$arLayout["PROPERTY_LAYOUT_PRICE_VALUE"]?>">
                                 
                                <?if($arLayout["IMAGE_SRC"]):?>
                                    <img src="<?=$arLayout["IMAGE_SRC"]?>" class="d-block w-100" alt="Планировка <?=$arLayout["NAME"]?>">
                                    <a href="<?=$arLayout["IMAGE_SRC"]?>" class="glightbox layout-fullscreen-btn" data-gallery="layouts-gallery">
                                        <i class="fas fa-expand"></i>
                                    </a>
                                <?endif;?>
                            </div>
                        <?endforeach;?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#layoutsCarousel" data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#layoutsCarousel" data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="layout-slider-footer">
                    <p id="layout-area-text"></p>
                    <strong id="layout-price-text"></strong>
                    <span id="layout-pagination" class="slider-pagination"></span>
                </div>
            </div>
        </div>
    </section>
    <?
        endif;
    endif;
    // --- КОНЕЦ БЛОКА ПЛАНИРОВОК ---
    ?>

<?// --- НАЧАЛО БЛОКА "ХОД СТРОИТЕЛЬСТВА" --- ?>
<section id="progress" class="progress-section">
    <div class="container ">
        <div class="progress-v2-wrapper">
            <div class="progress-v2-header">
                <h2 class="section-title">Ход строительства</h2>
            </div>
            <div class="row g-4">
                <?// --- Карточка Фотогалереи (открывает попап) --- ?>
                <?if(!empty($arResult["PROPERTIES"]["PHOTO_REPORTS"]["VALUE"])):?>
                <div class="col-lg-6">
                    <a href="#" class="progress-item" data-bs-toggle="modal" data-bs-target="#photoReportModal" data-object-id="<?=$arResult["ID"]?>">
                        <img src="/local/templates/sensata/images/photo_placeholder.jpg" alt="Фото-галерея">
                        <div class="progress-caption">Фото-галерея</div>
                        <div class="progress-play-btn"><i class="fas fa-camera"></i></div>
                    </a>
                </div>
            <?endif;?>
            
            <?// --- Карточка Видеогалереи (как раньше, через GLightbox) --- ?>
            <?// ... (здесь можно вставить код для видеогалереи, если нужно) ...?>
                </div>
        </div>
    </div>
</section>
<?// --- КОНЕЦ БЛОКА "ХОД СТРОИТЕЛЬСТВА" --- ?>
    <?// --- НАЧАЛО ОБНОВЛЕННОЙ СЕКЦИИ КОНТАКТОВ --- ?>
    <section id="contacts" class="request-call-section">
        <div class="container">
            <div class="request-call-wrapper">
                <?if($_REQUEST["success"] == "Y"):?>
                    <div class="alert alert-success text-center">
                        <h3>Спасибо за вашу заявку!</h3>
                        <p>Наш менеджер скоро с вами свяжется.</p>
                    </div>
                <?else:?>
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <h2 class="section-title">Заказать звонок</h2>
                        <p class="text-muted">Ответим на интересующие вас вопросы и расскажем подробнее о проекте.</p>
                    </div>
                    <div class="col-lg-6">
                        <form id="contact-form-main" action="<?=POST_FORM_ACTION_URI?>" method="POST">
                            <?=bitrix_sessid_post()?>
                            <input type="hidden" name="page_title" value="<?=$APPLICATION->GetTitle(false)?>">
                            <input type="text" name="form_check" value="" style="display:none;"> <?// Ловушка для ботов ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="user-name" class="form-label">Ваше Имя</label>
                                    <input type="text" id="user-name" name="user_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="user-phone" class="form-label">Номер мобильного телефона</label>
                                    <input type="tel" id="user-phone" name="user_phone" class="form-control" placeholder="+7 (___) ___-__-__" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="user-city" class="form-label">Город</label>
                                    <select id="user-city" name="user_city" class="form-select">
                                        <option>Астана</option>
                                        <option>Алматы</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="submit_call_request" class="btn btn-call-submit" disabled>Жду звонка</button>
                        </form>
                    </div>
                    <div class="col-lg-3 text-center d-none d-lg-block">
                        <img src="<?=$templateFolder?>/images/operator.png" alt="Оператор" class="operator-photo">
                    </div>
                </div>
                <?endif;?>
            </div>
            <div class="legal-footer-text">
                <p>Настоящая реклама, в соответствии со ст. 385 ГК РК, не является публичной офертой. Договоры о долевом участии в жилищном строительстве будут заключаться только после заключения договора о предоставлении гарантии с Единым оператором или выдачи разрешения на привлечение денег дольщиков местными исполнительными органами Компании. В соответствии со ст. 385 ГК РК, не является публичной офертой.</p>
            </div>
        </div>
    </section>
    <?// --- КОНЕЦ ОБНОВЛЕННОЙ СЕКЦИИ КОНТАКТОВ --- ?>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
<?endif;?>