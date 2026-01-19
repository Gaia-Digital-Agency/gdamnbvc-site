import Swiper from "swiper"
import { Navigation, Pagination } from "swiper/modules"

const initImageTextSlider = (component) => {

    const swiperEl = component.querySelector('.swiper')
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        modules: [Navigation, Pagination],
        navigation: {
            nextEl: swiperEl.querySelector('.next-button'),
            prevEl: swiperEl.querySelector('.prev-button')
        },
        pagination: {
            enabled: true,
            el: swiperEl.querySelector('.swiper-pagination'),
            clickable: true
        },
        breakpoints: {
            1024: {
                slidesPerView: 1.5,
                pagination: {
                    enabled: false
                }
            }
        }
    }) 

}

export {initImageTextSlider}