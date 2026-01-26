import Swiper from "swiper"
import { HashNavigation } from "swiper/modules"
import Choices from "choices.js"
import gsap from "gsap"
const initTabContent = (component) => {

    const filter = component.querySelector('.filter-wrapper')
    const swiperEl = component.querySelector('.swiper')
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        allowTouchMove: false,
        modules: [HashNavigation],
        hashNavigation: true,
        // modules: [EffectFade],
        // effect: "fade",
        // fadeEffect: {
        //     crossFade: true
        // }
        init: false,
        spaceBetween: 20,
        autoHeight: true,
        observer: true,
        // observeParents: true,
        observeSlideChildren: true
        // init: (_swiper) => {
        //     if(!filter) return
        //     _swiper.activeIndex
        // }
    })

    const buttons = component.querySelectorAll('.tabs-button-wrapper .tabs-button')

    const resetButtons = () => {
        buttons.forEach(button => {
            button.classList.remove('active')
        })
    }

    const swiperIniting = (_swiper) => {
        [
            initFilter, 
            initHeightFix,
            initHashing
        ].forEach(cb => cb(_swiper))
    }

    const initHashing = () => {
        const selectedTabs = component.querySelector(`.tabs-button-wrapper [data-hash="${window.location.hash.replace('#', '')}"]`)
        if(selectedTabs) {
            resetButtons()
            selectedTabs.classList.add('active')
            // console.log()
            window.addEventListener('load', () => {
                window.scrollTo(0, Math.max((selectedTabs.getBoundingClientRect().top), 0))
            })
        }
    }

    const initHeightFix = () => {
        const main = () => {
            swiper.wrapperEl.style.height = 'auto'
        }

        window.addEventListener('resize', main)
        window.addEventListener('load', main)
        main()
    }

    const initFilter = (_swiper) => {

        if(!filter) return
        const currSlide = _swiper.slides[_swiper.activeIndex]
        const galleryFull = currSlide.querySelector('.block-gallery-full')
        if(!galleryFull) {
            filter.classList.add('hidden')
            return
        }
        filter.classList.remove('hidden')
        const choices = () => {
            const res = [{value: "all", label: "All"}]
            if(galleryFull.querySelector('.image-gallery')) {
                const label = galleryFull.querySelector('.image-gallery.multi') ? 'Pictures' : 'Picture'
                res.push({
                    value: 'picture',
                    label: label
                })
            }
            if(galleryFull.querySelector('.video-gallery')) {
                const label = galleryFull.querySelector('.video-gallery.multi') ? 'Videos' : 'Video'
                res.push({
                    value: 'video',
                    label: label
                })
            }
            return res
        }
        const choice = new Choices(filter.querySelector('select'), {
            choices: choices(),
            searchEnabled: false,
            itemSelectText: "",
        })
        // choice.refresh()
        filter.querySelector('select').addEventListener('change', (e) => {
            if(e.target.value == 'picture') {
                swiper.el.querySelectorAll('.image-gallery').forEach(ele => {ele.classList.remove('hidden')})
                swiper.el.querySelectorAll('.video-gallery').forEach(ele => {ele.classList.add('hidden')})
            }
            if(e.target.value == 'video') {
                swiper.el.querySelectorAll('.video-gallery').forEach(ele => {ele.classList.remove('hidden')})
                swiper.el.querySelectorAll('.image-gallery').forEach(ele => {ele.classList.add('hidden')})
            }
            if(e.target.value == 'all') {
                swiper.el.querySelectorAll('.video-gallery').forEach(ele => {ele.classList.remove('hidden')})
                swiper.el.querySelectorAll('.image-gallery').forEach(ele => {ele.classList.remove('hidden')})
            }
            // swiper.el.querySelectorAll('')
        })
    }

    swiper.on('init', swiperIniting)
    swiper.init()

    buttons.forEach(button => {
        const index = parseInt(button.dataset.index)
        button.addEventListener('click', () => {
            if(swiper.activeIndex == index) return
            resetButtons()
            button.classList.add('active')
            swiper.slideTo(index)
        })
    })

    swiper.on('slideChange', initFilter)

}

export {initTabContent}