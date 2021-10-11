import AutoNumeric from 'autonumeric';

if ($(".select2").length > 0) {
    $(".select2").select2({
        theme: 'classic'
    })
}

$(document).ready(function () {
    $('.only-number').on('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });


    $(".not-allow-number").on('keydown', function (e) {
        if (e.altKey) {
            e.preventDefault()
        } else {
            const key = e.keyCode

            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40)
                || (key >= 65 && key <= 90) || key == 190)) {
                e.preventDefault()
            }
        }
    })

    $(".input-currency").each(function () {
        console.log($(this).attr('id'))
        new AutoNumeric(`#${$(this).attr('id')}`, {
            allowDecimalPadding: true,
            alwaysAllowDecimalCharacter: true
        })
    })

    $("[accept='image/*']").change(function () {
        const imgPreview = $(this).data('img-preview');
        console.log('change')

        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $(imgPreview).attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
        else {
            $(imgPreview).attr('src', '');
        }
    })

})