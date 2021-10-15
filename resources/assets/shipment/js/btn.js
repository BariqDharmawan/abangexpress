function enableOtherBtn(btnClicked) {
    const btnToEnable = btnClicked.data('enable-other-btn')
    $(btnToEnable).removeClass('disabled')
}

function showElAfterClick(btnClicked) {
    const elToShow = btnClicked.data('el-to-show')
    $(elToShow).show(500)
}

export { enableOtherBtn, showElAfterClick }