import Swiper from "swiper"
import { EffectCards, EffectFade } from "swiper/modules"

const initNavigationStackSlider = (component, editor = false) => {

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
        }
    })

    const navigationWrapper = component.querySelector('.navigation-wrapper')
    const navigations = navigationWrapper.querySelectorAll('.navigation-button')

    const resetNavs = () => {
        navigations.forEach(nav => {
            
            nav.classList.remove('active')
        })
    }

    imageSwiper.on('slideChange', swiper => {
        textSwiper.slideTo(swiper.activeIndex)
        resetNavs()
        navigationWrapper.querySelector(`[data-index="${swiper.activeIndex}"]`).classList.add('active')
    })

    navigations.forEach(nav => {
        const index = parseInt(nav.dataset.index)
        nav.addEventListener('click', () => {
            if(index == imageSwiper.activeIndex) return;
            resetNavs()
            nav.classList.add('active')
            imageSwiper.slideTo(index)
            // textSwiper.slideTo(index)
        })
    })

}

export {initNavigationStackSlider}