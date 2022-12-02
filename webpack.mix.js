let mix = require('laravel-mix');
require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 |
 */

mix.version();
mix.options({
  processCssUrls: false
})

    /*
     * Sourced asset dependencies via node_modules and JS bootstrapping
     */
    .js('resources/js/app.js', 'public/js').vue({ version: 2 })
    .sass('resources/sass/app.scss', 'public/css')
    .purgeCss()

    /*
     * Themes
     *
     * Note: Default wysibb theme is compiled into public/css/app.css from resources/sass/app.scss
     *
     */
    .sass('resources/sass/themes/galactic.scss', 'public/css/themes/galactic.css')
    .sass('resources/sass/themes/dark-blue.scss', 'public/css/themes/dark-blue.css')
    .sass('resources/sass/themes/dark-green.scss', 'public/css/themes/dark-green.css')
    .sass('resources/sass/themes/dark-pink.scss', 'public/css/themes/dark-pink.css')
    .sass('resources/sass/themes/dark-purple.scss', 'public/css/themes/dark-purple.css')
    .sass('resources/sass/themes/dark-red.scss', 'public/css/themes/dark-red.css')
    .sass('resources/sass/themes/dark-teal.scss', 'public/css/themes/dark-teal.css')
    .sass('resources/sass/themes/dark-yellow.scss', 'public/css/themes/dark-yellow.css')
    .sass('resources/sass/themes/cosmic-void.scss', 'public/css/themes/cosmic-void.css')

    /*
     * Login and TwoStep Auth styles
     *
     * We compile each of these separately since they should only be loaded with the certain views
     *
     * Note: These will likely be reworked into VueJS component(s)
     */
    .sass('resources/sass/main/login.scss', 'public/css/main/login.css')
    .sass('resources/sass/main/twostep.scss', 'public/css/main/twostep.css')

    /*
     * Here we take all these scripts and compile them into a single 'sloshare.js' file that will be loaded after 'app.js'
     *
     * Note: The order of this array will matter, no different then linking these assets manually in the html
     */
    .babel(['resources/js/sloshare/tmdb.js', 'resources/js/sloshare/parser.js', 'resources/js/sloshare/helper.js', 'resources/js/sloshare/custom.js'], 'public/js/sloshare.js')

    /*
     * Copy assets
     */
    .copy('resources/sass/vendor/webfonts/wysibb', 'public/fonts/wysibb')
    .copy('resources/sass/vendor/webfonts/font-awesome', 'public/fonts/font-awesome')
    .copy('resources/sass/vendor/webfonts/bootstrap', 'public/fonts/bootstrap')

    /*
     * Extra JS
     */
    .js('resources/js/sloshare/imgbb.js', 'public/js')
    .js('resources/js/vendor/alpine.js', 'public/js')
    .js('resources/js/vendor/virtual-select.js', 'public/js')
    .js('resources/js/sloshare/chat.js', 'public/js')

    /*
     * Snowfall JS login page
     */
    .js('resources/js/snowfall/jquery.snowfall.js', 'public/js')
    .js('resources/js/snowfall/jquery-1.12.4.js', 'public/js')
    .js('resources/js/snowfall/snowfall.js', 'public/js')
    .sass('resources/sass/snowfall/font-awesome.scss', 'public/css/snowfall/font-awesome.css')
    .sass('resources/sass/snowfall/jqueryscripttop.scss', 'public/css/snowfall/jqueryscripttop.css')

    /*
     * Google JS login page
     */
    .js('resources/js/sloshare/google.js', 'public/js')

    /*
     * AD JS login page
     */
    .js('resources/js/sloshare/ad.js', 'public/js');