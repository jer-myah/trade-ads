const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: {
        layers: ["base", "utilities"],
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './resources/js/**/*.vue',
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: { 
                'brown-50': '#EFDECD',
                'brown-100': '#FFD59A',
                'brown-200': '#',
                'brown-300': '#D2B48C',
                'brown-400': '#',
                'brown-500': '#B38B6D',
                'brown-600': '#',
                'brown-700': '#',
                'brown-800': '#',
                'brown-900': '#',               
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },

    },

    plugins: [require('@tailwindcss/forms'), require("windstrap")],
};
