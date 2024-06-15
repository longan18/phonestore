import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/common.scss',
                'resources/scss/client/top-bar.scss',
                'resources/scss/client/item-product.scss',
                'resources/scss/client/parameter-item.scss',
            ],
            refresh: true,
        }),
    ],
});
