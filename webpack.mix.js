const mix = require('laravel-mix');

mix
  .sass('web/content/themes/theme/assets/styles/main.scss', 'web/content/themes/theme/dist/styles')
  .js('web/content/themes/theme/assets/scripts/main.js', 'web/content/themes/theme/dist/scripts')
  .js('web/content/themes/theme/assets/scripts/customizer.js', 'web/content/themes/theme/dist/scripts')
  .sourceMaps();
