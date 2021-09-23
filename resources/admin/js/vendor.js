import './../vendor/datatable/jquery.dataTables.min.js'
import './../vendor/datatable/dataTables.bootstrap4.min.js'

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('jquery.easing')(window.jQuery);
} catch (e) {}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});