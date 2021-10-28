import { onscroll, select } from "../../template2/js/helper"

/**
  * Back to top button
  */
let backtotop = select('.btn-back-to-top')
if (backtotop) {
    const toggleBacktotop = () => {
        if (window.scrollY > 100) {
            backtotop.classList.add('active')
        } else {
            backtotop.classList.remove('active')
        }
    }
    window.addEventListener('load', toggleBacktotop)
    backtotop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        })
    })

    onscroll(document, toggleBacktotop)
}
