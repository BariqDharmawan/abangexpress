import AutoNumeric from 'autonumeric'

$(document).ready(function () {
    $(".not-allow-space").on('input', function(e) {
        this.value = this.value.replace(/ /g, '')
    })

    $('.only-number').on('input', function() {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });

    $('.prevent-enter').keypress(function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });

    $(".not-allow-number").on('input', function(e) {
        this.value = this.value.replace(/\d+/g, '')
    })

    $(".input-currency").each(function() {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            allowDecimalPadding: true,
            alwaysAllowDecimalCharacter: true
        })
    })

    $(".input-decimal-dot-without-padding").each(function () {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: '.',
            digitGroupSeparator: ',',
            allowDecimalPadding: false,
            unformatOnSubmit: true
        })
    })

    $(".input-decimal-dot").each(function () {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: '.',
            digitGroupSeparator: ',',
            unformatOnSubmit: true
        })
    })

    $(".input-decimal-comma").each(function() {
        new AutoNumeric(`#${$(this).attr('id')}`, {
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            unformatOnSubmit: true
        })
    })
})