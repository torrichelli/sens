<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="main-nav" id="mainNav">
    <ul class="nav-list">
    <?
    foreach($arResult as $arItem):
        if($arItem["PERMISSION"] > "A"):
            
            // Определяем, нужно ли добавить класс 'active'
            $activeClass = $arItem["SELECTED"] ? ' active' : '';
    ?>
        <li class="nav-item<?=$activeClass?>">
            <a href="<?=$arItem["LINK"]?>" class="nav-link">
                <?// Проверяем, есть ли у пункта меню текст в теге <span> (для верстки) ?>
                <?if (strpos($arItem["TEXT"], '<span>') !== false):?>
                    <?=$arItem["TEXT"]?>
                <?else:?>
                    <span><?=$arItem["TEXT"]?></span>
                <?endif;?>
            </a>
        </li>
    <?
        endif;
    endforeach;
    ?>
        <?// Эти пункты были в верстке только для мобильной версии. 
          // Их можно добавить сюда статически, если они не нужны в админке,
          // либо создать для них отдельное меню и подключить еще одним компонентом.
        ?>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link">О компании</a></li>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link">Новости</a></li>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link">Карьера</a></li>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link">Избранное</a></li>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link">Войти</a></li>
        <li class="nav-item nav-item-mobile-only"><a href="#" class="nav-link call-order-mobile">Заказать звонок</a></li>
        <li class="nav-item nav-item-mobile-only language-selector-mobile">
            <a href="#" class="nav-link">RU / EN</a>
        </li>
    </ul>
</nav>
<?endif?>