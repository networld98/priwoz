require("../sass/style.scss");

require("../fonts/fontello/css/fontello.css");

require("./vendor/masonry.pkgd");


(function ($) {

    require("./custom/header.es6");

    $(".products-section").length > 0 && require("./template-parts/products-section.es6");
    $(".companies-section").length > 0 && require("./template-parts/companies-section.es6");


})(jQuery);