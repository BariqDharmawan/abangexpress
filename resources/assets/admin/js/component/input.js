$(document).ready(function () {
    $(".not-allow-number").on('keydown', function (e) {
        if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault()
        } else {
            const key = e.keyCode
    
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || 
            (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
        }
    })
})