import { initComponents } from "./bootstrap"
import { determineNavHeight, initHeaderNav, initMobileMenu, footerTargetCols } from "./global"
import '../scss/app.scss'

document.addEventListener("DOMContentLoaded", () => {
    initComponents()
    initHeaderNav()
    initMobileMenu()
    footerTargetCols()
})

window.addEventListener('resize', determineNavHeight)
determineNavHeight();

const BREAKPOINTS = {
    MOBILE: 0,
    TABLET: 768,
    DESKTOP: 1024,
    determineScreenSize: (size) => {
        if(size < BREAKPOINTS.TABLET) {
            return 'mobile'
        }
        if(size < BREAKPOINTS.DESKTOP) {
            return 'tablet'
        }
        return 'desktop'
    }
}

export {BREAKPOINTS}