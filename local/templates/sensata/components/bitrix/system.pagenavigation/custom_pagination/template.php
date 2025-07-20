<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
?>

<?if($arResult["NavPageCount"] > 1 || $arParams["SHOW_ALWAYS"] == "Y"):?>

    <div class="pagination-controls">
        
        <?// --- Блок "Показывать по" --- ?>
        <?
        // Берем массив размеров из параметров, которые мы передали
        $arPageSizes = $arParams["PAGE_SIZES"]; 
        ?>
        <?if(!empty($arPageSizes) && is_array($arPageSizes)):?>
        <div class="show-by-control">
            <span>Показывать по:</span>
            <?
            $currentPageSize = $arResult["NavPageSize"];
            ?>
            <?foreach ($arPageSizes as $size):?>
                <?if($size == $currentPageSize):?>
                    <span class="active"><?=$size?></span>
                <?else:?>
                    <a href="<?=$APPLICATION->GetCurPageParam("page_size=".$size, ["page_size", "PAGEN_1"])?>"><?=$size?></a>
                <?endif;?>
            <?endforeach;?>
        </div>
        <?endif;?>

        <?// --- Блок самой пагинации --- ?>
        <nav class="news-pagination">
            <ul class="pagination">
                <?if ($arResult["NavPageNomer"] > 1):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$APPLICATION->GetCurPageParam("PAGEN_".$arResult["NavNum"]."=".($arResult["NavPageNomer"]-1), ["PAGEN_".$arResult["NavNum"]])?>">&lt;</a>
                    </li>
                <?endif;?>

                <?for ($page = $arResult["nStartPage"]; $page <= $arResult["nEndPage"]; $page++):?>
                    <?if ($page == $arResult["NavPageNomer"]):?>
                        <li class="page-item active"><span class="page-link"><?=$page?></span></li>
                    <?else:?>
                        <li class="page-item"><a class="page-link" href="<?=$APPLICATION->GetCurPageParam("PAGEN_".$arResult["NavNum"]."=".$page, ["PAGEN_".$arResult["NavNum"]])?>"><?=$page?></a></li>
                    <?endif?>
                <?endfor?>

                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$APPLICATION->GetCurPageParam("PAGEN_".$arResult["NavNum"]."=".($arResult["NavPageNomer"]+1), ["PAGEN_".$arResult["NavNum"]])?>">&gt;</a>
                    </li>
                <?endif;?>
            </ul>
        </nav>
    </div>
<?endif;?>