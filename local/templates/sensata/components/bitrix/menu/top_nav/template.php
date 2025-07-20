<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="top-nav">
    <ul class="nav-list">
    <?
    // Пробегаемся по всем пунктам меню, которые пришли из файла .top.menu.php
    foreach($arResult as $arItem):
        // $arItem["SELECTED"] - true, если мы находимся на странице этого пункта меню
        // $arItem["PERMISSION"] > "A" - проверка прав доступа, всегда оставляем
        if($arItem["PERMISSION"] > "A"):
    ?>
        <li><a href="<?=$arItem["LINK"]?>" class="nav-link"><?=$arItem["TEXT"]?></a></li>
    <?
        endif;
    endforeach;
    ?>
    </ul>
</nav>
<?endif?>