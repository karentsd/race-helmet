import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/template.css',
                'resources/css/home.css',
                'resources/css/catalog.css',
                'resources/css/us.css',
                'resources/css/support.css',
                'resources/css/messages.css',
                'resources/css/cart.css',
                'resources/js/template.js',
                'resources/js/home.js',
                'resources/js/catalog.js',
                'resources/js/us.js',
                'resources/js/support.js',
                'resources/js/messages.js',
                'resources/js/cart.js',
            ],
            refresh: true,
        }),
    ],
});