const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const purgecss = require('@fullhuman/postcss-purgecss')({
    // Removes unused CSS
    // According to Discord chat: Running Purge CSS as part of Post CSS is a ton faster than laravel-mix-purgecss
    // But if that doesn't work use https://github.com/spatie/laravel-mix-purgecss
    // Specify the paths to all of the template files in your project
    content: [
        './resources/views/*.php',
        './resources/views/**/*.php'
    ],

    // Classes prefixed with `js-` are whitelisted, for use in Javascript
    whitelistPatterns: [ /^js-[A-Za-z0-9-_:/]+/ ],

    // Include any special characters you're using in this regular expression
    defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
});


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        open: false,
        port: 8080,
        proxy: 'http://localhost:3000'
    })
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js'),
            // to enable purgecss on production only
            ...process.env.NODE_ENV === 'production' ? [purgecss] : []
        ],
    });

