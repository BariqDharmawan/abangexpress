function removePath(filename) {
    let filenameArray = filename.split('/')
    const filenameWithoutPath = filenameArray.length

    filenameArray = filenameArray[filenameWithoutPath - 1]

    return filenameArray;
}

function previewImgUpload(elId, pathImg) {
    $(elId).attr('src', pathImg).removeClass('d-none')
}

function regenerateDatatableAjax(tableId, data, columns) {
    $(tableId).DataTable().destroy()
    $(tableId).DataTable({
        "data": data,
        "columns": columns
    })
    $(tableId).DataTable().draw()
}

const csrfToken = $("meta[name='csrf-token']").attr('content')

const isOnFormBookPage = (window.location.pathname == '/shipping/order/book') ? true : false

const isOnFormBookInvoicePage = (window.location.pathname == '/shipping/order/book/invoice') ? true : false

const isAlreadyFillFormBook = localStorage.getItem('sender_name') ? true : false

const hasNoValidationError = $(".error-backend").length == 0

export {
    removePath,
    previewImgUpload,
    csrfToken,
    isOnFormBookInvoicePage,
    isAlreadyFillFormBook,
    regenerateDatatableAjax,
    isOnFormBookPage,
    hasNoValidationError
}
