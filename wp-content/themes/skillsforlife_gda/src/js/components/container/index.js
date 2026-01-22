import { BREAKPOINTS } from "../../app"
const initContainer = (component) => {
    const initGap = () => {
        const container = component.querySelector('.grid')
        const gapAmount = component.dataset.gap
        if(BREAKPOINTS.TABLET < window.innerWidth) {
            // container.style.columnGap = gapAmount
            // container.style.rowGap = gapAmount
            container.style.setProperty('column-gap', gapAmount)
            container.style.setProperty('row-gap', gapAmount)
        } else {
            // container.style.rowGap = gapAmount
            // container.style.columnGap = '0px'
            container.style.setProperty('row-gap', gapAmount)
            container.style.setProperty('column-gap', '0px')
        }
    }

    window.addEventListener('resize', initGap)
    initGap()

}

export {initContainer}