<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
//Костыль чтоб вклинить PREVIEW_TEXT в средину блока
unset ($arResult["PROPERTY_LIST"][1]);
$first = array_slice($arResult["PROPERTY_LIST"], 0, 4);
$last = array_slice($arResult["PROPERTY_LIST"], 4);
$arResult["PROPERTY_LIST"] = $first;
$arResult["PROPERTY_LIST"][] = 'PREVIEW_TEXT';
$arResult["PROPERTY_LIST"] = array_merge($arResult["PROPERTY_LIST"], $last);
$annoBlock = array_slice($arResult["PROPERTY_LIST"], 0, -6);
$contactBlock = array_slice($arResult["PROPERTY_LIST"], 8);
//костыль закончился
if ($_GET['edit'] != 'Y') {
    $title = GetMessage("IBLOCK_FORM_SUBMIT");
} else {
    $title = GetMessage("IBLOCK_FORM_CHANGE");
}
?>
<div class="title-box row align-items-xl-baseline">
    <div class="col-xs-12 col-xl-4 col-xxl-3">
        <h1 class="section-title"><?= $title ?></h1>
    </div>
    <? if ($_GET['edit'] != 'Y') { ?>
        <div class="col-xs-12 col-xl-8 col-xxl-9">
            <p class="text-1"><?=GetMessage("IBLOCK_DATA_CABINET")?></p>
        </div>
    <? } ?>
