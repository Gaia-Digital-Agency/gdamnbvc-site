import Swiper from "swiper"
import { Pagination, EffectCreative } from "swiper/modules"

const initIndonesiaSlider = (component) => {

    const swiperEl = component.querySelector('.swiper')
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        modules: [Pagination, EffectCreative],
        effect: "creative",
        creativeEffect: {
            prev: {
                translate: ["-110%", "-100%", 0]
            },
            next: {
                translate: ["110%", "-100%", 0]
            }
        },
        pagination: {
            el: component.querySelector('.swiper-pagination'),
            clickable: true
        }
    })

}

export {initIndonesiaSlider}