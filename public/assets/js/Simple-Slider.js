document.addEventListener("DOMContentLoaded", function() {

    // Initializing the swiper plugin for the slider.
    // Read more here: http://idangero.us/swiper/api/
    
    var mySwiper = new Swiper('.swiper', {
        loop: true,
        speed: 1500,
        spaceBetween: 20,
        autoplay: {
            delay: 5000,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
        },
        autoHeight: true,
        pagination: {
            el: '.swiper-pagination',
        },
    });
});