<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
CUtil::InitJSCore(array('fx'));
?>
<?php
Bitrix\Main\Loader::includeModule('neti.favorite');
$defaultClass = \Bitrix\Main\Config\Option::get('neti.favorite',
    'removeClass');
?>
<section class="single-product-section">
    <div class="container">
        <?if($arResult['PROPERTIES']['AUTHOR']['VALUE']== $USER->GetID() && CUser::IsAuthorized()){?>
        <a href="/personal/announcement/?edit=Y&CODE=<?=$arResult["ID"]?>" class="sidebar-widget edit-link d-xs-block d-xl-none">
            <?=GetMessage("T_EDIT_ADS")?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M11.325 1.21319L11.3251 1.2131C11.7994 0.738518 12.426 0.5 13.0559 0.5C13.6859 0.5 14.3124 0.738518 14.7868 1.2131L14.7869 1.21318C15.7377 2.16399 15.7377 3.72424 14.7869 4.67505L14.7869 4.67506L5.46506 13.9977C5.46505 13.9977 5.46505 13.9977 5.46504 13.9977C5.34857 14.1141 5.20365 14.199 5.04377 14.245L4.91967 14.2806L4.91918 14.2811L0.667922 15.495C0.667901 15.495 0.667879 15.495 0.667857 15.495C0.645283 15.5014 0.621406 15.5017 0.598696 15.4958C0.575961 15.4899 0.555218 15.478 0.538611 15.4614C0.522005 15.4448 0.510135 15.424 0.504231 15.4013C0.498342 15.3786 0.498605 15.3548 0.504991 15.3322C0.505006 15.3322 0.505021 15.3321 0.505036 15.3321L1.75446 10.9571L1.75461 10.9565C1.79994 10.7972 1.88555 10.6518 2.00233 10.535C2.00234 10.535 2.00234 10.535 2.00235 10.535L11.325 1.21319ZM13.0767 5.30565L13.4302 5.6592L13.7838 5.30565L14.6006 4.4888C15.4595 3.62992 15.4581 2.25766 14.5998 1.39942C14.1727 0.972164 13.6152 0.756122 13.0559 0.756122C12.4969 0.756122 11.9385 0.971985 11.5113 1.39942C11.5112 1.39945 11.5112 1.39948 11.5112 1.39951L10.6944 2.21627L10.3408 2.56983L10.6944 2.92338L13.0767 5.30565ZM10.5082 3.10962L10.1546 2.75609L9.80106 3.10961L2.18862 10.7212L2.18861 10.7212C2.09992 10.8099 2.03993 10.9165 2.00791 11.0287C2.00789 11.0288 2.00788 11.0289 2.00786 11.0289C2.00782 11.029 2.00779 11.0292 2.00775 11.0293L1.07013 14.3118L0.822958 15.1771L1.68826 14.9299L4.97048 13.9921L4.97126 13.9919C5.08855 13.9582 5.19321 13.8956 5.27677 13.8126L5.27799 13.8114L12.8904 6.199L13.244 5.84545L12.8904 5.4919L10.5082 3.10962Z" stroke="currentColor"/>
            </svg>
        </a>
        <?}?>
        <div class="content-row">
            <div class="sidebar">
                <div class="sidebar-widgets">
                    <?if($arResult['PROPERTIES']['AUTHOR']['VALUE']== $USER->GetID() && CUser::IsAuthorized()){?>
                    <a href="<?=SITE_DIR?>personal/announcement/?edit=Y&CODE=<?=$arResult["ID"]?>" class="sidebar-widget edit-link d-xs-none d-xl-block">
                        <?=GetMessage("T_EDIT_ADS")?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M11.325 1.21319L11.3251 1.2131C11.7994 0.738518 12.426 0.5 13.0559 0.5C13.6859 0.5 14.3124 0.738518 14.7868 1.2131L14.7869 1.21318C15.7377 2.16399 15.7377 3.72424 14.7869 4.67505L14.7869 4.67506L5.46506 13.9977C5.46505 13.9977 5.46505 13.9977 5.46504 13.9977C5.34857 14.1141 5.20365 14.199 5.04377 14.245L4.91967 14.2806L4.91918 14.2811L0.667922 15.495C0.667901 15.495 0.667879 15.495 0.667857 15.495C0.645283 15.5014 0.621406 15.5017 0.598696 15.4958C0.575961 15.4899 0.555218 15.478 0.538611 15.4614C0.522005 15.4448 0.510135 15.424 0.504231 15.4013C0.498342 15.3786 0.498605 15.3548 0.504991 15.3322C0.505006 15.3322 0.505021 15.3321 0.505036 15.3321L1.75446 10.9571L1.75461 10.9565C1.79994 10.7972 1.88555 10.6518 2.00233 10.535C2.00234 10.535 2.00234 10.535 2.00235 10.535L11.325 1.21319ZM13.0767 5.30565L13.4302 5.6592L13.7838 5.30565L14.6006 4.4888C15.4595 3.62992 15.4581 2.25766 14.5998 1.39942C14.1727 0.972164 13.6152 0.756122 13.0559 0.756122C12.4969 0.756122 11.9385 0.971985 11.5113 1.39942C11.5112 1.39945 11.5112 1.39948 11.5112 1.39951L10.6944 2.21627L10.3408 2.56983L10.6944 2.92338L13.0767 5.30565ZM10.5082 3.10962L10.1546 2.75609L9.80106 3.10961L2.18862 10.7212L2.18861 10.7212C2.09992 10.8099 2.03993 10.9165 2.00791 11.0287C2.00789 11.0288 2.00788 11.0289 2.00786 11.0289C2.00782 11.029 2.00779 11.0292 2.00775 11.0293L1.07013 14.3118L0.822958 15.1771L1.68826 14.9299L4.97048 13.9921L4.97126 13.9919C5.08855 13.9582 5.19321 13.8956 5.27677 13.8126L5.27799 13.8114L12.8904 6.199L13.244 5.84545L12.8904 5.4919L10.5082 3.10962Z" stroke="currentColor"></path>
                        </svg>
                    </a>
                    <?}?>
                    <div class="sidebar-widget">
                        <div class="product-info">
                            <div class="top-part">
                                <time datetime="<?=strtolower(FormatDate("d m Y", MakeTimeStamp($arResult['TIMESTAMP_X']))) ?>" class="date"><?= strtolower(strftime('%d %b %Y', MakeTimeStamp($arResult['TIMESTAMP_X']))) ?></time>
                                <a href="#" class="js-favorite add-to-favourite" aria-hidden="true"
                                   data-favorite-entity="<?=$arResult['ID'] ?>"
                                   data-iblock-id="<?=$arResult['IBLOCK_ID'] ?>">
                                </a>
                            </div>
                            <h1 class="product-title"><?=$arResult["NAME"]?></h1>
                            <div class="price"><?if($arResult['PROPERTIES']['PRICE']['VALUE']!=0){echo $arResult['PROPERTIES']['PRICE']['VALUE'];?> BGN<?}else{echo GetMessage("T_PRICE_0");}?></div>
                            <? if (SITE_ID == 's1') {
                                $locationName = $arResult["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arResult["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['NAME'];
                            }
                            if (SITE_ID == 'ua') {
                               $locationId = $arResult["DISPLAY_PROPERTIES"]['CITY']['LINK_ELEMENT_VALUE'][$arResult["DISPLAY_PROPERTIES"]['CITY']['VALUE']]['ID'];
                               $locationName = CIBlockElement::GetByID($locationId)->GetNextElement()->GetProperties()['NAME_UA']['VALUE'];
                            }?>
                            <div class="location"><?= $locationName?></div>
                            <div class="phone-link">
                                <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>"><?=$arResult['PROPERTIES']['PHONE']['VALUE']?></a>
                            </div>
                            <? if ($arResult['PROPERTIES']['TELEGRAM']['VALUE'] || $arResult['PROPERTIES']['VIBER']['VALUE'] || $arResult['PROPERTIES']['WHATSAPP']['VALUE']) { ?>
                                <ul class="menu -social">
                                    <? if ($arResult['PROPERTIES']['TELEGRAM']['VALUE']) { ?>
                                        <li>
                                            <a href="https://telegram.me/<?= $arResult['PROPERTIES']['TELEGRAM']['VALUE'] ?>" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                     viewBox="0 0 120 120" fill="none">
                                                    <path d="M19.8946 87.513C15.6076 85.2522 11.248 82.9392 7.8142 79.5558C1.3996 73.233 -0.9446 63.7404 0.3376 55.1298C1.6204 46.5204 6.1588 38.7258 11.8162 32.1036C16.8784 26.1768 23.0158 20.9514 30.3688 17.988C37.7206 15.0246 46.3972 14.5122 53.8438 17.7114C58.8982 19.8828 63.2092 23.637 68.4382 25.3374C76.8772 28.0806 85.9606 25.0008 94.7464 26.0082C103.895 27.057 112.466 32.874 116.708 40.9122C121.333 49.6782 120.73 60.267 117.096 69.2178C113.463 78.1698 107.093 85.7406 100.369 92.742C92.3572 101.086 82.5664 109.315 70.648 109.482C62.0206 109.603 53.8834 105.435 46.195 101.381C37.4284 96.7584 28.6612 92.1354 19.8946 87.513Z"
                                                          fill="url(#paint0_linear_95_95)"/>
                                                    <path d="M105.673 101.176C105.986 94.31 103.981 87.5738 101.997 80.993C97.0254 64.5038 92.0532 48.0152 87.0816 31.526C85.1304 25.055 83.1168 18.4532 79.1874 12.9542C73.7598 5.35822 64.7376 0.454421 55.4124 0.0302213C46.086 -0.393979 36.6564 3.67102 30.5622 10.7426C23.5104 18.9248 21.2562 30.0338 17.796 40.2662C14.6448 49.5848 10.2936 58.6106 8.93578 68.3534C7.57859 78.0962 9.91198 89.1458 17.7876 95.0396C24.1236 99.7808 32.5986 100.256 40.5126 100.236C48.426 100.216 56.7474 99.9782 63.7434 103.677C68.4804 106.182 72.144 110.267 76.215 113.751C80.286 117.236 85.2522 120.284 90.6018 119.978C94.9998 119.727 99.0768 117.135 101.669 113.573C104.263 110.013 105.472 105.577 105.673 101.176Z"
                                                          fill="#4CA3C6"/>
                                                    <g class="hover-path">
                                                        <path d="M19.8946 87.513C15.6076 85.2522 11.248 82.9392 7.8142 79.5558C1.3996 73.233 -0.9446 63.7404 0.3376 55.1298C1.6204 46.5204 6.1588 38.7258 11.8162 32.1036C16.8784 26.1768 23.0158 20.9514 30.3688 17.988C37.7206 15.0246 46.3972 14.5122 53.8438 17.7114C58.8982 19.8828 63.2092 23.637 68.4382 25.3374C76.8772 28.0806 85.9606 25.0008 94.7464 26.0082C103.895 27.057 112.466 32.874 116.708 40.9122C121.333 49.6782 120.73 60.267 117.096 69.2178C113.463 78.1698 107.093 85.7406 100.369 92.742C92.3572 101.086 82.5664 109.315 70.648 109.482C62.0206 109.603 53.8834 105.435 46.195 101.381C37.4284 96.7584 28.6612 92.1354 19.8946 87.513Z"
                                                              fill="url(#paint0_linear_95_95)"/>
                                                    </g>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M70.8556 45.0767C71.4254 45.3959 70.0301 46.5191 69.3875 47.1637C60.9157 54.9079 52.5211 62.5767 43.9649 70.2277C42.926 71.2561 43.4862 71.2016 43.1082 73.7813C42.6066 77.2054 42.7502 80.7174 42.2534 83.958C42.1707 84.4984 42.1234 84.6429 42.2798 84.9476C42.4456 85.2698 42.5628 85.5923 42.9183 85.5691C43.8925 85.5058 43.9073 85.035 44.6723 84.4233C45.0448 84.125 45.1307 84.0608 45.4755 83.7152L50.449 79.2434C52.6199 77.3273 52.0185 77.2605 55.0819 79.5801L64.3399 86.3149C65.2089 86.9725 67.2958 88.5226 68.1126 88.8383C72.3523 90.4781 72.7136 85.1057 73.3739 81.9119L77.7872 60.8711C79.207 54.9066 80.4948 48.6281 81.7524 42.5939C82.3274 39.8371 82.6561 36.9729 81.573 35.9039C80.319 34.6662 78.4739 35.1993 77.1768 35.6807C69.1158 38.6746 60.7901 42.1031 52.6917 45.1882L24.0175 56.2981C22.6154 56.8631 21.3276 57.3091 19.9338 57.8798C18.6521 58.4048 17.1847 59.8495 18.5417 61.0975C19.5485 62.024 21.0046 62.3529 22.4644 62.8405C25.888 63.9836 29.6545 65.3435 33.1136 66.2912C34.7149 66.7298 34.3679 67.1171 36.0826 65.9881L69.2491 45.2602C69.6496 44.9957 70.4216 44.8348 70.8556 45.0767Z"
                                                          fill="white"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_95_95" x1="86.4532"
                                                                        y1="126.053"
                                                                        x2="32.2564" y2="-4.137"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#66BFE1"/>
                                                            <stop offset="0.529412" stop-color="#60BDE1"/>
                                                            <stop offset="1" stop-color="#A1D3E8"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </li>
                                    <?
                                    }
                                    if ($arResult['PROPERTIES']['VIBER']['VALUE']) {
                                        ?>
                                        <li>
                                            <a href="viber://chat?number=<?= $arResult['PROPERTIES']['VIBER']['VALUE'] ?>">
                                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19.8946 87.513C15.6076 85.2522 11.248 82.9392 7.8142 79.5558C1.3996 73.233 -0.9446 63.7404 0.3376 55.1298C1.6204 46.5204 6.1588 38.7258 11.8162 32.1036C16.8784 26.1768 23.0158 20.9514 30.3688 17.988C37.7206 15.0246 46.3972 14.5122 53.8438 17.7114C58.8982 19.8828 63.2092 23.637 68.4382 25.3374C76.8772 28.0806 85.9606 25.0008 94.7464 26.0082C103.895 27.057 112.466 32.874 116.708 40.9122C121.333 49.6782 120.73 60.267 117.096 69.2178C113.463 78.1698 107.093 85.7406 100.369 92.742C92.3572 101.086 82.5664 109.315 70.648 109.482C62.0206 109.603 53.8834 105.435 46.195 101.381C37.4284 96.7584 28.6612 92.1354 19.8946 87.513Z"
                                                          fill="url(#paint0_linear_95_103)"/>
                                                    <path d="M4.21901 90.6038C4.82254 84.6436 7.74966 79.0604 10.6346 73.6083C17.8647 59.9493 25.0941 46.2904 32.3235 32.6309C35.1608 27.2701 38.0787 21.8045 42.7846 17.5091C49.2846 11.575 59.0553 8.37474 68.5338 9.07453C78.0122 9.77485 86.9954 14.36 92.2064 21.1585C98.2355 29.0243 99.0261 38.8673 101.152 48.092C103.089 56.4927 106.277 64.7779 106.345 73.3394C106.412 81.9008 102.576 91.1684 93.8304 95.354C86.7948 98.7209 78.1694 98.1621 70.1762 97.2403C62.1842 96.3186 53.8089 95.1624 46.2462 97.5542C41.1245 99.1736 36.8772 102.28 32.2979 104.821C27.7185 107.363 22.2942 109.425 16.9297 108.549C12.5204 107.83 8.7482 105.127 6.60437 101.758C4.46177 98.3893 3.83318 94.424 4.21901 90.6038Z"
                                                          fill="#5F5697"/>
                                                    <g class="hover-path">
                                                        <path d="M19.8946 87.513C15.6076 85.2522 11.248 82.9392 7.8142 79.5558C1.3996 73.233 -0.9446 63.7404 0.3376 55.1298C1.6204 46.5204 6.1588 38.7258 11.8162 32.1036C16.8784 26.1768 23.0158 20.9514 30.3688 17.988C37.7206 15.0246 46.3972 14.5122 53.8438 17.7114C58.8982 19.8828 63.2092 23.637 68.4382 25.3374C76.8772 28.0806 85.9606 25.0008 94.7464 26.0082C103.895 27.057 112.466 32.874 116.708 40.9122C121.333 49.6782 120.73 60.267 117.096 69.2178C113.463 78.1698 107.093 85.7406 100.369 92.742C92.3572 101.086 82.5664 109.315 70.648 109.482C62.0206 109.603 53.8834 105.435 46.195 101.381C37.4284 96.7584 28.6612 92.1354 19.8946 87.513Z"
                                                              fill="url(#paint0_linear_95_103)"/>
                                                    </g>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M45.9594 88.3489C45.9594 85.7365 44.0182 83.3049 41.734 82.0371C37.9045 79.9119 35.5984 75.6465 34.7479 71.4936C33.6034 65.9082 33.6962 55.5968 35.2691 50.2231C37.0301 44.2069 41.2911 40.9605 47.8 39.436C53.9677 37.9915 62.9897 37.8594 69.3554 38.8677C75.8669 39.8988 80.9304 42.019 83.847 47.8918C86.2534 52.7373 86.3065 62.8321 85.6495 68.7033C84.8061 76.2379 81.9465 80.2471 76.4326 82.7906C72.0628 84.8063 66.5069 85.2824 61.0906 85.3053C57.7454 85.3195 54.5743 86.8606 52.3854 89.3902C51.1907 90.7708 49.9578 92.1357 48.8637 93.3861C48.5237 93.7747 48.0333 94.3553 47.6988 94.7966C45.2409 98.0401 45.9594 90.8729 45.9594 89.7029C45.9594 89.2516 45.9594 88.8003 45.9594 88.3489ZM61.766 53.7453C61.3218 53.98 61.1659 54.3313 61.392 54.7938C61.6347 55.2898 62.0756 55.211 62.5605 55.2599C64.2866 55.4328 65.7342 56.5459 66.1622 58.2543C66.3281 58.9171 66.168 60.7165 67.4591 60.1013C68.5922 59.5613 67.6709 55.4479 64.527 54.1034C63.8742 53.8241 62.4812 53.3676 61.766 53.7453ZM60.6364 49.417C59.7824 49.8679 60.0777 50.7866 61.1235 50.9113C63.7859 51.2285 65.4512 51.5181 67.616 53.5959C72.03 57.831 69.3896 62.6229 71.6534 61.5441C72.7138 61.0389 71.743 57.4707 71.4606 56.6706C70.5037 53.961 68.2946 51.4558 65.611 50.3025C64.6974 49.91 61.6334 48.8908 60.6364 49.417ZM59.1845 45.2487C58.6162 45.5495 58.533 46.2053 59.0325 46.5614C59.805 47.1123 65.1267 45.9086 70.3391 51.0511C77.0191 57.6407 73.2172 64.5627 75.8478 63.3075C77.198 62.6634 75.6996 56.9075 75.3305 55.8696C74.4775 53.4715 73.2392 51.8396 71.8802 50.3234C70.7331 49.0431 68.7025 47.4466 66.6235 46.5694C65.3971 46.0519 60.5603 44.5203 59.1845 45.2487ZM47.6891 46.9847C45.9445 47.5958 43.7706 49.5369 43.1813 51.1948C42.0992 54.239 46.004 61.3307 47.7551 63.7141C51.4968 68.8071 56.135 73.248 61.7437 76.2678C63.7383 77.3417 65.6734 78.1713 68.0365 78.8219C71.2471 79.7058 72.5682 78.0839 73.9249 76.4504C74.4264 75.8464 75.2742 74.5771 75.2752 73.5141C75.2765 72.1793 74.2633 71.7968 73.3663 71.1291C72.3871 70.3998 69.1991 67.8191 68.1649 67.4742C64.0854 66.1142 65.489 74.5745 56.4902 67.2177C54.8275 65.858 51.2539 61.6094 51.9064 58.8898C52.2017 57.6584 53.4931 57.3013 54.1142 56.6006C55.8225 54.673 53.7739 52.8305 52.4188 50.9042C50.8081 48.614 49.7642 46.2576 47.6891 46.9847ZM84.767 41.2051C83.1858 39.6761 81.9691 38.4392 79.5863 37.2098C75.2111 34.952 70.5911 33.9698 64.9989 33.5975C47.4539 32.5834 33.6535 35.8813 30.2365 51.3092C28.2186 60.4204 28.4434 76.3816 35.6734 83.2515C36.1559 83.71 36.9794 84.3766 37.9676 85.0642C41.1816 87.3008 44.002 90.9298 44.1957 94.8406C44.3073 97.0913 45.7827 98.4242 47.9844 97.3208C48.7058 96.9591 52.2169 92.8866 53.0881 91.8137C54.1821 90.606 55.6523 89.9148 57.2769 90.0426C58.1452 90.111 59.0151 90.1839 59.5132 90.185C69.3259 90.2075 80.3148 88.8646 86.1347 80.7254C91.3474 73.4351 91.8249 59.7869 89.598 50.6683C88.8533 47.6192 86.9845 43.35 84.767 41.2051Z"
                                                          fill="white"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_95_103" x1="86.4532"
                                                                        y1="126.053"
                                                                        x2="32.2564" y2="-4.137"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#5F5699"/>
                                                            <stop offset="0.529412" stop-color="#7269AA"/>
                                                            <stop offset="1" stop-color="#8B76C1"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </li>
                                    <?
                                    }
                                    if ($arResult['PROPERTIES']['WHATSAPP']['VALUE']) {
                                        ?>
                                        <li>
                                            <a href="whatsapp://send?phone=<?= $arResult['PROPERTIES']['WHATSAPP']['VALUE'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                     viewBox="0 0 60 60" fill="none">
                                                    <path d="M9.9473 15.9339C7.8038 17.0643 5.624 18.2208 3.9071 19.9125C0.6998 23.0739 -0.4723 27.8202 0.1688 32.1255C0.8102 36.4302 3.0794 40.3275 5.9081 43.6386C8.4392 46.602 11.5079 49.2147 15.1844 50.6964C18.8603 52.1781 23.1986 52.4343 26.9219 50.8347C29.4491 49.749 31.6046 47.8719 34.2191 47.0217C38.4386 45.6501 42.9803 47.19 47.3732 46.6863C51.9473 46.1619 56.2328 43.2534 58.3538 39.2343C60.6665 34.8513 60.365 29.5569 58.5482 25.0815C56.7314 20.6055 53.5463 16.8201 50.1845 13.3194C46.1786 9.14763 41.2832 5.03283 35.324 4.94943C31.0103 4.88883 26.9417 6.97293 23.0975 8.99973C18.7142 11.3112 14.3306 13.6227 9.9473 15.9339Z"
                                                          fill="#5DBE28"/>
                                                    <path d="M2.1095 14.3875C2.41127 17.3677 3.87483 20.1592 5.3173 22.8853C8.93233 29.7148 12.5471 36.5443 16.1618 43.374C17.5804 46.0544 19.0394 48.7872 21.3923 50.9349C24.6423 53.902 29.5277 55.5021 34.2669 55.1522C39.0061 54.802 43.4977 52.5094 46.1032 49.1102C49.1177 45.1773 49.5131 40.2558 50.5761 35.6434C51.5444 31.4431 53.1385 27.3005 53.1724 23.0198C53.206 18.739 51.2882 14.1053 46.9152 12.0124C43.3974 10.329 39.0847 10.6084 35.0881 11.0693C31.0921 11.5301 26.9044 12.1083 23.1231 10.9123C20.5622 10.1026 18.4386 8.54951 16.1489 7.27892C13.8593 6.00807 11.1471 4.97718 8.46486 5.41481C6.26019 5.77463 4.3741 7.12617 3.30219 8.81037C2.23088 10.4948 1.91659 12.4775 2.1095 14.3875Z"
                                                          fill="#52A823"/>
                                                    <g class="hover-path">
                                                        <path d="M9.9473 15.9339C7.8038 17.0643 5.624 18.2208 3.9071 19.9125C0.6998 23.0739 -0.4723 27.8202 0.1688 32.1255C0.8102 36.4302 3.0794 40.3275 5.9081 43.6386C8.4392 46.602 11.5079 49.2147 15.1844 50.6964C18.8603 52.1781 23.1986 52.4343 26.9219 50.8347C29.4491 49.749 31.6046 47.8719 34.2191 47.0217C38.4386 45.6501 42.9803 47.19 47.3732 46.6863C51.9473 46.1619 56.2328 43.2534 58.3538 39.2343C60.6665 34.8513 60.365 29.5569 58.5482 25.0815C56.7314 20.6055 53.5463 16.8201 50.1845 13.3194C46.1786 9.14763 41.2832 5.03283 35.324 4.94943C31.0103 4.88883 26.9417 6.97293 23.0975 8.99973C18.7142 11.3112 14.3306 13.6227 9.9473 15.9339Z"
                                                              fill="#5DBE28"/>
                                                    </g>
                                                    <path d="M12 47.376C12.0801 47.0392 12.1262 46.8117 12.1888 46.5889C12.8968 44.0694 13.598 41.5483 14.3267 39.0348C14.4496 38.6111 14.3969 38.277 14.1899 37.8972C10.0821 30.3514 11.9113 20.8781 18.5878 15.4425C22.7831 12.0272 27.6104 10.7252 32.96 11.5964C40.3074 12.7927 46.1981 18.3956 47.6107 25.7086C48.8895 32.3271 47.0124 38.0455 42.0574 42.6404C38.3369 46.0906 33.8413 47.551 28.7971 47.2828C26.3225 47.1514 23.9695 46.4843 21.7728 45.3218C21.3721 45.1102 21.0087 45.0742 20.5749 45.1883C17.9305 45.884 15.2807 46.559 12.6323 47.2392C12.4577 47.284 12.2801 47.3157 12 47.376ZM24.0834 20.9438C25.0299 20.7473 25.4918 21.2021 25.7886 22.0341C26.1374 23.0119 26.5734 23.9605 27.0093 24.904C27.2556 25.4366 27.1866 25.8566 26.7818 26.2713C26.4195 26.6432 26.1025 27.0586 25.7538 27.4445C25.4941 27.7324 25.4595 28.0216 25.6539 28.3608C27.1157 30.909 29.2503 32.6575 31.9775 33.7095C32.3282 33.8446 32.5548 33.688 32.7549 33.4285C33.1752 32.884 33.6078 32.3485 34.0157 31.7948C34.3138 31.3903 34.6496 31.3086 35.1059 31.5255C36.2723 32.0797 37.445 32.6221 38.624 33.1489C39.0904 33.3572 39.199 33.6763 39.1297 34.1596C38.666 37.3908 35.7352 38.3594 33.4669 37.7825C30.2781 36.9716 27.5645 35.3307 25.2554 33.0177C23.7801 31.5401 22.4519 29.9376 21.5973 28.0033C21.0457 26.7551 20.7489 25.4586 21.0083 24.0843C21.2412 22.8488 21.9439 21.8982 22.9159 21.1638C23.2203 20.9339 23.6896 20.9222 24.0834 20.811C24.0834 20.8553 24.0834 20.8996 24.0834 20.9438ZM16.3684 43.0797C16.6224 43.0369 16.799 43.0198 16.9689 42.9766C18.3508 42.6256 19.7348 42.2818 21.1107 41.9079C21.4968 41.8028 21.8059 41.8399 22.1511 42.0507C24.7883 43.6592 27.6564 44.4564 30.7425 44.2465C36.3364 43.866 40.6033 41.2196 43.2051 36.2702C45.8768 31.1866 45.612 26.045 42.5173 21.1996C39.9656 17.204 36.2086 14.9253 31.4813 14.4726C26.3106 13.9775 21.9841 15.7931 18.5841 19.708C16.4973 22.1106 15.3595 24.9569 15.1066 28.1266C14.835 31.5343 15.6518 34.6869 17.5176 37.557C17.7084 37.8506 17.749 38.1171 17.6504 38.4528C17.2627 39.7726 16.8975 41.0988 16.5265 42.4233C16.4736 42.6121 16.4341 42.8043 16.3684 43.0797Z"
                                                          fill="white"/>
                                                </svg>
                                            </a>
                                        </li>
                                    <? } ?>
                                </ul>
                            <? } ?>
                        </div>
                    </div>
                    <?
                    global $userIdItem,$userIdAd,$iblokId,$allUrl;
                    $userIdItem = $arResult['PROPERTIES']['AUTHOR']['VALUE'];
                    $userIdAd = $arResult['ID'];
                    $iblokId = $arResult['IBLOCK_ID'];

                    $userPhoto = SITE_TEMPLATE_PATH."/images/icons/user.svg";
                    $allTitle = GetMessage("T_AUTHOR");
                    $allUrl = 'userAds='.$arResult['PROPERTIES']['AUTHOR']['VALUE'];
                    $rsUser = CUser::GetByID($arResult['PROPERTIES']['AUTHOR']['VALUE']);
                    $arUser = $rsUser->Fetch();
                    if($arUser['ID'] == $arResult['PROPERTIES']['NAME']['VALUE'] || !is_numeric($arResult["PROPERTIES"]['NAME']['VALUE'])){
                        if($arUser['PERSONAL_PHOTO']){
                            $userPhoto = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
                        }
                        if($arUser['NAME'] || $arUser['LAST_NAME']){
                            $userName = $arUser['NAME'].' '.$arUser['LAST_NAME'];
                        }else{
                            $userName = $arUser['PERSONAL_PHONE'];
                        }?>
                    <?}else{
                        $res = CIBlockElement::GetList(Array("name" => "asc"), array("IBLOCK_ID"=>24, "PROPERTY_AUTHOR" => $arResult['PROPERTIES']['AUTHOR']['VALUE'] ), false, Array(), Array('NAME','ID','PROPERTY_LOGO'));
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();
                            if($arFields['ID'] == $arResult['PROPERTIES']['NAME']['VALUE']){
                                if($arFields['PROPERTY_LOGO_VALUE']){
                                    $userPhoto = CFile::ResizeImageGet($arFields['PROPERTY_LOGO_VALUE'], array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src'];
                                }
                                $userName = $arFields['NAME'];
                                $allTitle = GetMessage("T_COMPANY");
                                $allUrl = 'companisAds='.$arFields['ID'];
                            }
                        }

                    }?>
                    <a href="<?=SITE_DIR?>ads/?<?=$allUrl ?>" class="sidebar-widget d-xs-none d-md-block">
                        <div class="author-box">
                            <div class="ava"><img src="<?= $userPhoto?>" alt="<?= $userName?>"></div>
                            <div class="text"><?= $userName?></div>
                        </div>
                        <div class="blue-link"><?=GetMessage("T_ALL_ADS")?> <?=$allTitle?> >></div>
                    </a>
                </div>
            </div>
            <div class="main-content">
                <div class="content-wrap">
                    <? if ($arResult['PROPERTIES']['PHOTOS']['VALUE']): ?>
                        <div class="slider-box">
                            <div class="big-image-slider swiper-container">
                                <div class="swiper-wrapper">
                                    <? foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $key => $photo) {
                                        $file = CFile::ResizeImageGet($photo, array('width' => 900, 'height' => 900), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                        $fileFancy = CFile::ResizeImageGet($photo, array('width' => 1920, 'height' => 1920), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <a href="<?= $fileFancy['src']?>" data-fancybox="gallery" data-caption="<?=$arResult["NAME"]?>">
                                                    <img class="bg-img" src="<?= $file['src'] ?>"
                                                         alt="<?= $arResult['NAME'] ?>-<?= $key + 1 ?>">
                                                </a>

                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="thumbnails-slider swiper-container">
                                <div class="swiper-wrapper">
                                    <?
                                    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $key => $photo) {
                                        $minifile = CFile::ResizeImageGet($photo, array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img class="bg-img" src="<?=$minifile['src']?>"
                                                     alt="<?=$arResult['NAME']?>-<?=$key+1?>">
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    <?endif;?>

                    <div class="content-box">
                        <?=$arResult['PREVIEW_TEXT']?>
                    </div>
                    <div class="complaint-box">
                        <a href="/" class="report-popup-opener">
                            <?=GetMessage("T_FAK")?>
                        </a>
                    </div>
                </div>
                <a href="<?=SITE_DIR?>ads/?<?=$allUrl ?>" class="sidebar-widget d-xs-block d-md-none">
                    <div class="author-box">
                        <div class="ava"><img src="<?= $userPhoto?>" alt="<?= $userName?>"></div>
                        <div class="text"><?= $userName?></div>
                    </div>
                    <div class="blue-link"><?=GetMessage("T_ALL_ADS")?> <?=$allTitle?> >></div>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="report-popup">
    <div class="modal-overlay"></div>
    <div class="modal-box">
        <div class="scroll-box">
            <div class="form-box">
                <?$APPLICATION->IncludeComponent(
                    "networld:form.result.new",
                    "custom",
                    array(
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_SHADOW" => "N",
                        "AJAX_OPTION_JUMP" => "Y",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "N",
                        "CHAIN_ITEM_LINK" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "EDIT_URL" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "LIST_URL" => "",
                        "SEF_MODE" => "N",
                        "SUCCESS_URL" => "",
                        "USE_EXTENDED_ERRORS" => "Y",
                        "WEB_FORM_ID" => "1",
                        "COMPONENT_TEMPLATE" => "custom",
                        "VARIABLE_ALIASES" => array(
                            "WEB_FORM_ID" => "WEB_FORM_ID",
                            "RESULT_ID" => "RESULT_ID",
                        )
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
</div>
<?
global $arrFilter;
$arrFilter = array("PROPERTY_AUTHOR" => $arResult['PROPERTIES']['AUTHOR']['VALUE']);
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider-product",
    array(
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "ads",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_PAGER_SHOW_ALL" => "Y",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PROPERTY_CODE" => array(
            0 => "LOGO",
            1 => "CONDITION",
            2 => "PHOTOS",
            3 => "AUTHOR",
            4 => "PHONE",
            5 => "DOPPHONE",
            6 => "CITY",
            7 => "TELEGRAM",
            8 => "VIBER",
            9 => "WHATSAPP",
            10 => "CATEGORY",
            11 => "SUBCATEGORY",
        ),
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "LOGO",
            1 => "CONDITION",
            2 => "PHOTOS",
            3 => "AUTHOR",
            4 => "PHONE",
            5 => "DOPPHONE",
            6 => "CITY",
            7 => "TELEGRAM",
            8 => "VIBER",
            9 => "WHATSAPP",
            10 => "CATEGORY",
            11 => "SUBCATEGORY",
        ),
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "NEWS_COUNT" => "24",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "arrows",
        "PAGER_TITLE" => "Новости",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SEF_FOLDER" => "/personal/favorite/",
        "SEF_MODE" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_404" => "Y",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "USE_CATEGORIES" => "N",
        "USE_FILTER" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "USE_PERMISSIONS" => "N",
        "USE_RATING" => "N",
        "USE_REVIEW" => "N",
        "USE_RSS" => "N",
        "USE_SEARCH" => "N",
        "USE_SHARE" => "N",
        "FILTER_NAME" => "arrFilter",
        "FILTER_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
            2 => "",
            3 => "",
            4 => "",
            5 => "",
        ),
        "IBLOCK_ID" => "19",
        "FILE_404" => "",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array(
            0 => "twitter",
            1 => "lj",
            2 => "mailru",
            3 => "vk",
            4 => "delicious",
            5 => "facebook",
        ),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "PRICE",
            1 => "TELEGRAM",
            2 => "VIBER",
            3 => "WHATSAPP",
            4 => "AUTHOR",
            5 => "DOPPHONE",
            6 => "PHONE",
            7 => "CITY",
        ),
        "TEMPLATE_THEME" => "blue",
        "DETAIL_URL" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MEDIA_PROPERTY" => "",
        "SLIDER_PROPERTY" => "",
        "SEARCH_PAGE" => "/search/"
    ),
    false
);


?>
<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'bx-newsdetail-slider-container',
			leftArrowClassName: 'bx-newsdetail-slider-arrow-container-left',
			rightArrowClassName: 'bx-newsdetail-slider-arrow-container-right',
			controlContainerClassName: 'bx-newsdetail-slider-control'
		});
	});
</script>
