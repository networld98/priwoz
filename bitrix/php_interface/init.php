<?
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
Loader::includeModule("iblock");

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("CustomFields", "OnBeforeIBlockElementAddHandler"));
class CustomFields
{
// создаем обработчик события "OnBeforeIBlockElementAdd" 
    static function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        //не добавлять дату если создаем в админке
        if ($GLOBALS['APPLICATION']->GetCurPage()!='/bitrix/admin/iblock_element_edit.php') {
            $transName = CUtil::translit(trim($arFields["NAME"]), "ru", $arTransParams);//функция генерации сим. кода из имени
            $arFields["CODE"] = $transName . "_" . date('dmYHis');
            $arFields["ACTIVE"] = "Y";
            return;
        }
    }
}
    /*КОСТЫЛЬ ТРНАСЛИТА */
class CUtilEx extends \CUtil{

    private static function mb_strtr($str, $from, $to)
    {
        return str_replace(\CUtilEx::mb_str_split($from), \CUtilEx::mb_str_split($to), $str);
    }
    private static function mb_str_split($str) {
        return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);
    }

    private static function ToUpper($str, $lang = false)
    {
        static $lower = array();
        static $upper = array();
        if(!defined("BX_CUSTOM_TO_UPPER_FUNC"))
        {
            if(defined("BX_UTF"))
            {
                return mb_strtoupper($str);
            }
            else
            {
                if($lang === false)
                    $lang = LANGUAGE_ID;
                if(!isset($lower[$lang]))
                {
                    $arMsg = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/tools.php", $lang, true);
                    $lower[$lang] = $arMsg["ABC_LOWER"];
                    $upper[$lang] = $arMsg["ABC_UPPER"];
                }
                return mb_strtoupper(\CUtilEx::mb_strtr($str, $lower[$lang], $upper[$lang]));
            }
        }
        else
        {
            $func = BX_CUSTOM_TO_UPPER_FUNC;
            return $func($str);
        }
    }

    private static function ToLower($str, $lang = false)
    {
        static $lower = array();
        static $upper = array();
        if(!defined("BX_CUSTOM_TO_LOWER_FUNC"))
        {
            if(defined("BX_UTF"))
            {
                return mb_strtolower($str);
            }
            else
            {
                if($lang === false)
                    $lang = LANGUAGE_ID;
                if(!isset($lower[$lang]))
                {
                    $arMsg = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/tools.php", $lang, true);
                    $lower[$lang] = $arMsg["ABC_LOWER"];
                    $upper[$lang] = $arMsg["ABC_UPPER"];
                }
                return mb_strtolower(\CUtilEx::mb_strtr($str, $upper[$lang], $lower[$lang]));
            }
        }
        else
        {
            $func = BX_CUSTOM_TO_LOWER_FUNC;
            return $func($str);
        }
    }



    public static function translit($str, $lang, $params = array())
    {
        static $search = array();

        if(!isset($search[$lang]))
        {
            $mess = IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/js_core_translit.php", $lang, true);
            $trans_from = explode(",", $mess["TRANS_FROM"]);
            $trans_to = explode(",", $mess["TRANS_TO"]);
            foreach($trans_from as $i => $from)
                $search[$lang][$from] = $trans_to[$i];
        }

        $defaultParams = array(
            "max_len" => 100,
            "change_case" => "L", // 'L' - toLower, 'U' - toUpper, false - do not change
            "replace_space" => '_',
            "replace_other" => '_',
            "delete_repeat_replace" => true,
            "safe_chars" => '',
        );
        foreach($defaultParams as $key => $value)
            if(!array_key_exists($key, $params))
                $params[$key] = $value;

        $len = mb_strlen($str);
        $str_new = '';
        $last_chr_new = '';

        for($i = 0; $i < $len; $i++)
        {
            $chr = mb_substr($str, $i, 1, "UTF-8");

            if(preg_match("/[a-zA-Z0-9]/".BX_UTF_PCRE_MODIFIER, $chr) || mb_strpos($params["safe_chars"], $chr)!==false)
            {
                $chr_new = $chr;
            }
            elseif(preg_match("/\\s/".BX_UTF_PCRE_MODIFIER, $chr))
            {
                if (
                    !$params["delete_repeat_replace"]
                    ||
                    ($i > 0 && $last_chr_new != $params["replace_space"])
                )
                    $chr_new = $params["replace_space"];
                else
                    $chr_new = '';
            }
            else
            {
                if($search[$lang][$chr])
                {
                    $chr_new = $search[$lang][$chr];
                }
                else
                {
                    if (
                        !$params["delete_repeat_replace"]
                        ||
                        ($i > 0 && $i != $len-1 && $last_chr_new != $params["replace_other"])
                    )
                        $chr_new = $params["replace_other"];
                    else
                        $chr_new = '';
                }
            }

            if(mb_strlen($chr_new))
            {
                if($params["change_case"] == "L" || $params["change_case"] == "l")
                    $chr_new = \CUtilEx::ToLower($chr_new);
                elseif($params["change_case"] == "U" || $params["change_case"] == "u")
                    $chr_new = \CUtilEx::ToUpper($chr_new);

                $str_new .= $chr_new;
                $last_chr_new = $chr_new;
            }

            if (mb_strlen($str_new) >= $params["max_len"])
                break;
        }
        $str_new = trim($str_new, $params['replace_space'] . $params['replace_other']);

        return $str_new;
    }


}
/*КОНЕЦ КОСТЫЛЯ */

AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
        $arFields["LOGIN"] = $arFields["EMAIL"];
        return $arFields;
}



AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("MyClass", "OnAfterIBlockElementAddHandler"));
class MyClass
{
    // создаем обработчик события "OnAfterIBlockElementAdd"
    public static function OnAfterIBlockElementAddHandler(&$arFields)
    {
        if($arFields["IBLOCK_ID"] == 19) {
            $newDate = date('d.m.Y', strtotime('+1 month'));
            $el = new CIBlockElement;
            $el->Update(
                $arFields["ID"],
                ['DATE_ACTIVE_TO' => $newDate, 'ACTIVE' => 'Y'],
                true
            );
        }
    }
}
//Ищет период между датами
function differenceInDays($date1, $date2) {
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return abs($interval->format('%R%a'));
}
//функция на кроне которая будет проверять обьявы и отправлять уведомлени о окончании подписки
function endOfSubscription()
{
    $payActive = Option::get("priwoz.option", "pay_on");
    if($payActive == 'Y') {
        ini_set("memory_limit", "512M");
        $dateNow = date_create('d.m.Y H:i:s');
        $arSelect = array("IBLOCK_ID", "NAME", "DATE_ACTIVE_TO", "PROPERTY_AUTHOR");
        $arFilter = array("IBLOCK_ID" => array(19, 24), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $period = differenceInDays($arFields['DATE_ACTIVE_TO'], $dateNow);
            if ($arFields['DATE_ACTIVE_TO'] >= $dateNow && $period <= 3 && $period != 0) {
                if ($arFields['IBLOCK_ID'] == '19') {
                    $url = "ads-list/";
                    $urlName = "объявление";
                }
                if ($arFields['IBLOCK_ID'] == '24') {
                    $url = "company-list/";
                    $urlName = "компанию";
                }
                $rsUser = CUser::GetByID($arFields['PROPERTY_AUTHOR_VALUE']);
                $arUser = $rsUser->Fetch();
                $arField = array(
                    "NAME" => $arUser['NAME'],
                    "LAST_NAME" => $arUser['LAST_NAME'],
                    "ADS" => $arFields['NAME'],
                    "DATE" => $arFields['DATE_ACTIVE_TO'],
                    "EMAIL" => $arUser['EMAIL'],
                    "URL" => $url,
                    "PERIOD" => $period,
                    "URL_NAME" => $urlName,
                );
                CEvent::Send('END_OF_SUBSCRIPTION', 's1', $arField);
            }
        }
    }
    return "endOfSubscription();";
}