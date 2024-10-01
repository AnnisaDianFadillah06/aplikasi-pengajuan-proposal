import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/soft-ui-dashboard-tailwind.css',
                'resources/js/soft-ui-dashboard-tailwind.js',
                'resources/css/app.css',  // Jika kamu sudah menggunakan CSS Laravel
                'resources/js/app.js',   // Jika kamu sudah menggunakan JS Laravel
            ],
            refresh: true,
        }),
    ],
});
