import gsap from "gsap"
import Swiper from "swiper";
import Choices from "choices.js";

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
    const tl = gsap.timeline({ paused: true })
    gsap.set(mobileMenuEl, {
        xPercent: -100
    })
    // tl.fromTo(mobileMenuEl, {
    //     xPercent: -100
    // }, {
    //     xPercent: 0
    // })
    hamburgerEl.addEventListener('click', () => {
        gsap.to(mobileMenuEl, {
            // transform: "translateX(-100%)"
            xPercent: 0
        })
        disableScroll()
    })
    mobileMenuEl.querySelector('.close-button').addEventListener('click', () => {
        gsap.to(mobileMenuEl, {
            // transform: "translateX(0%)"
            xPercent: -100
        })
        enableScroll()
    })
}

const triggerDonationForm = () => {

}


const initDonationForm = () => {

    const formComponent = document.querySelector('#donation-form')
    const overlay = formComponent.querySelector('.overlay')
    const outerWrapper = formComponent.querySelector('.outer-wrapper')

    const triggerForm = document.querySelectorAll('.trigger-donation-form')
    gsap.set(formComponent, {
        visibility: 'hidden'
    })
    gsap.set(outerWrapper, {
        xPercent: -100
    })
    gsap.set(overlay, {
        autoAlpha: 0
    })
    triggerForm.forEach(component => {
        component.addEventListener('click', () => {
            gsap.to(formComponent, {
                visibility: 'visible'
            })
            gsap.to(outerWrapper, {
                xPercent: 0
            })
            gsap.to(overlay, {
                autoAlpha: 1
            })
        })
    })
    const swiperEl = formComponent.querySelector('.swiper')
    const choices = [
        {
            value: "mr",
            label: "Mr"
        },
        {
            value: "mrs",
            label: "Mrs"
        },
        {
            value: "miss",
            label: "Miss"
        },
        {
            value: "ms",
            label: "Ms"
        },
    ]
    new Choices(formComponent.querySelector('#input-title'), {
        choices,
        searchEnabled: false,
        itemSelectText: "",
    })
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        allowTouchMove: false,
    })

    const steps = [
        [
            {
                name: "amount",
                validation: (value) => {
                    return parseInt(value) != NaN &&  value > 10000
                },
            },
            {
                name: "period",
                validation: (value) => {
                    return (value == 'once') || (value == 'monthly') || (value == 'yearly')
                }
            }
        ],
        [
            {
                name: 'type',
                validation: value => {
                    return value == 'individual' || value == 'organization'
                }
            },
            {
                
            }
        ]
    ]

    const validationStep = (step) => {
        let count = 0
        swiper.slides[step].querySelectorAll('input[type="hidden"].mandatory').forEach(el => {
            steps[0].filter(validating => {
                if(el.name == validating.name && validating.validation(el.value)) {
                    count = count + 1;
                } else {

                }
            })
        })
        return count >= steps[step].length
    }


    const amountSelection = () => {
        const selections = formComponent.querySelectorAll('.amount-wrapper .amount-select')
        const resetActive = () => {
            selections.forEach(selection => {
                selection.classList.remove('active')
            })
        }
        const input = formComponent.querySelector('#input-amount')
        const manualInput = formComponent.querySelector('#manual-input')
        selections.forEach(selection => {
            selection.addEventListener("click", () => {
                resetActive()
                selection.classList.add('active')
                input.value = selection.dataset.amount
                manualInput.value=selection.dataset.amount
            })
        })
        manualInput.addEventListener('change', () => {
            resetActive()
            input.value = manualInput.value 
        })
    }

    const periodSelection = () => {
        const resetActive = () => {
            selections.forEach(selection => {
                selection.classList.remove('active')
            })
        }
        const input = formComponent.querySelector('#input-period')
        const selections = formComponent.querySelectorAll('.period-select')
        selections.forEach(selection => {
            selection.addEventListener('click', () => {
                resetActive()
                selection.classList.add('active')

                input.value = selection.dataset.period
            })
        })
    }


    

    amountSelection()
    periodSelection()
    const nextButton = formComponent.querySelector('.next-button')
    nextButton.addEventListener('click', () => {
        console.log(validationStep(swiper.activeIndex))
        if(validationStep(swiper.activeIndex)) {
            swiper.slideNext()
        }
    })


}


export { determineNavHeight, initHeaderNav, initMobileMenu, initDonationForm }