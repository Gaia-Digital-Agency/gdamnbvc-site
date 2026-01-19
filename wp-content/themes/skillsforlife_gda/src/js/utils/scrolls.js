import gsap from "gsap"
import { ScrollSmoother } from "gsap/ScrollSmoother"
import ScrollTrigger from "gsap/ScrollTrigger"

gsap.registerPlugin(ScrollSmoother, ScrollTrigger)

const disableScroll = () => {
    if(!window.scrollSmoother) return false
    window.scrollSmoother.paused(true)
}

const enableScroll = () => {
    if(!window.scrollSmoother) return false
    window.scrollSmoother.paused(false)
}

const initScroll = () => {
    const mm = gsap.matchMedia()
    window.scrollSmoother = false
    mm.add('(min-width: 1024px)', () => {
        window.scrollSmoother = ScrollSmoother.create({
            smooth: 1,
            // speed: 1.2,
            effects: true,
            // normalizeScroll: true,
            wrapper: "#smooth-wrapper",
            content: "#smooth-content",
        })
    })
    mm.add('(max-width: 1023px)', () => {
        if (window.scrollSmoother) {
            window.scrollSmoother.kill()
        }
        window.scrollSmoother = false
    })
    gsap.ticker.add((time) => {
        // console.log(time)
    })
    return window.scrollSmoother
}

export {disableScroll, enableScroll, initScroll}