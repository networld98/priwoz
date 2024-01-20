import Swiper from 'swiper/bundle';

let reportOpener = $('.report-popup-opener');
let reportPopup = $('.report-popup');
let reportPopupOverlay = $('.report-popup .modal-overlay');
let reportRadioPopup = $('.report-popup .form-check-input');

reportOpener.on('click', function (e) {
    e.preventDefault();

    if (reportPopup.length > 0) {
        reportPopup.addClass('-open');
        $('body').addClass('-overflow-hidden');
    }
});

reportPopupOverlay.on('click', function (e) {
    if (e.target !== this) return;

    reportPopup.removeClass('-open');
    $('body').removeClass('-overflow-hidden');
});

reportRadioPopup.change(function(){

    if ($(this).data('value') === 'other') {
        $('.other-reason-textarea').slideDown();
    } else {
        $('.other-reason-textarea').slideUp();
    }
});

let thumbnails_slider = new Swiper(".thumbnails-slider", {
    slidesPerView: 5,
    loop: false,
    direction: "horizontal",
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    spaceBetween: 12,
    breakpoints: {
        360: {
            slidesPerView: 6,
            direction: "horizontal",
            spaceBetween: 9,
        },
        780: {
            slidesPerView: 5.46,
            direction: "vertical",
            spaceBetween: 8,
        },
        1366: {
            slidesPerView: 6.68,
            direction: "vertical",
            spaceBetween: 12,
        },
        1920: {
            slidesPerView: 9.5,
            direction: "vertical",
            spaceBetween: 12,
        },
    },
});
let main_slider = new Swiper(".big-image-slider", {
    slidesPerView: 1,
    loop: false,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: true,
        pauseOnMouseEnter: true,
    },
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    thumbs: {
        swiper: thumbnails_slider,
    },
});

