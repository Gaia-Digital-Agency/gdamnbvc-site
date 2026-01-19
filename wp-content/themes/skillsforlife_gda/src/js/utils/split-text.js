import gsap from "gsap"
import SplitText from "gsap/SplitText"
import ScrollTrigger from "gsap/ScrollTrigger"
gsap.registerPlugin(SplitText, ScrollTrigger)

const initSplitText = (el) => {
    if(el.closest('.block-header')) return
    const resetSplit = (self) => {
        // self.elements[0].querySelectorAll('br').forEach(el => {
        //     el.style.display = 'block'
        // })
    }

    const afterSplitHandler = (self) => {
        const tl = gsap.timeline({
            paused: true,
            scrollTrigger: {
                trigger: el,
                start: 'top bottom-=20%',
                once: false,
            }
        })
        self.lines.forEach((line, i) => {
            tl.fromTo(line, {
                translateY: '100%'
            }, {
                translateY: '0',
                duration: .4,
                ease: 'power1'
            }, "-=50%")
        })
    }

    
    document.fonts.ready.then(() => {
        const split = SplitText.create(el, {
            type: "lines",
            linesClass: 'lines',
            autoSplit: true,
            mask: 'lines',
            onSplit: afterSplitHandler,
            onRevert: resetSplit,
        })
    });

}

export {initSplitText}