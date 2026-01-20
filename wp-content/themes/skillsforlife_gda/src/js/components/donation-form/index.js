import gsap from "gsap"
import Swiper from "swiper"
import { disableScroll, enableScroll } from "../../global"
import Choices from "choices.js"

const initDonationForm = (component) => {
    
    const formComponent = document.querySelector('#donation-form')
    const overlay = document.querySelector('#donation-overlay')
    const outerWrapper = formComponent.querySelector('.outer-wrapper')

    const focusableSelectors = `
    a[href],
    button,
    input,
    textarea,
    select,
    [tabindex]:not([tabindex="-1"])
    `

    const swiperEl = formComponent.querySelector('.swiper')
    
    const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        allowTouchMove: false,
    })

    gsap.set(formComponent, {
        visibility: 'hidden'
    })
    gsap.set(outerWrapper, {
        xPercent: -100
    })
    gsap.set(overlay, {
        autoAlpha: 0
    })

    const openHandler = () => {
        disableScroll()
        gsap.to(formComponent, {
            visibility: 'visible'
        })
        gsap.to(outerWrapper, {
            xPercent: 0
        })
        gsap.to(overlay, {
            autoAlpha: 1
        })
        formComponent.hidden = false
        const focusables = formComponent.querySelectorAll(focusableSelectors)
        focusables[0]?.focus()
        console.log(focusables[0])
    }

    const closeHandler = () => {
        enableScroll()
        gsap.to(formComponent, {
            visibility: 'hidden'
        })
        gsap.to(outerWrapper, {
            xPercent: -100
        })
        gsap.to(overlay, {
            autoAlpha: 0
        })
        formComponent.hidden = true
    }

    const triggerForm = document.querySelectorAll('.trigger-donation-form')
    triggerForm.forEach(component => {
        component.addEventListener('click', () => {
            openHandler()
        })
    })

    overlay.addEventListener('click', () => {
        closeHandler()
    })
    window.addEventListener('keydown', (e) => {
        if(e.key === 'Escape' && !formComponent.hidden) {
            closeHandler()
        }
    })



    formComponent.addEventListener('keydown', (e) => {
        if (e.key !== 'Tab') return

        const focusables = formComponent.querySelectorAll(focusableSelectors)
        const first = focusables[0]
        const last = focusables[focusables.length - 1]
        console.log()

        if (e.shiftKey && document.activeElement === first) {
            e.preventDefault()
            last.focus()
        }

        if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault()
            first.focus()
        }
    })

    initValidationStep(formComponent, swiper)
    initAmountForm(formComponent)
    initPeriodForm(formComponent)
    initTitleForm(formComponent)
    initTypeForm(formComponent)
}


const initValidationStep = (formComponent, swiper) => {

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

    const prevButton = formComponent.querySelector('.prev-button')
    prevButton.addEventListener('click', () => {
        swiper.slidePrev()
        prevButton.style.opacity = '0'
        prevButton.style.pointerEvents = 'none'
    })

    const nextButton = formComponent.querySelector('.next-button')
    nextButton.addEventListener('click', () => {
        if(validationStep(swiper.activeIndex)) {
            swiper.slides[swiper.activeIndex + 1].querySelectorAll('input, select').forEach(el => {
                if(el.nodeName == 'SELECT') {
                    el.choices.enable()
                }
                el.disabled = false
            })
            swiper.slideNext()
            prevButton.style.opacity = '1'
            prevButton.style.pointerEvents = 'all'
        }
    })
}


const initAmountForm = (formComponent) => {
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
        selection.addEventListener("focus", () => {
            resetActive()
            selection.classList.add('active')
            input.value = selection.dataset.amount
            manualInput.value=selection.dataset.amount
        })
    })
    manualInput.addEventListener('change', () => {
        resetActive()
        input.value = manualInput.value 
        manualInput.value = (manualInput.value).toLocaleString('id-ID')
    })
}

const initPeriodForm = (formComponent) => {
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

const initTitleForm = (formComponent) => {
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
    const inputTitle = formComponent.querySelector('#input-title')
    inputTitle.choices = new Choices(inputTitle, {
        choices,
        searchEnabled: false,
        itemSelectText: "",
    })
}

const initTypeForm = (formComponent) => {
    const typeSelects = formComponent.querySelectorAll('.type-select')
    const resetActive = () => {
        typeSelects.forEach(el => {
            el.classList.remove('active')
        })
    }
    const orgsWrapper = formComponent.querySelector('.organization-wrapper')
    gsap.set(orgsWrapper, {
        autoAlpha: 0
    })
    typeSelects.forEach(select => {
        select.addEventListener('click', () => {
            resetActive()
            select.classList.add('active')
            const data = select.dataset.type
            if(data == 'organization') {
                gsap.set(orgsWrapper, {
                    autoAlpha: 1
                })
            }
            if(data == 'individual') {
                gsap.set(orgsWrapper, {
                    autoAlpha: 0
                })
            }

        })
    })
}

export {initDonationForm}