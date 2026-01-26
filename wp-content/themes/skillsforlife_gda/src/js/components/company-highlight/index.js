import gsap from "gsap"
import { ScrollTrigger } from "gsap/ScrollTrigger"
gsap.registerPlugin(ScrollTrigger)
const initCompanyHighlight = (element, editor = false) => {
    const contentEls = element.querySelector('.slides-wrapper')
    const contentItems = contentEls.querySelectorAll('.slides-item')
    const duration = [
        .32,
        1.2,
        .76
    ]
    const yPercent = [
        [-35, 100],
        [35, 100],
        [35, -100]
    ]
    contentItems.forEach((item, i) => {
        const images = item.querySelectorAll('.image-item-wrapper')
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: item,
                start: "top bottom",
                end: "bottom center",
                scrub: true,
                once: true,
            }
        })
        images.forEach((image, k) => {
            const inner = image.querySelector('.inner')
            const img = image.querySelector('img')
            const dur = Math.random() * (1.7 - 1) + 1;
            const del = Math.random() * (0.2 - 0.5) + 0.5;
            if(editor) {
                gsap.set(inner, {
                    yPercent: 0,
                    duration: dur,
                    delay: del,
                    ease: 'power1.out'
                })
                gsap.set(img, {
                    yPercent: 0,
                    duration: dur,
                    delay: del,
                    ease: 'power1.out'
                })
            } else {
                gsap.set(inner, {
                    yPercent: -35,
                    willChange: 'transform'
                })
                gsap.set(img, {
                    yPercent: 100,
                    willChange: 'transform'
                })
                tl.to(inner, {
                    yPercent: 0,
                    duration: dur,
                    delay: del,
                    ease: 'power1.out'
                }, 0)
                tl.to(img, {
                    yPercent: 0,
                    duration: dur,
                    delay: del,
                    ease: 'power1.out'
                }, 0)
            }
        })
    })

}

export {initCompanyHighlight}