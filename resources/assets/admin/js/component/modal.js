$(document).ready(function () {
    $("form").each(function () {
        if ($(this).find('.text-danger').length) {
            $(this).parents('.modal').modal('show')
        }
    })
})