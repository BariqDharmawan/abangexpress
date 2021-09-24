try {
    window.Popper = require('@popperjs/core').default;
    window.$ = window.jQuery = require('jquery');
    // require('@fancyapps/fancybox/dist/jquery.fancybox.js');
    // require('vanilla-fitvids/jquery.fitvids.js');
    window.AOS = require('aos');

    const bootstrap = require('bootstrap')

} catch (e) {}