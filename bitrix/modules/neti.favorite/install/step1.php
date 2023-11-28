<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

if (!check_bitrix_sessid()) return;

global $APPLICATION;
?>

<table class="adm-info-message filter-form" cellpadding="3" cellspacing="0" border="0" width="0%">
    <tbody>
        <tr>
            <td>
                <p><?=Loc::getMessage('NETI_FAVORITE_STEP_1') ?></p>
                <p><?=Loc::getMessage('NETI_FAVORITE_STEP_2') ?></p>
                <p><?=Loc::getMessage('NETI_FAVORITE_SUPPORT') ?> <a href="mailto:support_module@i-neti.ru">support_module@i-neti.ru</a></p>
            </td>
        </tr>
        <?php if (!ModuleManager::isModuleInstalled('sender')): ?>
            <tr>
                <td>
                    <p class="required"><?=Loc::getMessage('NETI_FAVORITE_WARNING') ?></p>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<form action="<?= $APPLICATION->GetCurPage(); ?>" name="blank-install">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID?>">
    <input type="hidden"  name="id" value="neti.favorite">
    <input type="hidden" name="step" value="2">
    <input type="hidden" name="install" value="Y">


    <input type="submit" name="inst" value="<?=Loc::getMessage("NETI_FAVORITE_INSTALL") ?>">
</form>
