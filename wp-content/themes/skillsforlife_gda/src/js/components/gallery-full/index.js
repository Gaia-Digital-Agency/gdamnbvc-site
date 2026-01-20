import GLightbox from "glightbox"

const initGalleryFull = (component) => {
    const lightbox = new GLightbox({
        selector: '[data-glightbox]',
        draggable: true
    }) 
}

export {initGalleryFull}
