<?
// подключаем ланги
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'priwoz.option');

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

global $APPLICATION;
$module_id = "priwoz.option";

$RIGHT = $APPLICATION->GetGroupRight($module_id);
if($RIGHT >= "R"){

    $bVarsFromForm = false; // переменнаЯ флаг: пришли ли данные с формы
    // массив вкладок, свойств
    $aTabs = Array(
        Array(
            "DIV" => "index",
            "TAB" => GetMessage("OPTIONS_TAB_INDEX"),
            "ICON" => "testmodule_settings",
            "TITLE" => GetMessage("TOPTIONS_TAB_INDEX_TITLE"),
            "OPTIONS" => Array(
                "pay_on" => Array(GetMessage("OPTIONS_TAB_PAY"), Array("checkbox", "N")),
                "price_ads" => Array(GetMessage("OPTIONS_PRICE_ADS"), Array("text")),
                "price_company" => Array(GetMessage("OPTIONS_PRICE_COMPANY"), Array("text")),
            ),

        ),
        array(
            "DIV" => "rights",
            "TAB" => GetMessage("MAIN_TAB_RIGHTS"),
            "ICON" => "testmodule_settings",
            "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS"),
            "OPTIONS" => Array()
        )
    );
    $tabControl = new CAdminTabControl("tabControl", $aTabs);

    if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid()){
        if(strlen($RestoreDefaults)>0) // если было выбрано "по умолчанию", то сбрасывает все option'ы
            COption::RemoveOption($module_id);
        else{
            if (!$bVarsFromForm){
                // обработка формы
                foreach($aTabs as $i => $aTab){
                    foreach($aTab["OPTIONS"] as $name => $arOption){
                        $disabled = array_key_exists("disabled", $arOption)? $arOption["disabled"]: "";
                        if($disabled)
                            continue;

                        $val = $_POST[$name];
                        if($arOption[1][0]=="checkbox" && $val!="Y")
                            $val="N";

                        COption::SetOptionString($module_id, $name, $val, $arOption[0]);
                    }
                }
            }
        }

    /*    ob_start();
        $Update = $Update.$Apply;
        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
        ob_end_clean();*/
    }
    $tabControl->Begin();
    ?>
    <form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>" id="options">
        <?
        foreach($aTabs as $caTab => $aTab){
            $tabControl->BeginNextTab();
            if ($aTab["DIV"] != "rights"){ // не особаЯ (обычнаЯ) вкладка
                foreach($aTab["OPTIONS"] as $name => $arOption){
                    if ($bVarsFromForm)
                        $val = $_POST[$name];
                    else
                        $val = COption::GetOptionString($module_id, $name);
                    $type = $arOption[1];
                    $disabled = array_key_exists("disabled", $arOption)? $arOption["disabled"]: "";
                    if(isset($arOption[2]) && strlen($arOption[2])) echo 'style="display:none" class="show-for-'.htmlspecialcharsbx($arOption[2]).'"'?>
                        <td width="40%" <?if($type[0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
                            <label for="<?echo htmlspecialcharsbx($name)?>"><?echo $arOption[0]?>:</label>
                        <td width="30%">
                            <?if($type[0]=="checkbox"){?>
                                <input type="checkbox" name="<?echo htmlspecialcharsbx($name)?>" id="<?echo htmlspecialcharsbx($name)?>" value="Y"<?if($val=="Y")echo" checked";?><?if($disabled)echo' disabled="disabled"';?>><?if($disabled) echo '<br>'.$disabled;?>
                            <?}elseif($type[0]=="text"){?>
                                <?if(stripos($name, 'icon') !== false || stripos($name, 'picture')){?>
                                    <div class="file-div">
                                    <input type="hidden" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($name)?>">
                                    <?
                                    $file = CFile::GetByID(htmlspecialcharsbx($val));
                                    $arFile = $file->Fetch();
                                    if($arFile['SRC']){?>
                                        <div class="file-name">
                                            <a href="<?=$arFile['SRC']?>"><?=$arFile['ORIGINAL_NAME']?></a>
                                            <span class="upload-file-size" data-bx-role="file-size"><?=CFile::FormatSize($arFile['FILE_SIZE'])?></span>
                                        </div>
                                    <?}
                                    $APPLICATION->IncludeComponent("bitrix:main.file.input", "carusel_upload",
                                        array(
                                            "INPUT_NAME"=> htmlspecialcharsbx($name),
                                            "MULTIPLE"=>"N",
                                            "MODULE_ID"=>"iblock",
                                            "MAX_FILE_SIZE"=>"25000000",//25000000 25mb
                                        "ALLOW_UPLOAD"=> "F",
                                            "CONTROL_ID" => htmlspecialcharsbx($name),
                                            "ALLOW_UPLOAD"=> "I",
                                            "INPUT_CAPTION" => ""
                                        ),
                                        false
                                    );?>
                                    </div>
                                <?}else{?>
                                    <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($name)?>">
                                    <?if(stripos($name, 'prefix') !== false){?>
                                        <p class="description_prefix"><a target="_blank" href="/bitrix/admin/sale_discount.php">Перейти на страницу создания скидок</a> (в начале названия скидки должен быть прописан вышеуказаный префикс)</p>
                                    <?}?>
                                    <?if(stripos($name, 'action_start_date') !== false){?>
                                        <?=Calendar("action_start_date", "curform")?>
                                    <?}?>
                                    <?if(stripos($name, 'action_stop_date') !== false){?>
                                        <?=Calendar("action_stop_date", "curform")?>
                                    <?}?>
                                <?}?>
                            <?}elseif($type[0]=="textarea"){?>
                                <textarea rows="<?echo $type[1]?>" name="<?echo htmlspecialcharsbx($name)?>" style=
                                "width:100%"><?echo htmlspecialcharsbx($val)?></textarea>
                            <?}elseif($type[0]=="select"){?>
                                <?if(count($type[1])){?>
                                    <select name="<?echo htmlspecialcharsbx($name)?>" onchange="doShowAndHide()">
                                        <?foreach($type[1] as $key => $value){?>
                                            <option value="<?echo htmlspecialcharsbx($key)?>" <?if ($val == $key) echo 'selected="selected"'?>><?echo htmlspecialcharsEx($value)?></option>
                                        <?}?>
                                    </select>
                                <?}else{?>
                                    <?echo GetMessage("ZERO_ELEMENT_ERROR");?>
                                <?}?>
                            <?}elseif($type[0]=="note"){?>
                                <?echo BeginNote(), $type[1], EndNote();?>
                            <?}?>
                        </td>
                        <td width="30%">
                            <?if ($arOption[3]){?>
                                <p><?echo $arOption[3];?></p>
                            <?}?>
                        </td>
                    </tr>
                <?}
            }elseif($aTab["DIV"] == "rights"){ // суперкостыль длЯ правки прав, потому что в битриксе всЯ форма подключаетсЯ в отдельном файле
                require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
            }
        }?>

        <?$tabControl->Buttons();?>
        <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
        <input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
        <?if(strlen($_REQUEST["back_url_settings"])>0):?>
            <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
            <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
        <?endif?>
        <input type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
        <?=bitrix_sessid_post();?>
        <?$tabControl->End();?>
    </form>
    <script>
        function doShowAndHide(){
            var form = BX('options');
            var selects = BX.findChildren(form, {tag: 'select'}, true);
            for (var i = 0; i < selects.length; i++){
                var selectedValue = selects[i].value;
                var trs = BX.findChildren(form, {tag: 'tr'}, true);
                for (var j = 0; j < trs.length; j++){
                    if (/show-for-/.test(trs[j].className)){
                        if (trs[j].className.indexOf(selectedValue) >= 0)
                            trs[j].style.display = 'table-row';
                        else
                            trs[j].style.display = 'none';
                    }
                }
            }
        }
        BX.ready(doShowAndHide);
    </script>
<?}?>