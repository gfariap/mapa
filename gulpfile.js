var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.less('app.less');
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.min.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
        '../../../node_modules/sweetalert/dist/sweetalert.min.js',
        '../../../node_modules/select2/dist/js/select2.full.min.js',
        '../../../node_modules/select2/dist/js/i18n/pt-BR.js',
        '../../../node_modules/moment/min/moment-with-locales.min.js',
        '../../../node_modules/jquery.inputmask/dist/inputmask/inputmask.js',
        '../../../node_modules/jquery.inputmask/dist/inputmask/jquery.inputmask.js',
        '../../../node_modules/jquery-maskmoney/dist/jquery.maskMoney.min.js',
        '../../../node_modules/vue/dist/vue.min.js',
        '../../../resources/assets/js/app.js'
    ], 'public/js/app.js');
});
