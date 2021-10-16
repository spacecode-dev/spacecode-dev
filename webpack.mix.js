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

mix.setPublicPath('public')

.sass('node_modules/bootstrap/scss/bootstrap.scss', 'assets/css')
.sass('resources/sass/app.scss', 'assets/css')
.sass('resources/sass/auth.scss', 'assets/css')
.js('resources/js/app.js', 'assets/js')
.js('resources/js/vendor.js', 'assets/js')
.babel([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    'resources/js/app.js',
    'node_modules/inputmask/dist/jquery.inputmask.min.js',
    'node_modules/owl.carousel/dist/owl.carousel.min.js',
    'node_modules/bootstrap-notify/bootstrap-notify.min.js'
], 'public/assets/js/app.js')

.options({
    processCssUrls: false,
    postCss: [
        require('autoprefixer')({
            browsers: ['last 2 versions'],
            cascade: false
        })
    ]
});
