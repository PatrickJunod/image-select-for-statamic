import laravel from 'laravel-vite-plugin';
import statamic from '@statamic/cms/vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        statamic(),
        laravel({
            input: [
                'resources/js/image-select.js',
                'resources/css/image-select.css'
            ],
            publicDirectory: 'dist',
        }),
    ],
});
