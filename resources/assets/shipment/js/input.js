import AutoNumeric from 'autonumeric'
import { previewImgUpload } from './utilities'

if ($(".select2").length > 0) {
    $(".select2").select2({
        theme: 'classic',
        allowClear: true
    })
}

$(document).ready(function () {

    $(".custom-file__input").each(function () {
        const label = $(this).next().find('span')
        const labelText = label.text()

        $(this).change(function (e) {
            if ($(this).val() !== '') {
                label.text(e.target.files[0].name).addClass('no-after')
            }
            else {
                label.text(labelText).removeClass('no-after')
            }
        })
    })


    if ($(".form-line :input").val() !== '') {
        $(".form-line :input").parents(".form-line").addClass('focused')
    }

    $(".form-line :input").change(function () {
        if ($(this).val() !== '') {
            $(this).parents(".form-line").addClass('focused')
        }
    })

    $('.only-number').on('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });

    $('.prevent-enter').keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });

    $(".not-allow-space").on('input', function (e) {
        this.value = this.value.replace(/ /g, '')
    })

    $(".not-allow-number").on('input', function (e) {
        this.value = this.value.replace(/\d+/g, '')
    })

    $(".input-decimal-comma").each(function () {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: ',',
            digitGroupSeparator: '.'
        })
    })

    if ($(".only-number-not-allow-decimal").length > 0) {
        $('form button[type="submit"]').click(function (e) {
            e.preventDefault()
        
            if ($(".only-number-not-allow-decimal")[0].validity.stepMismatch) {
                $(".only-number-not-allow-decimal")[0].setCustomValidity(
                    'Jangan inputkan angka decimal'
                )
            }
            else {
                $(".only-number-not-allow-decimal")[0].setCustomValidity(' ')
                $(this).parents("form").trigger('submit')
                
            }
            $(".only-number-not-allow-decimal")[0].reportValidity()
            
        })
    }
    


    $(".input-currency").each(function () {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            allowDecimalPadding: true,
            alwaysAllowDecimalCharacter: true
        })
    })

    $("[data-input-hidden]").change(function (e) {
        const inputHidden = $(this).data('input-hidden')
        console.log(`changed: ${e.target.files[0].name}`)
        $(inputHidden).val(e.target.files[0].name)
    })

    $("#idcard_input_hidden").change(function () {
        console.log($(this).val())
    })

    $("[accept='image/*']").change(function () {
        const imgPreview = $(this).data('img-preview');

        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                previewImgUpload(imgPreview, e.target.result)
                // $(imgPreview).attr('src', e.target.result).removeClass('d-none')
            }
            reader.readAsDataURL(this.files[0]);
        }
        else {
            $(imgPreview).attr('src', '').addClass('d-none')
        }
    })

})