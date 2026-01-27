const componentsMap = {
    '.block-stack-slider': () => import('./components/stack-slider'),
    '.block-company-highlight': () => import('./components/company-highlight'),
    '.block-tab-content': () => import('./components/tab-content'),
    '.block-navigation-stack-slider': () => import('./components/navigation-stack-slider'),
    '.block-image-text-slider': () => import('./components/image-text-slider'),
    '.block-gallery': () => import('./components/gallery'),
    '.block-gallery-full': () => import('./components/gallery-full'),
    '.block-contact': () => import('./components/contact'),
    '.block-buttons': () => import('./components/buttons'),
    '.block-container': () => import('./components/container'),
    '.block-indonesia-slider': () => import('./components/indonesia-slider'),
    '.wp-block-spacer': () => import('./components/spacer'),
    '.block-manual-donation' : () => import('./components/manual-donation'),
    '#donation-form': () => import('./components/donation-form'),
    '.block-grid': () => import('./components/grid'),
    '#thank-you': () => import('./components/thank-you')
}

const initComponents = async (editor = false) => {
    for (const selector in componentsMap) {
        const elements = document.querySelectorAll(selector)

        if (!elements.length) continue

        const module = await componentsMap[selector]()
        const initFn = Object.values(module)[0]

        elements.forEach(element => {
            initFn(element, editor)
        })
    }
}

export { initComponents }
