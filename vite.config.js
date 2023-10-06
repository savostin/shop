import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import * as path from 'path';


export default defineConfig({
    build: {
        rollupOptions: {
            output: {
                entryFileNames: `assets/[name].js`,
                chunkFileNames: `assets/[name].js`,
                assetFileNames: `assets/[name].[ext]`
            }
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/images'),
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
