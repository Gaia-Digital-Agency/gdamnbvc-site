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
        autoHeight: true,
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
    formComponent.querySelector('.close-icon').addEventListener('click', () => {
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

    const validationGenerator = (
        name, 
        validation, 
        errorHandler = () => {}, 
        resetError = () => {}
    ) => {
        return {
            name,
            validation,
            errorHandler,
            resetError
        }
    }

    const steps = [
        [
            validationGenerator(
                'amount', 
                (value) => {
                    return parseInt(value) != NaN &&  value >= 10000
                },
                (form) => {
                    form.querySelector('#error-amount').style.display = 'block'
                },
                (form) => {
                    form.querySelector('#error-amount').style.display = 'none'
                }
            ),
            validationGenerator(
                'period',
                (value) => {
                    return (value == 'once') || (value == 'monthly') || (value == 'yearly')
                }
            )
        ],
        [
            validationGenerator(
                'type',
                value => {
                    return value == 'individual' || value == 'organization'
                }
            ),
            validationGenerator(
                'first-name',
                value => {
                    return !!value
                },
                form => {
                    form.querySelector('#error-first-name').style.display = 'block'
                },
                form => {
                    form.querySelector('#error-first-name').style.display = 'none'
                }
            ),
            validationGenerator(
                'last-name',
                value => {
                    return !!value
                },
                form => {
                    form.querySelector('#error-last-name').style.display = 'block'
                },
                form => {
                    form.querySelector('#error-last-name').style.display = 'none'
                }
            ),
            validationGenerator(
                'email',
                value => {
                    const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    return pattern.test(value)
                },
                form => {
                    form.querySelector('#error-email').style.display = 'block'
                },
                form => {
                    form.querySelector('#error-email').style.display = 'none'
                }
            ),
            validationGenerator(
                'mobile-number',
                value => {
                    return !!value
                },
                form => {
                    form.querySelector('#error-mobile-number').style.display = 'block'
                },
                form => {
                    form.querySelector('#error-mobile-number').style.display = 'none'
                }
            ),
        ]
    ]

    const validationStep = (step) => {
        let count = 0
        swiper.slides[step].querySelectorAll('.mandatory').forEach(el => {
            steps[step].filter(validating => {
                if(el.name == validating.name) {
                    if(validating.validation(el.value)) {
                        count = count + 1;
                        validating.resetError(formComponent)
                    } else {
                        validating.errorHandler(formComponent)
                    }
                }
            })
        })
        return count >= steps[step].length
    }

    const prevButton = formComponent.querySelector('.prev-button')
    prevButton.addEventListener('click', () => {
        if(swiper.slides[swiper.activeIndex - 1]) {
            swiper.slidePrev()
            if(swiper.slides[swiper.activeIndex - 1]) {
                prevButton.style.opacity = '0'
                prevButton.style.pointerEvents = 'none'
            }
        }
    })

    const nextButton = formComponent.querySelector('.next-button')
    nextButton.addEventListener('click', async () => {
        if(validationStep(swiper.activeIndex)) {
            if(swiper.slides[swiper.activeIndex + 2]) {
                swiper.slides[swiper.activeIndex + 1].querySelectorAll('input, select').forEach(el => {
                    if(el.nodeName == 'SELECT') {
                        el.choices.enable()
                    }
                    el.disabled = false
                })
                swiper.slideNext()
                prevButton.style.opacity = '1'
                prevButton.style.pointerEvents = 'all'
            } else {
                const submitter = await formComponent.querySelector('form').submitter()
                console.log(submitter)
                if(submitter && submitter.payment_link_url) {
                    const iframe = document.createElement('iframe')
                    const paymentLink = submitter.payment_link_url
                    iframe.src = paymentLink
                    formComponent.querySelector('#iframe-wrapper').append(iframe)
                    swiper.slideNext()
                }
            }
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
    const manualInputHandler = () => {
        const raw = manualInput.value.replace(/\D/g, '')
        if (!raw) {
            manualInput.value = ''
            return
        }

        manualInput.value = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.')
    }

    manualInput.addEventListener('input', manualInputHandler)
    const changeHandler = (selection) => {
        console.log(selection.classList.contains('disabled'))
        if(selection.classList.contains('disabled')) return;
        resetActive()
        selection.classList.add('active')
        input.value = selection.dataset.amount
        manualInput.value=selection.dataset.amount
        manualInputHandler()
    }
    selections.forEach(selection => {
        selection.addEventListener("click", () => {
            changeHandler(selection)
        })
        selection.addEventListener("focus", () => {
            changeHandler(selection)
        })
    })
    manualInput.addEventListener('change', () => {
        resetActive()
        input.value = manualInput.value.replace(/\./g, '')
        manualInput.value = (manualInput.value).toLocaleString('id-ID')
    })
}

const initPeriodForm = (formComponent) => {
    const resetActive = () => {
        selections.forEach(selection => {
            selection.classList.remove('active')
        })
    }
    const changeHandler = (selection) => {
        if(selection.classList.contains('disabled')) return;
        resetActive()
        selection.classList.add('active')

        input.value = selection.dataset.period
    }
    const input = formComponent.querySelector('#input-period')
    const selections = formComponent.querySelectorAll('.period-select')
    selections.forEach(selection => {
        selection.addEventListener('click', () => {
          changeHandler(selection)  
        })
        selection.addEventListener('focus', () => {
          changeHandler(selection)  
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