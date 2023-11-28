<?php
$neti_favorite_default_option = [
    'addClass' => 'fa fa-heart',
    'removeClass' => 'fa fa-heart-o',
    'mailing' => 'N',
    'log' => 'Y',
    'snippet_1' => '<?$APPLICATION->IncludeComponent("neti:favorite.icon", "favorites", Array(
                        "COMPONENT_TEMPLATE" => ".default",
                            "LINK" => "/novyy-razdel/",	// —сылка на страницу с избранным
                        ),
                        false
                    );?>',
];