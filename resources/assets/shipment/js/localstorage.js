import { enableOtherBtn, showElAfterClick } from "./btn"

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
        const btnSubmit = $(this).find("button[type='submit']")

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

                alert(response.message)
                thisForm.reset()

                $(".select2").val('').trigger('change')

                // refresh dataTable
                const data = JSON.parse(
                    '[' + localStorage.getItem("commercialInvoice") + ']'
                )
                const commercialInvoice = data.map((invoice, index) => ({
                    ...invoice,
                    no: index + 1,
                    total_value: Number(invoice.quantity) *
                        Number(invoice.value_unit),
                    action: `<button class="btn waves-effect btn-danger"
                        data-toggle="modal" type="button"
                        data-target="#delete-data-${index + 1}">
                            <i class="material-icons">delete</i>
                        </button>`
                }))

                $('#commercialInvoice').DataTable().destroy()
                $('#commercialInvoice').DataTable({
                    "data": commercialInvoice,
                    "columns": [
                        { "data": "no" },
                        { "data": "desc" },
                        { "data": "unit" },
                        { "data": "quantity" },
                        { "data": "value_unit" },
                        { "data": "total_value" },
                        { "data": "action" }
                    ]
                })
                $('#commercialInvoice').DataTable().draw()

                if (btnSubmit.hasClass('enable-other-btn')) {
                    enableOtherBtn(btnSubmit)
                }
                if (btnSubmit.hasClass('show-el-after-click')) {
                    showElAfterClick(btnSubmit)
                }

                for (let i = 0; i < commercialInvoice.length; i++) {
                    const modalFade = $("<div>", {
                        id: `delete-data-${i + 1}`,
                        class: 'modal fade',
                        tabindex: '-1',
                        role: 'dialog'
                    })

                    const csrfToken = $("meta[name='csrf-token']").attr('content')
                    $(`<div class="modal fade" id="delete-data-${i + 1}"
                        tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="{{ $id }}Label">
                                            Hapus data ${i + 1}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Apakah kamu yakin, ingin menghapus data
                                            ${i + 1}
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">
                                                Tidak jadi
                                            </button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="_token"
                                                value="${csrfToken}">
                                                <input type="hidden" name="_method"
                                                value="DELETE">
                                                <button type="button" class="btn btn-danger waves-effect">
                                                    Ya, hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).appendTo('body')
                }

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
                localStorage.clear()
                alert(response.message)

                window.open(response.data.link_resi, '_blank');
                window.open('/shipping', '_self');



            },
            error: function(error) {
                alert(error)
            }
        })

    })

    function FillCommercialInvoice() {
        // generate commercial invoice table data
        var oldCi = localStorage.getItem("commercialInvoice")
        if (oldCi === null) {
            // no data dont generate

            $("#btn-generate-pdf").attr("disabled");
        } else {
            // generate data

            const thisForm = $(this)[0]
            const btnSubmit = $(this).find("button[type='submit']")


            // refresh dataTable
            const data = JSON.parse(
                '[' + localStorage.getItem("commercialInvoice") + ']'
            )
            const commercialInvoice = data.map((invoice, index) => ({
                ...invoice,
                no: index + 1,
                total_value: Number(invoice.quantity) *
                    Number(invoice.value_unit),
                action: `<button class="btn waves-effect btn-danger"
                            data-toggle="modal" type="button"
                            data-target="#delete-data-${index + 1}">
                                <i class="material-icons">delete</i>
                            </button>`
            }))

            $('#commercialInvoice').DataTable().destroy()
            $('#commercialInvoice').DataTable({
                "data": commercialInvoice,
                "columns": [
                    { "data": "no" },
                    { "data": "desc" },
                    { "data": "unit" },
                    { "data": "quantity" },
                    { "data": "value_unit" },
                    { "data": "total_value" },
                    { "data": "action" }
                ]
            })
            $('#commercialInvoice').DataTable().draw()

            $("#btn-generate-pdf").removeAttr("disabled");

            for (let i = 0; i < commercialInvoice.length; i++) {
                const modalFade = $("<div>", {
                    id: `delete-data-${i + 1}`,
                    class: 'modal fade',
                    tabindex: '-1',
                    role: 'dialog'
                })

                const csrfToken = $("meta[name='csrf-token']").attr('content')
                $(`

                <div class="modal fade" id="delete-data-${i + 1}"
                            tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="{{ $id }}Label">
                                                Hapus data ${i + 1}
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Apakah kamu yakin, ingin menghapus data
                                                ${i + 1}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">
                                                    Tidak jadi
                                                </button>
                                                    <input type="hidden" name="_token"
                                                    value="${csrfToken}">
                                                    <input type="hidden" name="_method"
                                                    value="DELETE">
                                                    <button id="xbutton" value="${i + 1}" type="button"data-dismiss="modal"  class="btn btn-danger waves-effect">
                                                        Ya, hapus
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).appendTo('body')
            }

        }

    }


    FillCommercialInvoice()
        // delete commercial invoice content
    $("button").click(function() {
        var ids = $(this).val();
        if (ids > 0) {
            let data = localStorage.getItem("commercialInvoice");
            // split and count
            const xArray = data.split("},");
            if (xArray.length > 0) {

                var removeId = ids - 1;
                var str1 = "";
                var ct = 1;
                for (let i = 0; i < xArray.length; i++) {
                    if (i == ids - 1) {} else {
                        var xstr2 = "";
                        xstr2 = xArray[i].replace("{", "")
                        xstr2 = xstr2.replace("}", "")
                        if (ct == 1) {
                            str1 = str1.concat('{' + xstr2 + '}')
                        } else {
                            str1 = str1.concat(',{' + xstr2 + '}')
                        }
                        ct++
                    }
                }
                localStorage.setItem('commercialInvoice', str1)

                FillCommercialInvoice()
            } else {
                // remove key if only 1 found
                localStorage.removeItem('commercialInvoice')
            }
        }
    });

    // pop the filter
    function myxFunction() {
        var x = document.getElementById("myxDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

})
