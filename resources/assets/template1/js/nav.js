import { on, select, onscroll, scrollto } from './../../general/js/helper'

/**
   * Mobile nav toggle
   */
on('click', '.mobile-nav-toggle', function (e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
})

/**
 * Mobile nav dropdowns activate
 */
on('click', '.navbar .dropdown > a', function (e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
        e.preventDefault()
        this.nextElementSibling.classList.toggle('dropdown-active')
    }
}, true)

/**
   * Scrool with ofset on links with a class name .scrollto
   */
on('click', '.scrollto', function (e) {
    if (select(this.hash)) {
        e.preventDefault()

        let navbar = select('#navbar')
        if (navbar.classList.contains('navbar-mobile')) {
            navbar.classList.remove('navbar-mobile')
            let navbarToggle = select('.mobile-nav-toggle')
            navbarToggle.classList.toggle('bi-list')
            navbarToggle.classList.toggle('bi-x')
        }
        scrollto(this.hash)
    }
}, true)

/**
   * Navbar links active state on scroll
   */
let navbarlinks = select('#navbar .scrollto', true)
const navbarlinksActive = () => {
    let position = window.scrollY + 200

    if (window.location.pathname == '/') {
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    else {
        navbarlinks.forEach(navbarlink => {
            navbarlink.classList.remove('active')
            if (window.location.pathname == navbarlink.getAttribute('href')) {
                navbarlink.classList.add('active')
            }
        })
    }

}
window.addEventListener('load', navbarlinksActive)
onscroll(document, navbarlinksActive)
