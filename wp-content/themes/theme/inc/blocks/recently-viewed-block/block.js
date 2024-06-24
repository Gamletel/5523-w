jQuery(document).ready(function ($) {

    const swiperRecentlyViewed = new Swiper('#recently-viewed-block .swiper', {
        // Default parameters
        slidesPerView: 4,
        spaceBetween: 30,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            769: {
                slidesPerView: 3,
            },
            1240: {
                slidesPerView: 4,
            },
        },
        navigation: {
            prevEl: "#recently-viewed-block .swiper-btn-prev",
            nextEl: "#recently-viewed-block .swiper-btn-next",
        }
    })

});