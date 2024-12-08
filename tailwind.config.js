import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#4F46E5',
                    light: '#6366F1',
                    dark: '#3730A3',
                },
                secondary: {
                    DEFAULT: '#9333EA',
                    light: '#A855F7',
                    dark: '#7E22CE',
                },
                success: {
                    DEFAULT: '#10B981',
                    light: '#34D399',
                    dark: '#047857',
                },
                danger: {
                    DEFAULT: '#EF4444',
                    light: '#F87171',
                    dark: '#B91C1C',
                },
                warning: {
                    DEFAULT: '#F59E0B',
                    light: '#FBBF24',
                    dark: '#B45309',
                },
                info: {
                    DEFAULT: '#3B82F6',
                    light: '#60A5FA',
                    dark: '#1D4ED8',
                },
                neutral: {
                    light: '#F3F4F6',
                    DEFAULT: '#9CA3AF',
                    dark: '#4B5563',
                },
                background: {
                    light: '#F9FAFB',
                    DEFAULT: '#E5E7EB',
                    dark: '#111827',
                },
            },
        },
    },

    plugins: [forms, typography],
};
