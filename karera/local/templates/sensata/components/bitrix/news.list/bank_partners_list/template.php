<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<div class="bank-logos-grid">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?if($arItem["PROPERTIES"]["LOGO"]["VALUE"]):?>
        <div class="bank-logo-item">
            <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["LOGO"]["VALUE"])?>" alt="<?=$arItem["NAME"]?>">
        </div>
        <?endif;?>
    <?endforeach;?>
</div>