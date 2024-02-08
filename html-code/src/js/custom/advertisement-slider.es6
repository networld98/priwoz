import Swiper from 'swiper/bundle';

let advertisement_slider = new Swiper(".advertisement-slider", {
    slidesPerView: 1,
    loop: true,
    navigation: false,
    dots: false,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: false,
    },
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    allowTouchMove: false
});