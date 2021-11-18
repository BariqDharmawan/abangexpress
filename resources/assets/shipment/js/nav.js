import { isAlreadyFillFormBook, isOnFormBookPage, hasNoValidationError } from "./helper";

const goToInvoicePage = '/shipping/order/book/invoice';

if (isAlreadyFillFormBook) {
    $("#menu-add-new-order").attr('href', goToInvoicePage)
}

console.log(`hasNoValidationError: ${hasNoValidationError}`)
if (hasNoValidationError && isOnFormBookPage && isAlreadyFillFormBook) {
    window.location.href = goToInvoicePage
}
