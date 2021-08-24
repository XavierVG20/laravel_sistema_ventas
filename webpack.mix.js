const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |  .scripts(['resources/plugins/jQuery/jquery-2.2.3.min.js',
    'resources/admin/bootstrap/js/bootstrap.min.js',
    'resources/admin/dist/js/demo.js',
    'resources/admin/dist/js/app.min.js'n
    'resources/js/app.js'], 'public/js/app.js')
 */

mix.styles(['resources/admin/bootstrap/css/bootstrap.min.css',
'resources/admin/dist/css/AdminLTE.min.css',
'resources/admin/dist/css/skins/_all-skins.min.css'],'public/css/app.css')
   
    .js([
    'resources/js/app.js'], 'public/js/app.js')

    .vue()
    .sass('resources/sass/app.scss', 'public/css');
