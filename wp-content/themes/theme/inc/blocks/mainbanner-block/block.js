jQuery(document).ready(function($){

    const swiperMainbanner = new Swiper('#mainbanner-block .swiper', {
        // Default parameters
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
        },
        speed: 2000,
        pagination: {
            el: '#mainbanner-block .swiper-pagination',
            type: 'bullets',
        },
    })

});