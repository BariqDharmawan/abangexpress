$(document).ready(function () {
    $('#dataTable').DataTable();
    $('.datatable-disable-pagination-ordering').DataTable({
        'paging': false,
        'ordering': false
    })
})
