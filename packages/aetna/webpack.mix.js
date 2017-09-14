let mix = require('laravel-mix');

// Set public path to /dist
mix.setPublicPath('dist/');

// Compile SCSS
mix.sass('assets/styles/aetna.scss', 'dist/styles');

// Version in production
if (mix.inProduction()) {
  mix.version();
}
