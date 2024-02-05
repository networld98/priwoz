import Swiper from 'swiper/bundle';

let photo_gallery_slider = new Swiper(".photo-gallery-slider", {
    slidesPerView: 'auto',
    loop: false,
    navigation: {
        nextEl: `.photo-gallery-swiper-button-next`,
        prevEl: `.photo-gallery-swiper-button-prev`
    },
});