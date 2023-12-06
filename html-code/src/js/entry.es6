require("../sass/style.scss");

require("../fonts/fontello/css/fontello.css");

require("./vendor/masonry.pkgd");

import 'swiper/css/bundle';

(function ($) {

    require("./custom/header.es6");

    $(".upload-file-custom").length > 0 && require("./custom/upload-file-custom.es6");
    $(".profile-form").length > 0 && require("./custom/profile-form.es6");
    $(".video-open-trigger").length > 0 && require("./custom/video.es6");
    $(".products-masonry").length > 0 && require("./template-parts/products-section.es6");
    $(".companies-masonry").length > 0 && require("./template-parts/companies-section.es6");
    $(".other-products-section").length > 0 && require("./template-parts/other-products-section.es6");
    $(".single-product-section").length > 0 && require("./template-parts/single-product-section.es6");


})(jQuery);