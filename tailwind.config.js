import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#279C00',
                    dark: '#1a6b00',
                },
                accent: {
                    DEFAULT: '#FEC014',
                    light: '#FEE566',
                },
                igp: {
                    surface: '#f8faf8',
                    text: '#2d3748',
                    'text-muted': '#4a5568',
                },
            },
        },
    },

    plugins: [forms],
};
