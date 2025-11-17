import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // <-- Đảm bảo dòng này có
                'resources/js/app.js',   // Nếu bạn có JS
            ],
            refresh: true,
        }),
    ],
});
