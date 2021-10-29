$(document).ready(function () {
    $('#dataTable').DataTable();
    $('.datatable-disable-pagination-ordering').DataTable({
        'paging': false,
        'ordering': false
    })

    const totalColumn = $(".datatable-disable-action-ordering thead th").length;
    $(".datatable-disable-action-ordering").DataTable({
        "columnDefs": [
            {
                "targets": totalColumn - 1,
                "orderable": false
            }
        ]
    })
})
