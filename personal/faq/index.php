<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("FAq");
?>
    <section class="personal-section">
        <div class="container">
            <div class="content-row">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "personal-left",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "",
                        "USE_EXT" => "N"
                    )
                ); ?>
                <div class="main-content faq-content">
                    <div class="title-box">
                        <h1 class="page-title">FAq</h1>
                        <a href="<?=SITE_DIR?>personal/announcement/" class="btn btn-orange"><?=GetMessage("DEF_ADD_ADS")?></a>
                    </div>
                    <div class="bg-box">
                        <?
                        $arSelect = array("NAME", "DETAIL_TEXT");
                        $arFilter = array("IBLOCK_ID"=>27, "ACTIVE" => "Y");
                        $res = CIBlockElement::GetList(Array("sort" => "asc"), $arFilter, false, Array(), $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();?>
                          <h2 class="faq-question"><?=$arFields['NAME']?></h2>
                            <p><?=$arFields['DETAIL_TEXT']?></p>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>