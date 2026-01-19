import { initComponents } from "./bootstrap"
import "../scss/editor.scss"

// wp.domReady(() => {
//     if(!document.body.classList.contains('block-editor-page')) return
//     const main = () => {
//         const columns = document.querySelectorAll('.wp-block-acf-column')
//         columns.forEach(_column => {
//             _column.childNodes.forEach(column => {
//                 if(!column.classList.contains('block-column')) return
//                 const classes = column.getAttribute('class').replace('acf-block', '').replace('block-column', '').replaceAll(':', '-')
//                 classes.split(' ').forEach(clas => {
//                     _column.setAttribute(`data-${clas}`, '')
//                 })
//             })
//         })


//         const parentInnerBlocks = document.querySelectorAll('[data-class]')
//         parentInnerBlocks.forEach(parentInnerBlock => {
//             parentInnerBlock.dataset.class.split(' ').forEach(classes => {
//                 parentInnerBlock.childNodes.forEach(innerBlock => {
//                     if(innerBlock.nodeName == "DIV") {
//                         if(!innerBlock.classList.contains('acf-innerblocks-container')) return
//                         innerBlock.setAttribute(`data-${classes.replace(':', '-')}`, '')
//                     }
//                 })
//             })
//         })
//         initComponents(true)
//     }
//     const observer = new MutationObserver(main)
    // observer.observe(document.body, {attributes: true, childList: true, subtree: true})
    // this (setTimeout) should be tempSolutuion
    // setTimeout(main, 3000)
// })