import gsap from "gsap"
import Draggable from "gsap/src/Draggable";
gsap.registerPlugin(Draggable)

var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
  e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
  if (keys[e.keyCode]) {
    preventDefault(e);
    return false;
  }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
  window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
    get: function () { supportsPassive = true; } 
  }));
} catch(e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
  window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
  window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
  window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
  window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
  window.removeEventListener('DOMMouseScroll', preventDefault, false);
  window.removeEventListener(wheelEvent, preventDefault, wheelOpt); 
  window.removeEventListener('touchmove', preventDefault, wheelOpt);
  window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}




const determineNavHeight = () => {
    const headerEl = document.querySelector('header')
    if (!headerEl) return
    document.documentElement.style.setProperty('--nav-height', `${headerEl.getBoundingClientRect().height}px`)
}


const initHeaderNav = () => {
    const headerEl = document.querySelector('header')
    if (!headerEl) return
    const tl = gsap.timeline({
        paused: true
    })
    tl.fromTo(headerEl, {
        yPercent: 0,
        ease: 'none',
        duration: .3
    }, {
        yPercent: -100,
        ease: 'none',
        duration: .3
    })
    let lastScroll = 0
    const checkScroll = () => {
        // if(window.scrollY > 100 || lastScroll < window.scrollY) {
        //     tl.play()
        // } else {
        //     tl.reverse()
        // }
        // lastScroll = window.scrollY
        if (window.scrollY < 100) {
            tl.reverse()
            lastScroll = window.scrollY
            return
        }
        if (lastScroll > window.scrollY) {
            tl.reverse()
            lastScroll = window.scrollY
            return
        }
        tl.play()
        lastScroll = window.scrollY
        return
    }

    window.addEventListener('scroll', checkScroll)
}

const initMobileMenu = () => {
    const mobileMenuEl = document.querySelector('#mobile-menu')
    const hamburgerEl = document.querySelector('header .hamburger')
    gsap.set(mobileMenuEl, {
        x: "-100%"
    })
    // gsap.from(mobileMenuEl, {
    //     x: -100
    // })

    const openHandler = () => {
        gsap.to(mobileMenuEl, {
            // transform: "translateX(-100%)"
            x: "0%"
        })
        // disableScroll()
    }
    const closeHandler = () => {
        gsap.to(mobileMenuEl, {
            // transform: "translateX(0%)"
            x: "-100%"
        })
        // enableScroll()
    }
    hamburgerEl.addEventListener('click', () => {
        openHandler()
    })
    mobileMenuEl.querySelector('.close-button').addEventListener('click', () => {
        closeHandler()
    })

    const createDrag = () => {
        if(mobileMenuEl.draggable) return
        const wrappers = mobileMenuEl.querySelectorAll('.wrapper')
        const wrapperHeight = Array.from(wrappers).map(wrapper => wrapper.clientHeight).reduce((acc, cur) => acc + cur)
        const CLOSE_X = -120
        mobileMenuEl.draggable = Draggable.create(mobileMenuEl, {
            type: 'x',
            bounds: { minX: -window.innerWidth, maxX: 0 },
            inertia: true,
            onDragEnd() {
                if (this.x < CLOSE_X) {
                    closeHandler()
                } else {
                    gsap.to(mobileMenuEl, {
                        x: "0%",
                        duration: 0.25,
                        ease: 'power3.out'
                    })
                }
            }
        })
        return
    }
    // window.addEventListener('resize', createDrag)
    createDrag()

}


export { determineNavHeight, initHeaderNav, initMobileMenu, enableScroll, disableScroll }