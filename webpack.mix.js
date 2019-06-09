let mix = require('laravel-mix'),
	poststylus   = require('poststylus'),
	mqpacker     = require('css-mqpacker'),
	autoprefixer = require('autoprefixer');

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

// mix.js('resources/js/login.js', 'public/js/login.js');
// mix.js('resources/js/modal.js', 'public/js/modal.js');
// mix.js('resources/js/insert.js', 'public/js/insert.js');
// mix.js('resources/js/list.js', 'public/js/list.js');
// mix.js('resources/js/mask-tel.js', 'public/js/mask-tel.js');
// mix.js('resources/js/search.js', 'public/js/search.js');
// mix.copy(['node_modules/jquery/dist/jquery.min.js', 'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
// 	'node_modules/jquery-bar-rating/dist/jquery.barrating.min.js', 'node_modules/dialog-polyfill/dialog-polyfill.js'], 'public/lib/js');
// //   .sass('resources/sass/app.scss', 'public/css');
// mix.styles('resources/css/insert.css', 'public/css/insert.css');
// mix.styles('resources/css/list.css', 'public/css/list.css');
// mix.styles('resources/css/all.css', 'public/css/all.css');
// mix.styles('resources/css/utils.css', 'public/css/utils.css');
// mix.styles('resources/css/login.css', 'public/css/login.css').version();
// mix.copy(['node_modules/dialog-polyfill/dialog-polyfill.css','node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css'], 'public/lib/css');

let config = [mqpacker(), autoprefixer({ browsers: ['> 1%', 'last 2 versions'] })];

mix.stylus(
		'resources/stylus/main.styl',
		'public/css/main.min.css', {
			use: [poststylus(config)]
		}
	);

mix.js('resources/js/app.js', 'public/js/app.js');

mix.copyDirectory('resources/images', 'public/img');
mix.copyDirectory('resources/fonts', 'public/fonts');
// mix.browserSync({
// 	proxy: '192.168.99.100:8080'
// });

