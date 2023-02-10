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
mix.styles([
    'public/css/fonts.css',
    'public/css/bootstrap.min.css',
    'public/css/style.css',
    'public/css/slick-theme.css',
    'public/css/responsive.css',
    'public/libs/lightgallery-master/dist/css/lightgallery.min.css',
], 'public/css/all.css').version();

mix.js([
    'public/js/popper.min.js',
    'public/js/bootstrap.min.js',
    'public/libs/lightgallery-master/dist/js/lightgallery-all.min.js',
    'public/js/jquery.lazy.min.js',
    'public/js/js_theme.js'
], 'public/js/all.js').version();