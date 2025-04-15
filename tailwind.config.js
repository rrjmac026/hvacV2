import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Enable dark mode with class strategy
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                vet: {
                    primary: {
                        50: '#f0fdfd',
                        100: '#ccfbfb',
                        200: '#99f6f6',
                        300: '#5ceded',
                        400: '#2ce0e0',
                        500: '#1aa7a7',
                        600: '#138585',
                        700: '#0d6363',
                    },
                    secondary: {
                        50: '#f0f9ff',
                        100: '#e0f2fe',
                        200: '#b9e6fe',
                        300: '#7cc7ff',
                        400: '#36a6ff',
                        500: '#0c8ce9',
                        600: '#0072c6',
                        700: '#005ea3',
                    },
                    accent: {
                        50: '#fdf2f8',
                        100: '#fce7f3',
                        200: '#fbcfe8',
                        300: '#f9a8d4',
                        400: '#f472b6',
                        500: '#e74694',
                        600: '#d61f69',
                        700: '#bf125d',
                    },
                    success: '#059669',
                    warning: '#d97706',
                    danger: '#dc2626',
                    light: {
                        bg: '#F9FAFB',
                        card: '#FFFFFF',
                        hover: '#F3F4F6',
                        border: '#E5E7EB',
                        text: {
                            primary: '#111827',
                            secondary: '#4B5563'
                        }
                    },
                    dark: {
                        bg: '#121826',
                        card: '#1F2937',
                        hover: '#2d303a',
                        border: '#4B5563',
                        text: {
                            primary: '#F9FAFB',
                            secondary: '#D1D5DB'
                        }
                    }
                },
                'vet-primary': {
                    50: '#f0fdfa',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#14b8a6',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a'
                },
                'vet-secondary': {
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb'
                },
                'vet-light': {
                    bg: '#f9fafb',
                    card: '#ffffff',
                    border: '#e5e7eb',
                    'text-primary': '#111827',
                    'text-secondary': '#6b7280',
                },
                'vet-dark': {
                    bg: '#111827',
                    card: '#1f2937',
                    border: '#374151',
                    'text-primary': '#f9fafb',
                    'text-secondary': '#9ca3af',
                }
            },
            backgroundImage: {
                'vet-pattern': "linear-gradient(30deg, #f3f4f8 12%, transparent 12.5%, transparent 87%, #f3f4f8 87.5%, #f3f4f8), linear-gradient(150deg, #f3f4f8 12%, transparent 12.5%, transparent 87%, #f3f4f8 87.5%, #f3f4f8), linear-gradient(30deg, #f3f4f8 12%, transparent 12.5%, transparent 87%, #f3f4f8 87.5%, #f3f4f8), linear-gradient(150deg, #f3f4f8 12%, transparent 12.5%, transparent 87%, #f3f4f8 87.5%, #f3f4f8), linear-gradient(60deg, #eef2f677 25%, transparent 25.5%, transparent 75%, #eef2f677 75%, #eef2f677), linear-gradient(60deg, #eef2f677 25%, transparent 25.5%, transparent 75%, #eef2f677 75%, #eef2f677)",
                backgroundSize: '80px 140px',
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            boxShadow: {
                'soft': '0 2px 4px 0 rgba(0, 0, 0, 0.05)',
                'soft-lg': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                'vet': '0 2px 4px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03)',
                'vet-lg': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
            },
            transitionProperty: {
                'colors': 'color, background-color, border-color, text-decoration-color, fill, stroke'
            },
            transitionDuration: {
                '250': '250ms'
            }
        },
    },

    plugins: [forms],
};
