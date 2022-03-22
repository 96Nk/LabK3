const mix = require('laravel-mix');

mix.setPublicPath('public');
mix.js("resources/js/app.js", "js");
mix.js("resources/js/template.js", "js");
mix.sass('resources/sass/app.scss', 'css');
mix.css('resources/css/style.css', 'css');
mix.css('resources/css/signin.css', 'css');
