$(document).ready(function () {
    $(".datatable-export-excel").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Convert ke excel'
            }
        ],
        initComplete: function () {
            var $buttons = $('.dt-buttons').hide();
            const btnExportCustom = $(
                `.datas-action[data-datable-id="#${$(
                    ".datatable-export-excel"
                ).attr('id')}"]`
            )

            btnExportCustom.find('.btn-export-custom').click(function () {
                const btnExport = $(this).data('export-type')
                $(`.buttons-${btnExport}`).click()
            })
        }
    })
})