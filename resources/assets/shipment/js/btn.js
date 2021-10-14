function enableOtherBtn(btnClicked) {
    const btnToEnable = btnClicked.data('enable-other-btn')
    $(btnToEnable).removeClass('disabled')
}

export {enableOtherBtn}