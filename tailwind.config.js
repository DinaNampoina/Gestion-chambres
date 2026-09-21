import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: { sans: ['Figtree', ...defaultTheme.fontFamily.sans] },
            colors: {
                brand: {
                    50: '#fbfdff', 100: '#f4faff', 200: '#e6f4fe', 300: '#d5efff',
                    400: '#8ec8f6', 500: '#0090ff', 600: '#0588f0', 700: '#0d74ce',
                    800: '#113264', 900: '#0d2847', 950: '#0d1520',
                },
                accent: {
                    50: '#fefdfb', 100: '#fefbe9', 200: '#fff7c2', 300: '#ffee9c',
                    400: '#ffe770', 500: '#ffd60a', 600: '#f5b400', 700: '#ab6400',
                    800: '#4e2009', 900: '#3b1f0b', 950: '#271402',
                },
            },
        },
    },
    plugins: [forms],
};
