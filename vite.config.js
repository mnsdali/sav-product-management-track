import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/style2.css',
                'resources/css/style3.css',
                'resources/css/reclamationCard.css',
                'resources/css/dashboard_sidebar.css',
                'resources/css/reclamation_crud.css',
                'resources/css/modals.css',

                'resources/js/app.js',
                'resources/js/script.js',
                'resources/css/cmds_style.css',
                'resources/js/cmds_script.js',
                'resources/css/revendeur_crud.css',
                'resources/js/revendeur_crud.js',
                'resources/js/client_crud.js',
                'resources/js/client_create_script.js',
                'resources/js/reclamation_crud.js',

            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
