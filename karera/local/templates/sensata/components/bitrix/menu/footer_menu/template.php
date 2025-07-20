<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul>
    <?
    // Перебираем все пункты меню, которые пришли из соответствующего файла
    // (.footer_projects.menu.php, .footer_buyers.menu.php и т.д.)
    foreach($arResult as $arItem):
        if($arItem["PERMISSION"] > "A"): // Проверка прав доступа, всегда оставляем
    ?>
        <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?
        endif;
    endforeach;
    ?>
</ul>
<?endif?>