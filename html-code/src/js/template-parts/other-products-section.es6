import Swiper from 'swiper/bundle';

let other_products_slider = new Swiper(".other-products-slider", {
    slidesPerView: 1,
    loop: true,
    navigation: {
        nextEl: `.other-products-swiper-button-next`,
        prevEl: `.other-products-swiper-button-prev`
    },
    breakpoints: {
        360: {
            slidesPerView: 2,
        },
        780: {
            slidesPerView: 3,
        },
        1366: {
            slidesPerView: 4,
        },
        1920: {
            slidesPerView: 5,
        },
    },
});