$(document).ready(function () {
    if ($('.collapse').length > 0) {
        $('.collapse').on('show.bs.collapse', function () {
            $(this).prev().find(".collapse-icon").addClass('rotate-180deg')
        })
        $('.collapse').on('hide.bs.collapse', function () {
            $(this).prev().find(".collapse-icon").removeClass('rotate-180deg')
        })
    }
})