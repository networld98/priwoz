require("../sass/style.scss");

require("../fonts/fontello/css/fontello.css");



(function ($) {

    require("./custom/header.es6");

    $(".hero").length > 0 && require("./template-parts/hero.es6");


})(jQuery);