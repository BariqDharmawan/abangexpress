$(document).ready(function () {

    $(".modal").on('shown.bs.modal', function (event) {
        localStorage.setItem('modal-open', $(this).attr('id'))
        console.log(localStorage.getItem('modal-open'))
    })

    if (localStorage.getItem('modal-open')) {
        console.log(localStorage.getItem('modal-open'))

        if ($(`#${localStorage.getItem('modal-open')}`).find('.text-danger').length > 0) {
            $(`#${localStorage.getItem('modal-open')}`).modal('show')
        }
        else {
            localStorage.removeItem('modal-open')
        }
    }

})