</div>
<div class="product-form">
    <?
    if (!empty($arResult["ERRORS"])):?>
        <? ShowError(implode("<br />", $arResult["ERRORS"])) ?>
    <?endif;
    if ($arResult["MESSAGE"] <> ''):?>
        <? ShowNote($arResult["MESSAGE"]) ?>
    <? endif ?>
    <form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
        <?= bitrix_sessid_post() ?>
        <? if ($arParams["MAX_FILE_SIZE"] > 0): ?><input type="hidden" name="MAX_FILE_SIZE"
                                                         value="<?= $arParams["MAX_FILE_SIZE"] ?>" /><? endif ?>

        <? if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])): ?>
            <? foreach ($annoBlock as $propertyID): ?>
                <div class="row form-group" <?= $INPUT_TYPE ?>>
                    <div class="col-xs-12 col-xl-4">
                        <h2>
                            <?=GetMessage("IBLOCK_CABINET_".$propertyID)?>
                        </h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <label class="form-label <?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] ?>-block">
                            <? if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] == 'SUBCATEGORY' && empty($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"])) { ?>
                                <input type="text" class="form-control" readonly
                                       placeholder="<?=GetMessage("IBLOCK_CABINET_SELECT_CATEGORY")?>">
                            <? } ?>
                            <? if ($arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"]) {
                                if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "E" && $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] == "SUBCATEGORY") {
                                    $arAllElements = [];
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "L";

                                    $arSelect1 = array("ID", "NAME");
                                    $arFilter1 = array("IBLOCK_ID" => IntVal($yvalue), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                                    $dbAllElements = CIBlockElement::GetList(array(), $arFilter1, false, false, $arSelect1);

                                    $dbAllElements = GetIBlockElementList($arResult["PROPERTY_LIST_FULL"][$propertyID]["LINK_IBLOCK_ID"]);


                                    while ($arElement = $dbAllElements->Fetch()) {
                                        $arAllElements[$arElement['ID']] = array('VALUE' => $arElement['NAME']);
                                    }

                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]['ENUM'] = $arAllElements;

                                    if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
                                        $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];

                                }
                            } ?>
                            <?
                            if (intval($propertyID) > 0) {
                                // обновление подкатегорий с категорий
                                if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "E" && ($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] == "CITY" || $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] == "CONDITION")) {
                                    $arAllElements = [];
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "L";

                                    $arSelect1 = array("ID", "NAME");
                                    $arFilter1 = array("IBLOCK_ID" => IntVal($yvalue), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                                    $dbAllElements = CIBlockElement::GetList(array(), $arFilter1, false, false, $arSelect1);

                                    $dbAllElements = GetIBlockElementList($arResult["PROPERTY_LIST_FULL"][$propertyID]["LINK_IBLOCK_ID"]);


                                    while ($arElement = $dbAllElements->Fetch()) {
                                        $arAllElements[$arElement['ID']] = array('VALUE' => $arElement['NAME']);
                                    }

                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]['ENUM'] = $arAllElements;

                                    if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
                                        $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];

                                }

                                if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "G") {
                                    $arAllElements = [];
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "L";

                                    $arSelect1 = array("ID", "NAME");
                                    $arFilter1 = array("IBLOCK_ID" => IntVal($yvalue), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
                                    $dbAllElements = CIBlockSection::GetList(array(), $arFilter1, false, false, $arSelect1);

                                    $dbAllElements = GetIBlockSectionList($arResult["PROPERTY_LIST_FULL"][$propertyID]["LINK_IBLOCK_ID"]);


                                    while ($arElement = $dbAllElements->Fetch()) {
                                        $arAllElements[$arElement['ID']] = array('VALUE' => $arElement['NAME']);
                                    }

                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]['ENUM'] = $arAllElements;

                                    if (!in_array($propertyID, $arResult['PROPERTY_LIST_FULL']))
                                        $arResult[$arResult['PROPERTY_LIST_FULL']][] = $arResult["PROPERTY_LIST_FULL"][$propertyID];

                                }
                                if (
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                    &&
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                                )
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                                elseif (
                                    (
                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                        ||
                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                    )
                                    &&
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                                )
                                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                            } elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y") {
                                $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                                $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                            } else {
                                $inputNum = 1;
                            }

                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                                $INPUT_TYPE = "USER_TYPE";
                            else
                                $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

                            switch ($INPUT_TYPE):
                                case "USER_TYPE":
                                    for ($i = 0; $i < $inputNum; $i++) {
                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
                                            $description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
                                        } elseif ($i == 0) {
                                            $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                            $description = "";
                                        } else {
                                            $value = "";
                                            $description = "";
                                        }
                                        echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                                            array(
                                                $arResult["PROPERTY_LIST_FULL"][$propertyID],
                                                array(
                                                    "VALUE" => $value,
                                                    "DESCRIPTION" => $description,
                                                ),
                                                array(
                                                    "VALUE" => "PROPERTY[" . $propertyID . "][" . $i . "][VALUE]",
                                                    "DESCRIPTION" => "PROPERTY[" . $propertyID . "][" . $i . "][DESCRIPTION]",
                                                    "FORM_NAME" => "iblock_add",
                                                ),
                                            ));
                                        ?><?
                                    }
                                    break;
                                case "TAGS":
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:search.tags.input",
                                        "",
                                        array(
                                            "VALUE" => $arResult["ELEMENT"][$propertyID],
                                            "NAME" => "PROPERTY[" . $propertyID . "][0]",
                                            "TEXT" => 'size="' . $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] . '"',
                                        ), null, array("HIDE_ICONS" => "Y")
                                    );
                                    break;
                                case "HTML":
                                    $LHE = new CHTMLEditor;
                                    $LHE->Show(array(
                                        'name' => "PROPERTY[" . $propertyID . "][0]",
                                        'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[" . $propertyID . "][0]"),
                                        'inputName' => "PROPERTY[" . $propertyID . "][0]",
                                        'content' => $arResult["ELEMENT"][$propertyID],
                                        'width' => '100%',
                                        'minBodyWidth' => 350,
                                        'normalBodyWidth' => 555,
                                        'height' => '200',
                                        'bAllowPhp' => false,
                                        'limitPhpAccess' => false,
                                        'autoResize' => true,
                                        'autoResizeOffset' => 40,
                                        'useFileDialogs' => false,
                                        'saveOnBlur' => true,
                                        'showTaskbars' => false,
                                        'showNodeNavi' => false,
                                        'askBeforeUnloadPage' => true,
                                        'bbCode' => false,
                                        'siteId' => SITE_ID,
                                        'controlsMap' => array(
                                            array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                                            array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                                            array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                                            array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                                            array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                                            array('id' => 'Color', 'compact' => true, 'sort' => 130),
                                            array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                                            array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                                            array('separator' => true, 'compact' => false, 'sort' => 145),
                                            array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                                            array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                                            array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                                            array('separator' => true, 'compact' => false, 'sort' => 200),
                                            array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                                            array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                                            array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                                            array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                                            array('separator' => true, 'compact' => false, 'sort' => 290),
                                            array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                                            array('id' => 'More', 'compact' => true, 'sort' => 400)
                                        ),
                                    ));
                                    break;
                                case "S":
                                case "N":
                                    for ($i = 0; $i < $inputNum; $i++) {
                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                        } elseif ($i == 0) {
                                            $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                                        } else {
                                            $value = "";
                                        }
                                        ?>
                                        <input type="text" class="form-control"
                                               name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"
                                               size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>"
                                               <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] == 'PRICE'){?>
                                                   placeholder="BGN"
                                               <?}?>
                                               value="<?= $value ?>"/><?
                                        if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => 'iblock_add',
                                                    'INPUT_NAME' => "PROPERTY[" . $propertyID . "][" . $i . "]",
                                                    'INPUT_VALUE' => $value,
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                            ?>
                                            <small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small><?
                                        endif
                                        ?><?
                                    }
                                    break;

                                case "F":
                                    ?>
                                    <div class="hint"><?=GetMessage("IBLOCK_FIRST_PHOTO")?></div>
                                    <div class="upload-group">
                                        <? for ($i = 0; $i < $inputNum; $i++) {
                                            if($i<5){
                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                            $imgFile = SITE_TEMPLATE_PATH . '/images/icons/upload-file.svg';
                                            ?>
                                            <div class="upload-item-box">
                                                <div class="upload-file-custom">
                                                    <? if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value])) { ?>
                                                        <input class="delete-img" type="checkbox"
                                                               name="DELETE_FILE[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]"
                                                               id="file_delete_<?= $propertyID ?>_<?= $i ?>" value="Y"/>
                                                        <label class="delete"
                                                                for="file_delete_<?= $propertyID ?>_<?= $i ?>">
                                                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5544 1.83146C17.8693 1.07653 16.7409 0.333984 15.0009 0.333984C13.3292 0.333984 12.24 0.777212 11.5562 1.25869C11.217 1.49751 10.9852 1.74041 10.8349 1.93086C10.7694 2.01397 10.7194 2.08697 10.6828 2.14518L6.0685 1.50539C5.79497 1.46746 5.54249 1.65846 5.50457 1.93198C5.46664 2.20551 5.65763 2.45799 5.93116 2.49591L23.9897 4.99982C24.2633 5.03774 24.5158 4.84675 24.5537 4.57323C24.5916 4.2997 24.4006 4.04722 24.1271 4.00929L19.4809 3.36508C19.4795 3.3602 19.4781 3.35532 19.4765 3.35045L19.4457 3.36019L19.4451 3.36012C19.4764 3.35014 19.4764 3.35003 19.4763 3.34992L19.4762 3.34933L19.4757 3.34795L19.4746 3.34446L19.4713 3.33459C19.4687 3.32675 19.4652 3.31639 19.4607 3.30369C19.4516 3.2783 19.4387 3.24348 19.4216 3.20059C19.3873 3.11489 19.3357 2.9964 19.2637 2.85605C19.1202 2.57618 18.8927 2.20421 18.5544 1.83146ZM18.3157 3.20352C18.2022 2.99972 18.0388 2.75133 17.8139 2.5035C17.2888 1.92494 16.4178 1.33398 15.0009 1.33398C13.5158 1.33398 12.6319 1.72429 12.1319 2.07635C12.0198 2.15527 11.9254 2.23339 11.8466 2.30655L18.3157 3.20352ZM2.31846 8.00065C3.2754 8.00065 3.94281 8.00171 4.44638 8.06942C4.93556 8.13518 5.19461 8.25548 5.37912 8.43999C5.56362 8.6245 5.68392 8.88355 5.74969 9.37273C5.81739 9.8763 5.81846 10.5437 5.81846 11.5006V25.1673V25.2039C5.81844 26.1156 5.81843 26.8505 5.89614 27.4285C5.97681 28.0286 6.14941 28.5338 6.55069 28.9351C6.95197 29.3364 7.45722 29.509 8.05729 29.5896C8.63525 29.6673 9.3701 29.6673 10.2818 29.6673H10.2818H10.2818H10.2819H10.3185H19.6812H19.7178H19.7178H19.7178H19.7179C20.6296 29.6673 21.3644 29.6673 21.9424 29.5896C22.5424 29.509 23.0477 29.3364 23.449 28.9351C23.8502 28.5338 24.0228 28.0286 24.1035 27.4285C24.1812 26.8505 24.1812 26.1157 24.1812 25.204V25.204V25.2039V25.2039V25.1673V11.5007C24.1812 10.5437 24.1823 9.8763 24.25 9.37273C24.3157 8.88355 24.436 8.6245 24.6205 8.43999C24.805 8.25548 25.0641 8.13518 25.5533 8.06942C26.0568 8.00171 26.7243 8.00065 27.6812 8.00065H29.2057V7.00065H27.6812H27.6446H27.5725H2.42716H2.35504H2.31846H0.793945V8.00065H2.31846ZM6.31094 8.00065H23.6887C23.4434 8.35157 23.3225 8.76601 23.2589 9.23948C23.1812 9.81744 23.1812 10.5523 23.1812 11.464V11.464V11.464V11.4641V11.5007V25.1673C23.1812 26.1243 23.1801 26.7917 23.1124 27.2952C23.0467 27.7844 22.9264 28.0435 22.7419 28.228C22.5574 28.4125 22.2983 28.5328 21.8091 28.5986C21.3056 28.6663 20.6381 28.6673 19.6812 28.6673H10.3185C9.36151 28.6673 8.6941 28.6663 8.19054 28.5986C7.70135 28.5328 7.4423 28.4125 7.25779 28.228C7.07329 28.0435 6.95299 27.7844 6.88722 27.2952C6.81952 26.7917 6.81846 26.1243 6.81846 25.1673V11.5006V11.4641V11.4641C6.81847 10.5523 6.81848 9.81746 6.74077 9.23948C6.67712 8.76601 6.55623 8.35157 6.31094 8.00065ZM10.4998 22.0007C10.4998 22.2768 10.7237 22.5007 10.9998 22.5007C11.276 22.5007 11.4998 22.2768 11.4998 22.0007V14.0007C11.4998 13.7245 11.276 13.5007 10.9998 13.5007C10.7237 13.5007 10.4998 13.7245 10.4998 14.0007V22.0007ZM18.4998 22.0007C18.4998 22.2768 18.7237 22.5007 18.9998 22.5007C19.276 22.5007 19.4998 22.2768 19.4998 22.0007L19.4998 14.0007C19.4998 13.7245 19.276 13.5007 18.9998 13.5007C18.7237 13.5007 18.4998 13.7245 18.4998 14.0007L18.4998 22.0007ZM14.9998 22.5007C14.7237 22.5007 14.4998 22.2768 14.4998 22.0007V14.0007C14.4998 13.7245 14.7237 13.5007 14.9998 13.5007C15.276 13.5007 15.4998 13.7245 15.4998 14.0007V22.0007C15.4998 22.2768 15.276 22.5007 14.9998 22.5007Z" fill="white"/>
                                                            </svg>
                                                        </label>
                                                        <?
                                                        if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"]) {
                                                            $imgFile = CFile::ResizeImageGet($arResult["ELEMENT_FILES"][$value]['ID'], array('width' => 100, 'height' => 100), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
                                                        }
                                                    } ?>
                                                    <input type="hidden" name="PROPERTY[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]" value="<?= $value ?>"/>
                                                    <input type="file" accept=".png, .jpg, .jpeg, .pdf"
                                                           class="inputfile"
                                                           size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                           id="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"
                                                           name="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"/>
                                                    <div class="upload-image-box">
                                                        <label for="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"
                                                               id="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"
                                                               class="upload-image -default"
                                                               data-default="<?= SITE_TEMPLATE_PATH ?>/images/icons/upload-file.svg"
                                                               data-pdf="<?= SITE_TEMPLATE_PATH ?>/images/icons/PDF_Logo.svg">
                                                            <img class="preview-image" src="<?= $imgFile ?>"
                                                                 alt="Preview-<?= $i ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?}
                                        } ?>
                                    </div>
                                    <div class="hint"><?=GetMessage("IBLOCK_FILE_SIZE")?></div>
                                    <? break;
                                case "T":
                                    for ($i = 0; $i < $inputNum; $i++) {

                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                        } elseif ($i == 0) {
                                            $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                        } else {
                                            $value = "";
                                        }
                                        ?>
                                        <textarea class="form-control"
                                                  cols="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                  rows="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] ?>"
                                                  name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= $value ?></textarea>
                                        <?
                                    }
                                    break;
                                case "L":

                                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                                    else
                                        $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

                                    switch ($type):
                                        case "checkbox":
                                        case "radio":
                                            foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                $checked = false;
                                                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                    if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                                                        foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                                                            if ($arElEnum["VALUE"] == $key) {
                                                                $checked = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if ($arEnum["DEF"] == "Y") $checked = true;
                                                }

                                                ?>
                                                <input class="form-control" type="<?= $type ?>"
                                                       name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>"
                                                       value="<?= $key ?>"
                                                       id="property_<?= $key ?>"<?= $checked ? " checked=\"checked\"" : "" ?> />
                                                <label for="property_<?= $key ?>"><?= $arEnum["VALUE"] ?></label>
                                                <?
                                            }
                                            break;

                                        case "dropdown":
                                        case "multiselect":
                                            ?>

                                            <div class="form-select-box">
                                                <select class="form-select <?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"] ?>"
                                                        name="PROPERTY[<?= $propertyID ?>][0]<?/*=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""*/
                                                        ?>">
                                                    <option value=""><? echo GetMessage('CT_BIEAF_PROPERTY_VALUE_NA_' . $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]) ?></option>
                                                    <?
                                                    if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                                                    else $sKey = "ELEMENT";

                                                    foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                        if(SITE_ID=='ua'){
                                                            if($propertyID=='527') {
                                                                $arEnum["VALUE"] = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 20, 'ID' => $key), false, array('UF_NAME_UA'))->GetNext()['UF_NAME_UA'];
                                                            }elseif($propertyID=='529'|| $propertyID=='528'|| $propertyID=='526') {
                                                                $arEnum["VALUE"] = CIBlockElement::GetByID($key)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                                                            }
                                                        }
                                                        $checked = false;
                                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                            foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum) {
                                                                if ($key == $arElEnum["VALUE"]) {
                                                                    $checked = true;
                                                                    break;
                                                                }
                                                            }
                                                        } else {
                                                            if ($arEnum["DEF"] == "Y") $checked = true;
                                                        }
                                                        ?>
                                                        <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
                                                        <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?
                                            break;

                                    endswitch;
                                    break;
                            endswitch; ?>

                        </label>
                    </div>
                </div>
            <? endforeach; ?>
            <h2><?=GetMessage("IBLOCK_DATA_CONTACT")?></h2>
            <div class="row">
                <?
                $res = CIBlockElement::GetList(Array("name" => "asc"), array("IBLOCK_ID"=>24, "PROPERTY_AUTHOR" => $USER->GetID() ), false, Array(), Array('NAME','ID'));
                while($ob = $res->GetNextElement())
                {
                    $arFields = $ob->GetFields();
                    $companiesArray[] = ['NAME' => $arFields['NAME'], 'ID' => $arFields['ID']];
                }?>
                <?foreach ($contactBlock as $propertyID):
                    $value = $arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"];
                    if ($_GET['edit'] != 'Y') {
                        switch (strtolower($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"])) {
                            case 'name':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["NAME"];
                                break;
                            case 'phone':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["PERSONAL_PHONE"];
                                break;
                            case 'dopphone':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["PERSONAL_MOBILE"];
                                break;
                            case 'viber':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["UF_VIBER"];
                                break;
                            case 'telegram':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["UF_TELEGRAM"];
                                break;
                            case 'whatsapp':
                                $value = $USER->GetByID($USER->GetID())->Fetch()["UF_WHATSAPP"];
                                break;
                        }
                    }
                    if($companiesArray && strtolower($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]) == 'name'){
                        $name = $USER->GetByID($USER->GetID())->Fetch()["NAME"];
                        ?>
                        <div class="form-group col-xs-12 col-md-6">
                            <div class="form-select-box">
                                <select class="form-select -with-icon -<?= strtolower($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]) ?>" name="PROPERTY[<?= $propertyID ?>][0]">
                                    <? foreach ($companiesArray as $key => $companyName) {
                                            ?>
                                            <option value="<?= $companyName['ID'] ?>" <?= $companyName['ID'] == $value ? " selected=\"selected\"" : "" ?>><?= $companyName['NAME'] ?></option>
                                            <?
                                    }
                                        ?>
                                        <option <?=  $USER->GetID() == $value ? " selected=\"selected\"" : "" ?> value="<?= $USER->GetID() ?>"><?= $name ?></option>
                                        <?
                                    ?>
                                </select>
                            </div>
                        </div>
                    <?}else{?>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -<?= strtolower($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]) ?>"></span>
                            <input type="text"
                                   class="form-control item-<?= strtolower($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]) ?>"
                                   name="PROPERTY[<?= $propertyID ?>][0]"
                                   size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]; ?>"
                                   value="<?= $value ?>"
                                   placeholder="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>"/>
                        </label>
                    </div>
                <?}?>
                <? endforeach; ?>
            </div>

        <? endif ?>

        <div class="required-text"><?=GetMessage("IBLOCK_FORM_NEED")?></div>

        <div class="text-xs-center">
            <? if ($_GET['edit'] != 'Y') { ?>
                <input type="submit" name="iblock_submit" class="btn btn-orange"
                       value="<?= GetMessage("IBLOCK_FORM_SUBMIT") ?>"/>
            <? } else { ?>
                <input type="submit" name="iblock_apply" class="btn btn-green"
                       value="<?= GetMessage("IBLOCK_FORM_APPLY") ?>"/>
                <input type="button" name="iblock_cancel" class="btn btn-orange"
                       value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
                       onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"]) ?>';">
            <? } ?>


        </div>
        <div class="privacy-policy-text"><?=GetMessage("IBLOCK_FORM_BTN")?></div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $(".CATEGORY").change(function () {
            let id = $(this).val();
            let subcategory = $('.SUBCATEGORY-block');
            $.ajax({
                type: "POST",
                url: '<?=SITE_TEMPLATE_PATH ?>/components/bitrix/iblock.element.add.form/announcement/ajaxCategory.php',
                data: {CATEGORY: id, SITE_ID: "<?=SITE_ID?>"},
                success: function (data) {
                    // Вывод текста результата отправки
                    $(subcategory).html(data);
                }
            });
            return false;
        });
    })
</script>