import { onscroll, select } from "../../general/js/helper"

/**
   * Header fixed top on scroll
   */
let selectHeader = select('#header')
if (selectHeader) {
    let headerOffset = selectHeader.offsetTop
    let nextElement = selectHeader.nextElementSibling
    const headerFixed = () => {
        if ((headerOffset - window.scrollY) <= 0) {
            selectHeader.classList.add('fixed-top')
            nextElement.classList.add('scrolled-offset')
        } else {
            selectHeader.classList.remove('fixed-top')
            nextElement.classList.remove('scrolled-offset')
        }
    }
    window.addEventListener('load', headerFixed)
    onscroll(document, headerFixed)
}
