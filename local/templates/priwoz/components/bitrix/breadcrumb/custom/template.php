<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult))
    return "";

$strReturn = ''; ?>
    <? //we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

    $strReturn .= '<div class="breadcrumbs" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

    $itemSize = count($arResult);
    for ($index = 0; $index < $itemSize; $index++) {
        $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
        $arrow = ($index > 0 ? '<span class="sep">-</span>' : '');

        if ($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
            $strReturn .= $arrow.'
		 <a href="' . $arResult[$index]["LINK"] . '" itemprop="name"  id="bx_breadcrumb_' . $index . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . $title . '</a>
		 <meta itemprop="position" content="' . ($index + 1) . '" />';
        } else {
            $strReturn .= $arrow.'<span class="current-page">' . $title . '</span>';
        }
    }
    $strReturn .= '</div>';
    return $strReturn; ?>
</div>
