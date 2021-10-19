function regenerateDatatableAjax(tableId, data, columns) {
    $(tableId).DataTable().destroy()
    $(tableId).DataTable({
        "data": data,
        "columns": columns
    })
    $(tableId).DataTable().draw()
}

export {regenerateDatatableAjax}