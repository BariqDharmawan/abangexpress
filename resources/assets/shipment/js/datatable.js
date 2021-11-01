$(document).ready(function () {
    let currentTimestamp = new Intl.DateTimeFormat('id-ID', {
        timeZone: 'Asia/Jakarta', timeStyle: 'medium',
        dateStyle: 'long'
    }).format(new Date())

    $(".datatable-export-excel-without-action").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: currentTimestamp,
                exportOptions: {
                    columns: [0, 1, 2, 3,]
                }
            }
        ],
        initComplete: function () {
            var $buttons = $('.dt-buttons').hide();
            const btnExportCustom = $(
                `.datas-action[data-datable-id="#${$(
                    ".datatable-export-excel-without-action"
                ).attr('id')}"]`
            )

            btnExportCustom.find('.btn-export-custom').click(function () {
                const btnExport = $(this).data('export-type')
                $(`.buttons-${btnExport}`).click()
            })
        }
    })
})
