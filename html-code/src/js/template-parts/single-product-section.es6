import Swiper from 'swiper/bundle';

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

// main_slider.on('slideChangeTransitionStart', function() {
//     thumbnails_slider.slideTo(main_slider.activeIndex);
// });
//
// thumbnails_slider.on('transitionStart', function(){
//     thumbnails_slider.slideTo(thumbnails_slider.activeIndex);
// });