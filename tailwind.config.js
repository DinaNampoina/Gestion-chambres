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
                    50: '#fffcfc', 100: '#fff7f7', 200: '#feebec', 300: '#ffdbdc',
                    400: '#f4a9aa', 500: '#e5484d', 600: '#dc3e42', 700: '#ce2c31',
                    800: '#500f1c', 900: '#3b1219', 950: '#191111',
                },
                accent: {
                    50: '#fbfdff', 100: '#f4faff', 200: '#e6f4fe', 300: '#d5efff',
                    400: '#8ec8f6', 500: '#0090ff', 600: '#0588f0', 700: '#0d74ce',
                    800: '#113264', 900: '#0d2847', 950: '#0d1520',
                },
            },
        },
    },
    plugins: [forms],
};
