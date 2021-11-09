import { appendInvoiceToBookOrder, fillCommercialInvoice, getBookOrderOnPrevRequest, getLocalstorageBookOrder, removeCommercialInvoice, showInvoiceResult } from "./function-task"
import { isAlreadyFillFormBook, isOnFormBookInvoicePage } from "./helper"

$(document).ready(function() {
    //redirect to invoice page if already fill book order
    if (isOnFormBookInvoicePage && !isAlreadyFillFormBook) {
        window.location.href = '/shipping/order/book'
    }

    fillCommercialInvoice()

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

        const formDataInvoice = new FormData(thisForm)
        const getBookOrder = getLocalstorageBookOrder(true)

        appendInvoiceToBookOrder(getBookOrder, formDataInvoice)
        // create json format to store commercialInvoice data on localStorage

        var ciform = new FormData(thisForm),
        ciresult = {};

        ciform.delete('_token')

        for (const entry of ciform.entries()) {
            ciresult[entry[0]] = entry[1]
        }
        ciresult = JSON.stringify(ciresult)

        var oldCi = localStorage.getItem("commercialInvoice")


        // Todo: submit ajax here
        $.ajax({
            url: "/shipping/order/book/invoice",
            data: getBookOrder,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                thisForm.reset()

                $("#form-invoice-order .form-line").removeClass('focused')
                $(".select2").val('').trigger('change')

                $('[class*="error-ajax-"]').text("").addClass('d-none')

                // check if there commercialInvoice on localStorage
                if (oldCi === null) {
                    localStorage.setItem('commercialInvoice', ciresult)
                } else {
                    localStorage.setItem('commercialInvoice', oldCi + ',' + ciresult)
                }

                showInvoiceResult()

            },
            error: function(response) {
                const responseError = response.responseJSON.errors
                for (var key in responseError) {
                    $(`.error-ajax-${key}`).text(responseError[key]).removeClass('d-none')
                }
            }
        })

    })

    //submit form invoice and form booking order that saved on localstorage as well
    $("#print-invoice").submit(function(e) {
        e.preventDefault()

        const getBookOrder = getBookOrderOnPrevRequest($(this)[0])

        $.ajax({
            url: "/shipping/order/book/invoice/save",
            data: getBookOrder,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                console.log(response.xPD)

                window.open('/shipping/order/print?key=' + response.data.token_resi, '_blank');
                localStorage.clear()
                window.location.href = '/shipping/order/receipt'

            },
            error: function(error) {
                alert(error)
            }
        })

    })

    // delete commercial invoice content
    $("body").on('click', ".btn-delete-value-attr", function() {
        $(this).parents('.modal').modal('hide')
        console.log(`val: ${Number($(this).val()) - 1}`)
        removeCommercialInvoice($(this))
    });


})
