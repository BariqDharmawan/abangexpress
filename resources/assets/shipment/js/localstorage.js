$(document).ready(function () {
    $("#form-book-order").submit(function (e) {
        e.preventDefault()
        let bookOrder = new FormData($(this)[0])

        bookOrder.delete('_token')

        for (const [key, value] of bookOrder) {
            localStorage.setItem(key, value)
        }

        $(this)[0].submit()

    })

    $("#form-invoice-order").load(function () {
        alert('coba')
    })
})