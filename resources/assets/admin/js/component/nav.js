$(document).ready(function () {
    $('#content-wrapper').on('click', function() {
        $(".collapse").collapse('hide')
    });

    $(".navbar-nav").on('click', function (e) {
        if (e.target !== this) return;

        $(".collapse").collapse('hide')
    })
})
