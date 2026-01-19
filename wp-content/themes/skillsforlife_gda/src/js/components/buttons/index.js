import { BREAKPOINTS } from "../../app"

const initButtons = (component) => {
    const init = () => {
        const buttons = component.querySelectorAll('.button-item')
        buttons.forEach(button => {
            if(window.innerWidth > BREAKPOINTS.TABLET) {
                const size = `${(100 / buttons.length)}% - 0.875rem`
                button.style.flex = `0 0 calc(${size})`
            } else {
                button.style.flex = '0 0 100%';
            }
        })

    }
    window.addEventListener('resize', init)
    init()
}


export {initButtons}