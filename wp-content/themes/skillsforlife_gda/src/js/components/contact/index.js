const initContact = (component) => {

    const overlayChange = () => {
        const gridWrapper = component.querySelector('.grid')
        const columnContact = gridWrapper.querySelector('.blocks-wrapper')
        const columnContactRect = columnContact.getBoundingClientRect()
        const overlayWrapper = component.querySelector('.overlay')
        overlayWrapper.style.left = `${columnContactRect.left}px`
    }

    window.addEventListener('resize', overlayChange)
    overlayChange()

}

export {initContact}