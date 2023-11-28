<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialchars($request['mid'] != '' ? $request['mid'] : $request['id']);

Loader::includeModule($module_id);

$mailing = null;
if (ModuleManager::isModuleInstalled('sender')) {
    $mailing = [
        "mailing",
        Loc::getMessage('NETI_FAVORITE_CHECKBOX_MAILING'),
        "N",
        [
            "checkbox",
            "",
        ]
    ];
}

$aTabs = array(
    array(
        'DIV' => 'neti.favorite',
        'TAB' => Loc::getMessage('NETI_FAVORITE_OPTIONS_TAB_GENERAL'),
        'TITLE' => Loc::getMessage('NETI_FAVORITE_OPTIONS_TAB_GENERAL'),
        'OPTIONS' => array(
            array(
                "addClass",
                Loc::getMessage('NETI_FAVORITE_SETTINGS_ADD_CLASS'),
                "fa fa-heart",
                array('text', 45)
            ),
            array(
                "removeClass",
                Loc::getMessage('NETI_FAVORITE_SETTINGS_REMOVE_CLASS'),
                "fa fa-heart-o",
                array('text', 45)
            ),
            $mailing,
            array(
                "log",
                Loc::getMessage('NETI_FAVORITE_CHECKBOX_LOG'),
                "Y",
                array(
                    "checkbox",
                    "",
                ),
            ),
            array(
                "snippet_1",
                Loc::getMessage('NETI_FAVORITE_SNIPPET_1'),
                '<?$APPLICATION->IncludeComponent("neti:favorite.icon", "favorites", Array(
                    "COMPONENT_TEMPLATE" => ".default",
                        "LINK" => "/novyy-razdel/",	// —сылка на страницу с избранным
                    ),
                    false
                );?>',
                array(
                    "textarea",
                    4,
                    50
                ),
            ),
            array(
                'note' => '<a href="https://php.i-neti.ru/nashi-raboty/dokumentatsiya-dobavit-v-izbrannoe/">' .
                    Loc::getMessage('NETI_FAVORITE_DOCUMENTATION') . '</a>'
            )
        )
    )
); ?>
<?php
$tabControl = new CAdminTabControl(
    'tabControl',
    $aTabs
);

$tabControl->begin();
?>
<form action="<?= $APPLICATION->getCurPage(); ?>?mid=<?= $module_id; ?>&lang=<?= LANGUAGE_ID; ?>" method="post">
    <?= bitrix_sessid_post(); ?>
    <?php
    foreach ($aTabs as $aTab) {
        if ($aTab['OPTIONS']) {
            $tabControl->beginNextTab();
            __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
        }
    }
    $tabControl->buttons();
    ?>
    <input type="submit" name="apply"
           value="<?= Loc::GetMessage('NETI_FAVORITE_OPTIONS_INPUT_APPLY'); ?>" class="adm-btn-save"/>
    <input type="submit" name="default"
           value="<?= Loc::GetMessage('NETI_FAVORITE_OPTIONS_INPUT_DEFAULT'); ?>"/>
</form>

<?php
$tabControl->end();

if ($request->isPost() && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) {
        foreach ($aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption)) {
                continue;
            }
            if ($arOption['note']) {
                continue;
            }
            if ($request['apply']) {
                $optionValue = $request->getPost($arOption[0]);
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(',', $optionValue) : $optionValue);
            } elseif ($request['default']) {
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->getCurPage() . '?mid=' . $module_id . '&lang=' . LANGUAGE_ID);

}
?>

<?php if (!ModuleManager::isModuleInstalled('sender')) {
    echo '<div class="adm-info-message-wrap">
            <div class="adm-info-message">' . Loc::getMessage("NETI_FAVORITE_MODULE_NOT_INSTALL_EMAIL") . '</div>
          </div>';
}
?>

<style>
    .adm-detail-valign-top {
        vertical-align: middle;
    }
</style>

<script>
    window.onload = () {
        console.log(123)
    }
</script>
