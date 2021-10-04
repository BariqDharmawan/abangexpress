const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const template1Path = 'resources/assets/template1'
const template2Path = 'resources/assets/template2'
const templateAdminPath = 'resources/assets/admin'

//asset for admin
mix.scripts([
    'resources/assets/admin/template/vendor/jquery-easing/jquery.easing.min.js',
    'resources/assets/admin/template/js/sb-admin-2.min.js',
    'resources/assets/admin/template/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/template/vendor/chart.js/Chart.min.js',
    'resources/assets/admin/template/vendor/datatables/jquery.dataTables.min.js',
    'resources/assets/admin/template/vendor/datatables/dataTables.bootstrap4.min.js',
    'resources/assets/admin/template/vendor/summernote/summernote-bs4.min.js',
], 'public/admin/js/vendor.js')
.js('resources/assets/admin/js/app.js', 'public/admin/js/app.js')
.sass('resources/assets/admin/scss/app.scss', 'public/admin/css/app.css')
// mix.js(`${templateAdminPath}/js/vendor.js`, 'public/admin/js')
//     .js(`${templateAdminPath}/js/app.js`, 'public/admin/js')
    .copy(`${templateAdminPath}/img`, 'public/admin/img')

//asset for template 1
mix.js(`${template1Path}/js/app.js`, 'public/template1/js')
    .js(`${template1Path}/js/vendor.js`, 'public/template1/js')
    .sass(`${template1Path}/sass/app.scss`, 'public/template1/css/app.css')
    .options({
        processCssUrls: false 
    })
    .copy(`${template1Path}/img`, 'public/template1/img')
    .sourceMaps();

//general asset
mix.copy('resources/assets/dummy', 'storage/app/public')
    .copy('node_modules/bootstrap-icons/font/fonts', 'public/template1/css/fonts')
    .copy('node_modules/bootstrap-icons/font/fonts', 'public/template2/css/fonts')
    .copy('node_modules/boxicons/fonts', 'public/template1/fonts')
    .copy('node_modules/boxicons/fonts', 'public/template2/fonts')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/admin/webfonts')
    .copy('resources/assets/img', 'public/img')
    .copy('resources/assets/general/json', 'public/json')
    .copy('resources/assets/general/vendor', 'public/vendor')
    .copy('resources/assets/general/video', 'public/video')
    .copy(
        'resources/assets/admin/template/vendor/jquery', 
        'public/admin/template/vendor/jquery'
    )

//asset for template 2
mix.js(`${template2Path}/js/app.js`, 'public/template2/js')
    .js(`${template2Path}/js/vendor.js`, 'public/template2/js')
    .sass(`${template2Path}/sass/app.scss`, 'public/template2/css/app.css')
    .options({
        processCssUrls: false 
    })
    .copy(`${template2Path}/img`, 'public/template2/img')
    .sourceMaps();