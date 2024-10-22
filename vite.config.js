import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        hmr: {
            host: "localhost",
        },
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'], // Add your CSS files here
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js/src',
        },
    },
});
