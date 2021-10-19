function appendModal(id, title, body, footer) {
    $(`<div class="modal fade" id="${id}"
        tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="${id}Label">${title}</h4>
                    </div>
                    <div class="modal-body">${body}</div>
                    <div class="modal-footer">${footer}</div>
                </div>
            </div>
        </div>
    `).appendTo('body')
    $(`#${id} .modal-body`).html(body)
    $(`#${id} .modal-footer`).html(footer)
}

export {appendModal}