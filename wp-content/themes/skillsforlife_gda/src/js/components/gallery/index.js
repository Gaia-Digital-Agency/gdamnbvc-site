import Swiper from "swiper"
import { Navigation, Pagination } from "swiper/modules"
import GLightbox from "glightbox"

const initGallery = (component) => {
    const lightbox = new GLightbox({
        selector: '[data-glightbox]',
        draggable: true
    })
    console.log(lightbox)
    const swiperEl = component.querySelector('.swiper')
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        modules: [Navigation, Pagination],
        navigation: {
            enabled: false
        },
        pagination: {
            enabled: true,
            el: component.querySelector('.swiper-pagination'),
            clickable: true,
        },
        preventClicks: true,
        preventClicksPropagation: true,
        breakpoints: {
            1024: {
                pagination: {
                    clickable: false,
                    enabled: false
                },
                navigation: {
                    enabled: true,
                    nextEl: component.querySelector('.next-button'),
                    prevEl: component.querySelector('.prev-button'),
                },
                spaceBetween: 50,
                slidesPerView: 2
            }
        }
    })

}

export {initGallery}