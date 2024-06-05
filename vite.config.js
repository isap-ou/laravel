import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import viteFaviconPlugin from "./cli/vite/favicons.js";
import webfontDownload from 'vite-plugin-webfont-dl';
import lightningcss from "vite-plugin-lightningcss";
import viteCompression from 'vite-plugin-compression';
import viteI18NPlugin from "./cli/vite/i18n.js";
import vue from '@vitejs/plugin-vue';
import path from "path";

export default defineConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    plugins: [
        viteI18NPlugin(),
        viteFaviconPlugin(),
        viteCompression({
            algorithm: "gzip"
        }),
        webfontDownload(
            'https://fonts.googleapis.com/css2?family=Philosopher:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap',
        ),
        lightningcss({
            browserslist: "last 2 versions",
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
