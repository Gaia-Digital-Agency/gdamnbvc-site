const initManualDonation = (component) => {
    const main = () => {
        const target = component.querySelector('.target-right')
        const targetRect = target.getBoundingClientRect()

        const right = window.innerWidth - targetRect.right
        const overlay = component.querySelector('.desktop-overlay')
        overlay.style.right = `${right}px`
    }

    window.addEventListener("resize", main)
    main()
}

export {initManualDonation}