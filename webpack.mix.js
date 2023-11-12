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

mix.styles([
    'public/css/uncompressed/main.css',
    'public/css/uncompressed/home.css',
    'public/css/uncompressed/about.css',
    'public/css/uncompressed/products.css',
    'public/css/uncompressed/news.css',
    'public/css/uncompressed/media.css',],
    'public/css/minified/app.css'
);

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();