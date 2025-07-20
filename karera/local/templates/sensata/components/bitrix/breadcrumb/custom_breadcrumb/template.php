<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult)) {
    return "";
}

$strReturn = '';
$strReturn .= '<nav class="custom-breadcrumb-simple" aria-label="breadcrumb"><ol class="breadcrumb">';

$itemSize = count($arResult);

for($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $isLastItem = ($index == $itemSize - 1);

    // --- ФИНАЛЬНАЯ ПРОВЕРКА ---
    // Если это последний элемент И мы получили наш сигнал из news.php,
    // то мы не выводим эту крошку.
    if ($isLastItem && isset($arParams["IS_NEWS_LIST"]) && $arParams["IS_NEWS_LIST"] == "Y") {
        continue;
    }
    // --- КОНЕЦ ПРОВЕРКИ ---

    if($arResult[$index]["LINK"] <> "" && !$isLastItem) {
        $strReturn .= '<li class="breadcrumb-item"><a href="'.$arResult[$index]["LINK"].'">'.$title.'</a></li>';
    } else {
        $strReturn .= '<li class="breadcrumb-item active" aria-current="page">'.$title.'</li>';
    }
}

$strReturn .= '</ol></nav>';

return $strReturn;
?>