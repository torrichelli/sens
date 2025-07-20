<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<div class="row g-4">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="col-md-6">
            <div class="card h-100 feature-card">
                <div class="card-body">
                    <h5 class="card-title"><?=$arItem["NAME"]?></h5>
                    <p class="card-text"><?=$arItem["PREVIEW_TEXT"]?></p>
                    <?if($arItem["PROPERTIES"]["FEATURES"]["VALUE"]):?>
                    <ul class="list-unstyled">
                        <?foreach($arItem["PROPERTIES"]["FEATURES"]["VALUE"] as $feature):?>
                        <li><img src="<?=SITE_TEMPLATE_PATH?>/images/check.png" alt="галочка" class="icon-list-item"> <?=$feature?></li>
                        <?endforeach;?>
                    </ul>
                    <?endif;?>
                    <a href="#contact-form-section" class="custom-btn mt-3"><?=$arItem["PROPERTIES"]["BUTTON_TEXT"]["VALUE"] ?: "Узнать подробнее"?></a>
                </div>
            </div>
        </div>
    <?endforeach;?>
</div>