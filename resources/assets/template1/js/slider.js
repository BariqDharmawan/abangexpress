import Swiper, { Autoplay, Navigation, Pagination } from 'swiper'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/autoplay'

Swiper.use([Navigation, Pagination, Autoplay]);

/**
   * Clients Slider
   */
const heroSlider = new Swiper('.hero-slider', {
    speed: 1000,
    autoplay: {
        delay: 2500,
        disableOnInteraction: true
    }
});

/**
 * Clients Slider
 */
new Swiper('.clients-slider', {
    speed: 400,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        640: {
            slidesPerView: 4,
            spaceBetween: 20
        },
        992: {
            slidesPerView: 6,
            spaceBetween: 20
        }
    }
});

/**
   * Portfolio details slider
   */
new Swiper('.portfolio-details-slider', {
    speed: 400,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    }
});

/**
   * Testimonials slider
   */
new Swiper('.testimonials-slider', {
    speed: 600,
    loop: false,
    centerInsufficientSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 20
        },

        1200: {
            slidesPerView: 3,
            spaceBetween: 20
        }
    }
});
