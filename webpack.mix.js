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
            {
                test: /\.s[ac]ss$/i,
                use: [
                    'resolve-url-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            prependData: '$assets_url: "' + process.env.MIX_ASSETS_URL + '";',
                        },
                    },
                ],
            }
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

mix.disableNotifications();
if (mix.inProduction()) {
    mix.js('resources/js/AdminApp/app.js','public/dist/ProdAdminApp.js')
        .js('resources/js/GuestApp/app.js','public/dist/ProdGuestApp.js')
        .sass('resources/sass/guest-app.scss', 'public/dist')
        .sass('resources/sass/admin-app.scss', 'public/dist')
        .extract(vendors,'dist/vendor')
        .version();
}else{
    mix.js('resources/js/AdminApp/app.js','public/js/AdminApp.js')
    .js('resources/js/GuestApp/app.js','public/js/GuestApp.js')
    .sass('resources/sass/guest-app.scss', 'public/css')
    .sass('resources/sass/admin-app.scss', 'public/css')
    .extract(vendors,'js/vendor');
}
