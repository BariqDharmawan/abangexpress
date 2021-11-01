import { isAlreadyFillFormBook, isOnFormBookPage } from "./helper";

const goToInvoicePage = '/shipping/order/book/invoice';

console.log(isOnFormBookPage, isAlreadyFillFormBook)
if (isAlreadyFillFormBook) {
    $("#menu-add-new-order").attr('href', goToInvoicePage)
}

if (isOnFormBookPage && isAlreadyFillFormBook) {
    window.location.href = goToInvoicePage
}
