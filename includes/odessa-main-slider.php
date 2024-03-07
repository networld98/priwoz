<?
$file = $_SERVER["DOCUMENT_ROOT"] . '/includes/odessa-slider/text.txt';
$src = fopen($file, 'r');
if (!$src) die('File read error');
while (($data = fgetcsv($src, 0, "\t")) !== FALSE) {
    if ($data[0] != NULL) {
        $textArray[] = $data[0];
    }
} ?>
<div class="swiper-wrapper">
    <? for ($i = 0; $i < 10; $i++) {
        $random_text_number = rand(0, count((array)$textArray)-1);
        $random_image_number = rand(1, count((array)$textArray)-1);
        $url = 'https://priwoz.info'.SITE_DIR.'includes/odessa-slider/'.$random_image_number.'.jpg';
        $file_content = @file_get_contents($url);
        if ($file_content === FALSE) {
            $random_image_number = 1;
        }
        if($i==0){
            $src = 'src';
        }else{
            $src = 'data-src';
        }
        ?>
        <div class="swiper-slide">
            <div class="advertisement advertisement-type-1">
                <a class="box">
                    <img class="bg-img d-sm-none d-md-block lazyload" <?=$src?>="<?=SITE_DIR?>includes/odessa-slider/<?= $random_image_number ?>.jpg"
                         alt="odessa-slider-<?= $i ?>">
                    <img class="bg-img d-none d-sm-block d-md-none lazyload"
                        <?=$src?>="<?=SITE_DIR?>includes/odessa-slider/<?= $random_image_number ?>-sm.jpg" alt="odessa-slider-<?= $i ?>">
                    <?= $textArray[$random_text_number] ?>
                </a>
            </div>
        </div>
    <?} ?>
</div>