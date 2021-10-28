import { select } from './../../general/js/helper'
const Isotope = require('isotope-layout');

/**
     * Porfolio isotope and filter
     */
window.addEventListener('load', () => {
    let portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
        let portfolioIsotope = new Isotope(portfolioContainer, {
            itemSelector: '.portfolio-item'
        });
    }

});
