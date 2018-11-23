let mix = require( 'laravel-mix' );

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

const dist = 'dist';

mix
	.setPublicPath( 'dist' )
	.scripts( 'node_modules/sharer.js/sharer.js', 'dist/scripts/sharer.js' )
	.scripts( 'node_modules/lity/dist/lity.js', 'dist/scripts/lity.js' )
	.js( 'assets/src/scripts/book.js', 'dist/scripts/book.js' )
	.js( 'assets/src/scripts/pane.js', 'dist/scripts/pane.js' )
	.js(
		'assets/src/scripts/collapse-sections.js',
		'dist/scripts/collapse-sections.js'
	)
	.js( 'assets/src/scripts/lightbox.js', 'dist/scripts/lightbox.js' )
	.sass( 'assets/src/styles/book.scss', 'dist/styles' )
	.sass( 'assets/legacy/styles/web-house-style.scss', 'dist/styles' )
	.copy( 'node_modules/lity/dist/lity.css', 'dist/styles/lity.css' )
	.copyDirectory( 'assets/src/images', 'dist/images' )
	.version()
	.options( { processCssUrls: false } );

// BrowserSync
mix.browserSync( {
	host: 'localhost',
	proxy: 'https://pressbooks.test/standardtestbook',
	port: 3200,
	files: [ '*.php', '', `${dist}/**/*.css`, `${dist}/**/*.js` ],
} );

// Source maps when not in production.
if ( ! mix.inProduction() ) {
	mix.sourceMaps();
}
