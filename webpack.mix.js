let mix = require('laravel-mix');

mix.js('resources/js/index.js', 'dist/js/image-select.js').vue({version: 2})
    .postCss("resources/css/image-select.css", "dist/css", [
        require("tailwindcss"),
    ]);