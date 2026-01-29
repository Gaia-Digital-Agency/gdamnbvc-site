import Swiper from "swiper"
import { EffectCards, EffectFade } from "swiper/modules"

const initMoreStackSlider = (component, editor = false) => {

    const imageSwiperEl = component.querySelector('.image-slider')
    const imageSwiper = new Swiper(imageSwiperEl, {
        slidesPerView: 1,
        modules: [EffectCards],
        effect: 'cards',
        grabCursor: true,
        // allowTouchMove: false
    })

    const textSwiperEl = component.querySelector('.text-slider')
    const textSwiper = new Swiper(textSwiperEl, {
        slidesPerView: 1,
        modules: [EffectFade],
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    })

    imageSwiper.on('slideChange', swiper => {
        textSwiper.slideTo(swiper.activeIndex)
        // resetNavs()
        // navigationWrapper.querySelector(`[data-index="${swiper.activeIndex}"]`).classList.add('active')
    })

    const nav = component.querySelector('.navigation-next')
    nav.addEventListener('click', () => {
        if((imageSwiper.activeIndex + 1) >= imageSwiper.slides.length) {
            imageSwiper.slideTo(0)
        } else {
            imageSwiper.slideNext()
        }
        // textSwiper.slideTo(index)
    })

}

export {initMoreStackSlider}