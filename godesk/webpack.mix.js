const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.setPublicPath('dist')

/** Theme */
.sass('resources/sass/theme.scss', 'css')

/** Filemanager */
.js('resources/js/filemanager/filemanager-field.js', 'js')
.js('resources/js/filemanager/filemanager-tool.js', 'js')

/** Media Library */
.js('resources/js/media-library/media-library-field.js', 'js')

/** Settings */
.js('resources/js/settings/settings.js', 'js')

/** Tabs */
.js('resources/js/tabs/tabs-field.js', 'js')

/** Color */
.js('resources/js/color/color-field.js', 'js')

/** Toggle */
.js('resources/js/toggle/toggle-field.js', 'js')
.sass('resources/sass/toggle-field.scss', 'css')

/** Table */
.js('resources/js/table/table-field.js', 'js')
.postCss('resources/sass/table-field.css', 'css', [tailwindcss('tailwind.config.js')])