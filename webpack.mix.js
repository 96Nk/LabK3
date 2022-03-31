const mix = require('laravel-mix');

mix.setPublicPath('public');
mix.js("resources/js/app.js", "js");
mix.sass('resources/sass/bootstraps.scss', 'css');
mix.css('resources/css/style.css', 'css');
