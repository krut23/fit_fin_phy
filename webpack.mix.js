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

mix.styles([
    './public/user-assets/css/bootstrap.min.css',
    './public/user-assets/css/all.min.css',
    './public/user-assets/css/animate.min.css',
    './public/user-assets/css/slick.css',
    './public/user-assets/css/slick-theme.css',
    './public/user-assets/css/magnific-popup.css',
    './public/user-assets/css/style.css',
    './public/user-assets/css/responsive.css',
    './public/user-assets/css/custom.css',
], './public/user-assets/mix/opt.css');

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css',[
//         require('postcss-custom-properties')
//     ]);

// mix.scripts([
//     './public/user-assets/js/jquery.min.js',
//     './public/user-assets/js/popper.min.js',
//     './public/user-assets/js/bootstrap.min.js',
//     './public/user-assets/js/slick.min.js',
//     './public/user-assets/js/jquery.magnific-popup.min.js',
//     './public/user-assets/js/main.js'
// ], './public/user-assets/mix/opt.js');
