const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');

const config = {
    module: {
        rules:[
            {
                test:'/\.vue$/',
                loader:'vue-loader',
            },
            {
                test: /\.(js|jsx)$/,
                use: [{
                    loader: 'babel-loader',
                    options: {
                        presets: ["@babel/preset-env"]
                    }
                }, ],
                include: [ /node_modules\/freedom-vue-framework/,/node_modules\/aj-vue-ui/,/node_modules\/freedom-js-support/],
            },
         ]
    },
    resolve:{
        alias:{
            "@admin" : path.resolve(__dirname,'resources/js/','AdminApp'),
            "@guest" : path.resolve(__dirname,'resources/js/','GuestApp'),
            "@common" : path.resolve(__dirname,'resources/js/','_common'),
            "@api" : path.resolve(__dirname,'resources/js/_common','api'),
            "@constants" : path.resolve(__dirname,'resources/js/_common','constants'),
            "@middlewares" : path.resolve(__dirname,'resources/js/_common','middlewares'),
            "@helpers" : path.resolve(__dirname,'resources/js/_common','helpers'),
        }
    },
}

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

 const vendors = [
    "vue",
    "axios",
    "vue-router",
    "vee-validate",
    "vuex",
    "vuex-persistedstate",
    "vue-bus",
    "vue-svgicon",
    "vue-toast-notification",
    'js-cookie',
    "lodash",
    "moment",
];

mix.webpackConfig(config)
    .js('resources/js/AdminApp/app.js','public/js/AdminApp.js')
    .js('resources/js/GuestApp/app.js','public/js/GuestApp.js')
    .extract(vendors,'js/vendor')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin-app.scss', 'public/css')

mix.disableNotifications();
if (mix.inProduction()) {
    mix.js('resources/js/AdminApp/app.js','public/js/ProdAdminApp.js')
        .js('resources/js/GuestApp/app.js','public/js/ProdGuestApp.js')
        .version();
}
