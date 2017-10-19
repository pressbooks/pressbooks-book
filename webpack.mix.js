let mix = require('laravel-mix');

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

mix.setPublicPath('dist')
	.js('assets/scripts/navigation.js','dist/scripts/navigation.js')
	.scripts('assets/scripts/a11y.js','dist/scripts/a11y.js')
	.scripts(['node_modules/jquery-columnizer/src/jquery.columnizer.js', 'assets/scripts/columnizer-load.js'], 'dist/scripts/columnizer.js')
  .scripts('assets/scripts/keyboard-nav.js','dist/scripts/keyboard-nav.js')
	.scripts('node_modules/sharer.js/sharer.js', 'dist/scripts/sharer.js')
	.scripts('assets/scripts/toc.js','dist/scripts/toc.js')
	.scripts('assets/scripts/dropdown.js','dist/scripts/dropdown.js')
	.sass('assets/styles/a11y.scss', 'dist/styles')
	.sass('assets/styles/cover.scss', 'dist/styles')
  .sass('assets/styles/book-info.scss', 'dist/styles')
  .sass('assets/styles/structure.scss', 'dist/styles')
	.copyDirectory('assets/fonts', 'dist/fonts')
	.copyDirectory('assets/images', 'dist/images')
	.version()
  .options({
    processCssUrls: false
  });

	// BrowserSync
	mix.browserSync({
	  host: 'localhost',
	  proxy: 'http://pressbooks.dev/standardtest',
	  port: 3000,
	  files: [
	    `*.php`,
	    ``,
	    `${dist}/**/*.css`,
	    `${dist}/**/*.js`,
	  ],
	});

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
