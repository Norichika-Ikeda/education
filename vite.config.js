import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/user.css',
                'resources/css/admin.css',
                'resources/js/user.js',
                'resources/js/admin.js',
            ],
            refresh: true,
        }),
    ],
});
