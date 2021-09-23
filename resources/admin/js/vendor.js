try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('jquery.easing')(window.jQuery);
} catch (e) {}

import './../vendor/datatable/jquery.dataTables.min.js'
import './../vendor/datatable/dataTables.bootstrap4.min.js'
