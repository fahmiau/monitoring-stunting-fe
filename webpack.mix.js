const mix = require('laravel-mix');
var webpack = require('webpack');

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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
mix.copyDirectory('resources/js/tinymce/js/tinymce', 'public/js/tinymce');
mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                __ENV: JSON.stringify(process.env),
            }),
        ],
    });

