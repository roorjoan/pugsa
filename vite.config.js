import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // 1. Importa el plugin

export default defineConfig({
    plugins: [
        tailwindcss(), // 2. Agrega el plugin antes o después de laravel()
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
