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

    const formInit = () => {
        const formEl = component.querySelector('form.wpcf7-form')
        const responseWrapper = component.querySelector('.wpcf7-response-output')
        const copyResponseWrapper = responseWrapper.cloneNode(true)
        copyResponseWrapper.classList.add('clone')
        formEl.prepend(copyResponseWrapper)
        responseWrapper.remove()
    }
    formInit()

}

export {initContact}