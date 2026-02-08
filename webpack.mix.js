const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/app.js', 'public/dashboard/js')
    .sass('resources/css/dashboard/app.scss', 'public/dashboard/css')
    .sass('resources/css/dashboard/_variables.scss', 'public/dashboard/css')
    .sass('resources/css/light_mode.scss', 'public/css')
    .sass('resources/css/light_mode_main.scss', 'public/css')
    .sass('resources/css/media_queries.scss', 'public/css')
    .sass('resources/css/app.scss', 'public/css')
    .sass('resources/css/global.scss', 'public/css')
    .sass('resources/css/_variables.scss', 'public/css')
    .version()
