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
                sans: ['Inter', ...defaultTheme.fontFamily.sans], // Font Body yang bersih
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif], // Font Judul yang elegan            },
            },
            colors: {
                nature: {
                    dark: '#2F4F4F',
                    light: '#8FBC8F',
                    cream: '#F5F5DC',
                    blue: '#5F9EA0',
                    text: '#333333',
                },
            },
        },

    plugins: [forms],
    },
}
