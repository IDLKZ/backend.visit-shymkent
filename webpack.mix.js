const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);


mix.styles([
    'resources/assets/vendors/core/core.css',
    'resources/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'resources/assets/fonts/feather-font/css/iconfont.css',
    'resources/assets/vendors/flag-icon-css/css/flag-icon.min.css',
    'resources/assets/css/demo_1/style.css',
], '/public/css/app.css')

mix.scripts([
    'resources/assets/vendors/core/core.js',
    'resources/assets/vendors/chartjs/Chart.min.js',
    'resources/assets/vendors/jquery.flot/jquery.flot.js',
    'resources/assets/vendors/jquery.flot/jquery.flot.resize.js',
    'resources/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'resources/assets/vendors/apexcharts/apexcharts.min.js',
    'resources/assets/vendors/progressbar.js/progressbar.min.js',
    'resources/assets/vendors/feather-icons/feather.min.js',
    'resources/assets/js/template.js',
    'resources/assets/js/dashboard.js',
    'resources/assets/js/datepicker.js',
], '/public/js/app.js')
