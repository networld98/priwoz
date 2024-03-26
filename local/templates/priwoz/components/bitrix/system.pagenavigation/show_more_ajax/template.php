<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
?>
<?if($arResult["bDescPageNumbering"] === true):?>
    <?if ($arResult["NavPageNomer"] > 1):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" id="infinity-next-page">еще</a>
    <?endif?>
<?else:?>
    <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" id="infinity-next-page">еще</a>
    <?endif?>
<?endif?>
<script>
    $(document).on('ready', function(){
        var loading = false;
        $(window).scroll(function() {
            if ($('#infinity-next-page').length && !loading) {
                if ($(window).scrollTop() + 100 >= $(document).height() - $(window).height()) {
                    loading = true;
                    $.get($('#infinity-next-page').attr('href'), { is_ajax: 'y' }, function(data) {
                        $('#infinity-next-page').after(data);
                        $('#infinity-next-page').remove();
                        loading = false;
                    });
                }
            }
        });
    });
</script>
