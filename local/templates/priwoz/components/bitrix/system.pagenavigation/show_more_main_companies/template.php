<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->createFrame()->begin("Загрузка навигации");
?>
<? if ($arResult["NavPageCount"] > 1):
    $plus = $arResult["NavPageNomer"] + 1;
    $url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;
    if($plus>$arResult["nEndPage"]){?>
        <div class="load-more-box load_page">
            <a href="<?=SITE_DIR?>companies/" class="blue-link"><?=GetMessage("PAG_LOAD_ADS")?></a>
        </div>
    <?}else{?>
        <div class="load-more-box load_page" data-url="<?= $url ?>">
            <span class="blue-link"><?=GetMessage("PAG_SHOW_MORE")?></span>
        </div>
    <?}?>
<? endif ?>
<script>
    $('body').on('click', 'div.load_page', function () {
        $(this).css('pointer-events','none');
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
                    $('.load_all').remove();
                    var elements = $(data).find('.ads-item'),  //  Ищем элементы
                        pagination = '<div class="load-more-box load_page"> <a href="<?=SITE_DIR?>companies/" class="blue-link"><?=GetMessage("PAG_LOAD_ADS")?></a></div>';
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.parent('div').append(pagination); //  добавляем навигацию следом
                }
            })
        }
        let grid = $('.grid').masonry({}).css('opacity', '1');
        grid.masonry('reloadItems');
    });
    $(document).ajaxComplete(function () {
        let grid = $('.grid').masonry({}).css('opacity', '1');
        grid.masonry('reloadItems');
        favoriteInit();
    })
</script>
