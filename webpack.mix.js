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

const copies = [
  {
    from: './node_modules/material-components-web/dist/material-components-web.js',
    to: 'public/js',
  },
  {
    from: './node_modules/material-components-web/dist/material-components-web.css',
    to: 'public/css',
  },
];
copies.map(asset => mix.copy(asset.from, asset.to));
mix.js('resources/assets/app.js', 'public/js');
mix.sass('resources/assets/app.scss', 'public/css', {
  includePaths: [
    'node_modules',
  ],
});