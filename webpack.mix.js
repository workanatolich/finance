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

mix.css('resources/assets/free/main.css', 'public/css/main.css');
mix.js('resources/assets/free/assets/scripts/main.js', 'public/js/main.js');

mix.copy('resources/assets/free/assets/fonts', 'public/fonts');
mix.copy('resources/assets/free/assets/images', 'public/images');

