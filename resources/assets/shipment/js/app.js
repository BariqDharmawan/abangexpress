import './../template/js/admin'
import './../template/js/pages/index'
import './../template/js/demo'
import './get-ajax'
import './input'
import './localstorage'
import PDFObject from 'pdfobject'

$(".preview-pdf--without-header").each(function () {
    const pdfPreviewEl = $(this).attr('id')
    const pdfSrc = $(this).data('pdf-src')

    PDFObject.embed(pdfSrc, `#${pdfPreviewEl}`, {
        fallbackLink: `<p>Browser device mu tidak support embed PDF, 
                            <a href='[url]'>download saja</a>
                        </p>`
    })
})