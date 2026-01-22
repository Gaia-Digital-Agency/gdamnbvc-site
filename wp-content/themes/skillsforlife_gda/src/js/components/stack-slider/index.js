import Swiper from "swiper"
import {EffectCards} from "swiper/modules"

const initStackSlider = (component) => {
    const swiperEl = component.querySelector('.swiper')
    const swiper = new Swiper(swiperEl, {
        modules: [EffectCards],
        effect: "cards",
        grabCursor: true,
        // allowSlideNext: false
    })
}

export {initStackSlider}