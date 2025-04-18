import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js','public/sw.js','public/register-service-worker.js'],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**'
            ],
            // valetTls: 'zenithbank.test',
        }),
    ]
});
