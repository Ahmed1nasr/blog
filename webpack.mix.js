const mix = require("laravel-mix");
const webpack = require("webpack");
const tailwindcss = require("tailwindcss");
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

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.options({
    uglify: {
        uglifyOptions: {
            compress: {
                drop_console: true,
            },
        },
    },
    processCssUrls: false,
}).webpackConfig({
    plugins: [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)],
});

mix.setPublicPath("public")
    .js("resources/js/wink/app.js", "public/wink-assets")
    .sass("resources/sass/wink/light.scss", "public/wink-assets", {}, [
        tailwindcss("resources/js/wink/light.js"),
    ])
    .version();

mix.sass("resources/sass/wink/dark.scss", "public/wink-assets", {}, [tailwindcss("resources/js/wink/dark.js")])
    .version()
    .copy("resources/favicon.png", "public/wink-assets");
