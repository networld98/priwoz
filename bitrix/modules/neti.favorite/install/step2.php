<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

if (!check_bitrix_sessid()) return;

global $APPLICATION;

if ($ex = $APPLICATION->GetException()) {
    CAdminMessage::ShowMessage([
        "TYPE" => "ERROR",
        "MESSAGE" => Loc::getMessage("MOD_INST_ERR"),
        "DETAILS" => $ex->GetString(),
        "HTML" => 'HTML'
    ]);
} else {
    CAdminMessage::ShowNote(Loc::getMessage("MOD_INST_OK"));
}
?>

<table class="adm-info-message filter-form" cellpadding="3" cellspacing="0" border="0" width="0%">
    <tbody>
        <tr>
            <td>
                <p><?=Loc::getMessage("NETI_FAVORITE_THANK") ?></p>
                <p><?=Loc::getMessage("NETI_FAVORITE_WAY_DESC") ?> <?=Loc::getMessage("NETI_FAVORITE_WAY") ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><?=Loc::getMessage("NETI_FAVORITE_OPPORTUNITIES_TITLE") ?></p>
                <ul>
                    <li><?=Loc::getMessage('NETI_FAVORITE_OPPORTUNITIES_1') ?></li>
                    <li><?=Loc::getMessage('NETI_FAVORITE_OPPORTUNITIES_2') ?></li>
                    <li><?=Loc::getMessage('NETI_FAVORITE_OPPORTUNITIES_3') ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <p><?=Loc::getMessage("NETI_FAVORITE_INSTRUCTION") ?> <a href="https://netiweb.ru/nashi-raboty/modul-izbrannogo/" target="_blank"><?=Loc::getMessage('NETI_FAVORITE_INSTRUCTION_LINK') ?></a></p>
                <p><?=Loc::getMessage("NETI_FAVORITE_SUPPORT_TEXT") ?> <a href="mailto:support_module@i-neti.ru">support_module@i-neti.ru</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><?=Loc::getMessage("NETI_FAVORITE_GOODBYE") ?> <a href="https://netiweb.ru/" target="_blank">https://netiweb.ru/</a></p>
            </td>
        </tr>
    </tbody>
</table>

<form action="<?= $APPLICATION->GetCurPage(); ?>" name="blank-install">
    <?=bitrix_sessid_post()?>
    <input type="submit" name="" value="<?=Loc::getMessage("MODULE_FAVORITE_IN_MENU") ?>">
</form>