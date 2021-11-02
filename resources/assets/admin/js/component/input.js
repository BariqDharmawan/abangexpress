import bsCustomFileInput from 'bs-custom-file-input'
import * as Quill from 'Quill';
// require('summernote/dist/summernote-bs4')
// import './../../template/vendor/summernote/summernote-bs4.min'

$(document).ready(function () {
    bsCustomFileInput.init()

    if ($('.summernote').length > 0) {
        $(".summernote").each(function () {
            const summernoteId = $(this).attr('id')
            const inputAttached = $(this).data('input-attached')

            const summernote = new Quill(`#${summernoteId}`, {
                modules: {
                    toolbar: [
                        ['bold', 'italic'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'underline', 'blockquote', 'code-block']
                      ]
                },
                theme: 'snow'
            })

            summernote.on('text-change', function (delta, oldDelta, source) {
                document.querySelector(`input[name='${inputAttached}']`).value = summernote.root.innerHTML;
            })
        })
    }

    $(".not-allow-number").on('keydown', function (e) {
        if (e.altKey) {
            e.preventDefault()
        } else {
            const key = e.keyCode

            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) ||
                    (key >= 65 && key <= 90) || key == 190)) {
                e.preventDefault()
            }
        }
    })
})
