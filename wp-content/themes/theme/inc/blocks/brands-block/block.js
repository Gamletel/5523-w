jQuery(document).ready(function ($) {

    const swiperbrands = new Swiper('#brands-block .swiper', {
        // Default parameters
        slidesPerView: 4,
        spaceBetween: 0,
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
            prevEl: "#brands-block .swiper-btn-prev",
            nextEl: "#brands-block .swiper-btn-next",
        }
    })

});