let mix = require('laravel-mix');

const dist = 'dist'

// Set public path to dist
mix.setPublicPath(dist);

// Compile SCSS
mix.sass('assets/styles/aetna.scss', `${dist}/styles`);

// Version in production
if (mix.inProduction()) {
  mix.version();
}

// BrowserSync
mix.browserSync({
  host: 'localhost',
  proxy: 'http://aetna.test',
  port: 3000,
  files: [
    '',
    `${dist}/**/*.css`,
    `${dist}/**/*.js`,
  ],
});
