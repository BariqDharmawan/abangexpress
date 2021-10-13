$(document).ready(function () {
    //cancel submit form book and save data to localstorage
    $("#form-book-order").submit(function (e) {
        e.preventDefault()
        let bookOrder = new FormData($(this)[0])

        bookOrder.delete('_token')
        bookOrder.delete('recipient_idcard')

        for (const [key, value] of bookOrder) {
            localStorage.setItem(key, value)
        }

        $(this)[0].submit()
    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#form-invoice-order").submit(function (e) {
        e.preventDefault()
        const thisForm = $(this)[0]

        const getBookOrderOnPrevRequest = new FormData()
        const formDataInvoice = new FormData(thisForm)
        $(".select2").val('')

        for (let key = 0; key < localStorage.length; key++) {
            const inputNameBookingOrder = localStorage.key(key)

            //form data booking order
            getBookOrderOnPrevRequest.append(
                inputNameBookingOrder, 
                localStorage.getItem(inputNameBookingOrder)
            )
        }

        for (const invoice of formDataInvoice) {
            const inputNameInvoice = invoice[0]
            const inputValueInvoice = invoice[1]

            getBookOrderOnPrevRequest.append(inputNameInvoice, inputValueInvoice)
        }

        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice",
            data: getBookOrderOnPrevRequest,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response){
                console.log(response.data)
                alert(response.message + ', please see console')
                thisForm.reset()
                $(".select2").val('').trigger('change')
            },
            error: function (error) {
                alert(error)
            }
        })
        
    })

})