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

mix.js('resources/admin/js/app.js', 'public/admin/js/admin.js')
    .js('resources/admin/js/vendor.js', 'public/admin/js/vendor.js')
    .sass('resources/admin/sass/app.scss', 'public/admin/css/admin.css')
    .options({
        processCssUrls: false 
    })
    .copy('node_modules/font-awesome/fonts', 'public/fonts')
    .copy('resources/admin/img', 'public/admin/img')

// mix.js('resources/js/app.js', 'public/js/app.js')
//     .sass('resources/sass/app.scss', 'public/css/app.css')
//     .sourceMaps();
