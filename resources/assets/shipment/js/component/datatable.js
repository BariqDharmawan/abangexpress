$(document).ready(function () {
    $(".datatable-export-excel").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Convert ke excel'
            }
        ]
    })
})