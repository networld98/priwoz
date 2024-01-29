<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->createFrame()->begin("Загрузка навигации");
?>
<? if ($arResult["NavPageCount"] > 1):
    $plus = $arResult["NavPageNomer"] + 1;
    $url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;
    if($APPLICATION->GetCurPage() != SITE_DIR):?>
        <? if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]): ?>
            <div class="load-more-box load_page" data-url="<?= $url ?>">
                <span class="blue-link"><?=GetMessage("PAG_LOAD_ADS")?></span>
            </div>
        <? endif ?>
    <?else:?>
        <?if($plus>3){?>
            <div class="load-more-box load_page">
                <a href="<?=SITE_DIR?>ads/" class="blue-link"><?=GetMessage("PAG_SHOW_MORE")?></a>
            </div>
        <?}else{?>
            <div class="load-more-box load_page" data-url="<?= $url ?>">
                <span class="blue-link"><?=GetMessage("PAG_LOAD_ADS")?></span>
            </div>
        <?}?>
    <? endif ?>
<? endif ?>
<script>
    $('body').on('click', 'div.load_page', function () {
        var targetContainer = $('.products-masonry'),          //  Контейнер, в котором хранятся элементы
            url = $('.load-more-box').attr('data-url');    //  URL, из которого будем брать элементы
        console.log(url);
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {
                    //  Удаляем старую навигацию
                    $('.load_page').remove();
                    var elements = $(data).find('.product-grid-item'),  //  Ищем элементы
                        pagination = $(data).find('.load_page');//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.parent('div').append(pagination); //  добавляем навигацию следом
                }
            })
        }
    });
    $(document).ajaxComplete(function () {
        let grid = $('.grid').masonry({}).css('opacity', '1');
        grid.masonry('reloadItems');
        favoriteInit();
    })
</script>
