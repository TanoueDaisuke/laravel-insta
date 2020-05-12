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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/image_preview.js', 'public/js')
    .sass('resources/sass/top.scss', 'public/css')
    .sass('resources/sass/auth/auth.scss', 'public/css/auth')
    .sass('resources/sass/post.scss', 'public/css')
    .sourceMaps(true);