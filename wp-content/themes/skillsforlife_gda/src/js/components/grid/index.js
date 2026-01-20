import { BREAKPOINTS } from "../../app"

const initGridComponent = (component) => {

    const main = () => {
        const imageTarget = component.querySelector('.image-target')
        const colTarget = component.querySelector('.column-target')
        const spacerTarget = component.querySelector('.spacer-target')
        
        if(!imageTarget || !colTarget || !spacerTarget) return
    
        const imageHeight = imageTarget.getBoundingClientRect().height
        const colHeight = colTarget.getBoundingClientRect().height
        
        if(window.innerWidth < BREAKPOINTS.TABLET) {
            spacerTarget.style.height = '30px'
            return
        } 

        const spacerHeight = imageHeight - colHeight
        spacerTarget.style.height = `${spacerHeight}px`
    }
    
    window.addEventListener('resize', main)
    main()
}

export {initGridComponent}