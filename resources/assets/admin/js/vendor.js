try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    window.Popper = require('popper.js').default;
    require('jquery.easing')(window.jQuery);
} catch (e) {}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});