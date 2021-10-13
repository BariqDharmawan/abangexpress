$(document).ready(function() {

    const isAlreadyFillFormBook = localStorage.getItem('sender_name') ? true : false
    const isOnFormBookInvoicePage = (window.location.pathname ==
        '/shipping/order/book/invoice') ? true : false

    if (isOnFormBookInvoicePage && !isAlreadyFillFormBook) {
        window.location.href = '/shipping/order/book'
    }

    //cancel submit form book and save data to localstorage
    $("#form-book-order").submit(function(e) {
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
    $("#form-invoice-order").submit(function(e) {
        e.preventDefault()
        const thisForm = $(this)[0]

        const getBookOrderOnPrevRequest = new FormData()
        const formDataInvoice = new FormData(thisForm)

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
        // create json format to store commercialInvoice data on localStorage
        var ciform = new FormData(thisForm),
            ciresult = {};

        ciform.delete('_token')

        for (const entry of ciform.entries()) {
            ciresult[entry[0]] = entry[1]
        }
        ciresult = JSON.stringify(ciresult)
        console.log(ciresult);
        // check if there commercialInvoice on localStorage
        var oldCi = localStorage.getItem("commercialInvoice")
        if (oldCi === null) {
            localStorage.setItem('commercialInvoice', ciresult)
        } else {
            localStorage.setItem('commercialInvoice', oldCi + ',' + ciresult)
        }


        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice",
            data: getBookOrderOnPrevRequest,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                console.log(response.commercialInvoice)
                alert(response.message + ', please see console')
                thisForm.reset()

                $(".select2").val('')
                    // $(".select2").val('').trigger('change')

                // refresh dataTable
                var data = JSON.parse('[' + localStorage.getItem("commercialInvoice") + ']')
                console.log(data)
                $('#commercialInvoice').DataTable().destroy()
                $('#commercialInvoice').DataTable({
                    "data": data,
                    "columns": [
                        { "data": "desc" },
                        { "data": "desc" },
                        { "data": "desc" },
                        { "data": "desc" },
                        { "data": "desc" },
                        { "data": "desc" },
                        { "data": "desc" }
                    ]
                })
                $('#commercialInvoice').DataTable().draw()



            },
            error: function(error) {
                alert(error)
            }
        })

    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#form-save-order").submit(function(e) {
        e.preventDefault()
        const thisForm = $(this)[0]
        let xbookOrder = new FormData($(this)[0])

        xbookOrder.delete('_token')

        const getBookOrderOnPrevRequest = new FormData()
        const formDataInvoice = new FormData(thisForm)

        for (let key = 0; key < localStorage.length; key++) {
            const inputNameBookingOrder = localStorage.key(key)

            //form data booking order
            getBookOrderOnPrevRequest.append(
                inputNameBookingOrder,
                localStorage.getItem(inputNameBookingOrder)
            )
        }

        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice/save",
            data: getBookOrderOnPrevRequest,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {

                console.log(response)
                alert(response.message + ', please see console')



            },
            error: function(error) {
                alert(error)
            }
        })

    })

})
