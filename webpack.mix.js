const mix = require('laravel-mix');

const template1Path = 'resources/assets/template1'
const template2Path = 'resources/assets/template2'
const templateAdminPath = 'resources/assets/admin'
const templateShipmentPath = 'resources/assets/shipment'

//asset for admin
mix.scripts([
        `${templateAdminPath}/template/vendor/jquery-easing/jquery.easing.min.js`,
        `${templateAdminPath}/template/vendor/chart.js/Chart.min.js`,
        `${templateAdminPath}/template/vendor/datatables/jquery.dataTables.min.js`,
        `${templateAdminPath}/template/vendor/datatables/dataTables.bootstrap4.min.js`,
    ], 'public/admin/js/vendor.js')
    .js(`${templateAdminPath}/js/app.js`, 'public/admin/js/app.js')
    .sass(`${templateAdminPath}/scss/app.scss`, 'public/admin/css/app.css')
    .copy(`${templateAdminPath}/img`, 'public/admin/img')
    .copy('node_modules/summernote/dist/font', 'public/admin/css/font')
    .autoload({
        DataTable: 'datatables.net-bs4'
    })
    .version();

//asset for shipment page
mix.scripts([
    `${templateShipmentPath}/template/plugins/bootstrap/js/bootstrap.js`,
    `${templateShipmentPath}/template/plugins/jquery-slimscroll/jquery.slimscroll.js`,
    `${templateShipmentPath}/template/plugins/autosize/autosize.js`,
    `${templateShipmentPath}/template/plugins/momentjs/moment.js`,
    `${templateShipmentPath}/template/js/pages/forms/basic-form-elements.js`,
    `${templateShipmentPath}/template/plugins/jquery-countto/jquery.countTo.js`,
    `${templateShipmentPath}/template/plugins/raphael/raphael.min.js`,
    `${templateShipmentPath}/template/plugins/morrisjs/morris.js`,
    `${templateShipmentPath}/template/plugins/chartjs/Chart.bundle.js`,
    `${templateShipmentPath}/template/plugins/flot-charts/jquery.flot.js`,
    `${templateShipmentPath}/template/plugins/flot-charts/jquery.flot.resize.js`,
    `${templateShipmentPath}/template/plugins/flot-charts/jquery.flot.pie.js`,
    `${templateShipmentPath}/template/plugins/flot-charts/jquery.flot.categories.js`,
    `${templateShipmentPath}/template/plugins/flot-charts/jquery.flot.time.js`,
    `${templateShipmentPath}/template/plugins/jquery-sparkline/jquery.sparkline.js`,
    `${templateShipmentPath}/vendor/select2/js/select2.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/jquery.dataTables.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/buttons.flash.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/jszip.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/pdfmake.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/vfs_fonts.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/buttons.html5.min.js`,
    `${templateShipmentPath}/template/plugins/jquery-datatable/extensions/export/buttons.print.min.js`,
    `${templateShipmentPath}/template/js/pages/tables/jquery-datatable.js`,
    `${templateShipmentPath}/js/admin.js`,
    `${templateShipmentPath}/js/pages/index.js`,
    `${templateShipmentPath}/js/demo.js`,
], 'public/shipment/js/vendor.js')
    .sass(`${templateShipmentPath}/sass/app.scss`, 'public/shipment/css/app.css')
    .js(`${templateShipmentPath}/js/app.js`, 'public/shipment/js/app.js')
    .copy('node_modules/material-design-icons/iconfont', 'public/shipment/css')
    .copy(
        `${templateShipmentPath}/template/plugins/jquery`,
        'public/shipment/template/vendor/jquery'
    )
    .copy(`${templateShipmentPath}/template/images`, 'public/shipment/img')
    .copy(
        `${templateShipmentPath}/template/plugins/bootstrap/fonts`,
        'public/shipment/fonts'
    )
    .version();

//asset for template 1
mix.js(`${template1Path}/js/app.js`, 'public/template1/js')
    .js(`${template1Path}/js/vendor.js`, 'public/template1/js')
    .sass(`${template1Path}/sass/app.scss`, 'public/template1/css/app.css')
    .options({
        processCssUrls: false
    })
    .copy(`${template1Path}/img`, 'public/template1/img')
    .version()
    .sourceMaps();

//general asset
mix.copy('resources/assets/dummy', 'storage/app/public')
    .copy('node_modules/bootstrap-icons/font/fonts', 'public/template1/css/fonts')
    .copy('node_modules/bootstrap-icons/font/fonts', 'public/template2/css/fonts')
    .copy('node_modules/boxicons/fonts', 'public/template1/fonts')
    .copy('node_modules/boxicons/fonts', 'public/template2/fonts')
    .copy('resources/assets/img', 'public/img')
    .copy('resources/assets/general/json', 'public/json')
    .copy('resources/assets/general/vendor', 'public/vendor')
    .copy('resources/assets/general/video', 'public/video')
    .copy(
        'resources/assets/admin/template/vendor/jquery',
        'public/admin/template/vendor/jquery'
    );

//asset for template 2
mix.js(`${template2Path}/js/app.js`, 'public/template2/js')
    .js(`${template2Path}/js/vendor.js`, 'public/template2/js')
    .sass(`${template2Path}/sass/app.scss`, 'public/template2/css/app.css')
    .options({
        processCssUrls: false
    })
    .copy(`${template2Path}/img`, 'public/template2/img')
    .version()
    .sourceMaps();

