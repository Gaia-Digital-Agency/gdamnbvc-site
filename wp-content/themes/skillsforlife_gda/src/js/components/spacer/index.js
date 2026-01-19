import { BREAKPOINTS } from "../../app"

const convertValues = {
    "180": "60",
    "150": "60",
    "100": "60",
    "50": "30"
}

const initSpacer = (component) => {
    const main = () => {
        console.log(component.classList.contains('converted'))
        if(window.innerWidth < BREAKPOINTS.TABLET) {
            if(component.classList.contains('converted')) return
            
            const shouldConvert = parseInt(component.style.height)
            console.log(shouldConvert)
            if(convertValues[`${shouldConvert}`]) {
                component.style.height = `${convertValues[`${shouldConvert}`]}px`
                component.style.setProperty('--original-height', shouldConvert)
                component.classList.add('converted')
            }
        } else {
            if(!component.classList.contains('converted')) return
            component.classList.remove('converted')
            component.style.height = `${component.style.getPropertyValue('--original-height')}px`
        }
    }

    window.addEventListener("resize", main)
    main()
}

export {initSpacer}