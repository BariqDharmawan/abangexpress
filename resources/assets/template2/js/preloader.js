const { select } = require("./../../general/js/helper");

/**
* Preloader
*/
let preloader = select('#preloader');
if (preloader) {
    window.addEventListener('load', () => {
        preloader.remove()
    });
}
