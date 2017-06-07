let mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/welcome.scss', 'public/css')
   .browserSync({
    proxy: 'http://127.0.0.1:8000',
    files: ['app/**/*.php', 'app/*.php', 'routes/*.php', 'resources/**/**/*', 'resources/views/*.blade.php', 'resources/views/**/*.php', 'resources/views/layouts/*.blade.php']
});