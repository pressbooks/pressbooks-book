let mix = require( 'laravel-mix' );
let path = require( 'path' );
let normalizeNewline = require( 'normalize-newline' );
let fs = require( 'fs' );

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

// Normalize Newlines
const normalizeNewlines = ( dir ) => {
	fs.readdirSync( dir ).forEach( function( file ) {
		file = path.join( dir, file );
		fs.readFile( file, 'utf8', function( err, buffer ) {
			if ( err ) return console.log( err );
			buffer = normalizeNewline( buffer );
			fs.writeFile( file, buffer, 'utf8', function( err ) {
				if ( err ) return console.log( err );
			} );
		} );
	} );
};

mix
	.setPublicPath( 'dist' )
	.scripts( 'node_modules/sharer.js/sharer.js', 'dist/scripts/sharer.js' )
	.scripts( 'node_modules/lity/dist/lity.js', 'dist/scripts/lity.js' )
	.scripts( 'node_modules/jquery.localscroll/jquery.localScroll.js', 'dist/scripts/jquery.localScroll.js' )
	.scripts( 'node_modules/jquery.scrollto/jquery.scrollTo.js', 'dist/scripts/jquery.scrollTo.js' )
	.scripts( 'node_modules/details-element-polyfill/dist/details-element-polyfill.js', 'dist/scripts/details-element-polyfill.js' )
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
	.options( { processCssUrls: false } )
	.then( () => {
		normalizeNewlines( 'dist/scripts/' );
		normalizeNewlines( 'dist/styles/' );
	} );

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
