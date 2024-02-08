require("../sass/style.scss");

require("../fonts/fontello/css/fontello.css");

require("./vendor/masonry.pkgd");
require("./vendor/jquery.dad");
require("./vendor/select2");
require("./vendor/jquery.swipebox");

import 'swiper/css/bundle';

(function ($) {

    require("./custom/header.es6");
    require("./custom/forms.es6");
    require("./custom/lightbox.es6");
    require("./custom/collapsed-content.es6");

    $(".upload-file-custom").length > 0 && require("./custom/upload-file-custom.es6");
    $(".video-open-trigger, .youtube-open-trigger").length > 0 && require("./custom/video.es6");
    $(".advertisement-slider").length > 0 && require("./custom/advertisement-slider.es6");
    $(".products-masonry").length > 0 && require("./template-parts/products-section.es6");
    $(".companies-masonry").length > 0 && require("./template-parts/companies-section.es6");
    $(".communities-masonry").length > 0 && require("./template-parts/community-overview-section.es6");
    $(".other-products-section").length > 0 && require("./template-parts/other-products-section.es6");
    $(".single-product-section").length > 0 && require("./template-parts/single-product-section.es6");
    $(".add-product-section").length > 0 && require("./template-parts/add-product-section.es6");
    $(".blog-overview-section").length > 0 && require("./template-parts/blog-overview-section.es6");
    $(".photo-gallery-section").length > 0 && require("./template-parts/photo-gallery-section.es6");


})(jQuery);