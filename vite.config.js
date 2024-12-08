import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
});

// import {defineConfig} from 'vite';
// import laravel from 'laravel-vite-plugin';
// import collectModuleAssetsPaths from './vite-module-loader.js';
// import vue from '@vitejs/plugin-vue';
//
// async function getConfig() {
//     const paths = [
//         'resources/css/app.css',
//         'resources/js/app.js',
//         // 'Modules/Blog/resources/assets/sass/app.scss',
//         // 'Modules/Blog/resources/assets/js/app.js',
//     ];
//     const allPaths = await collectModuleAssetsPaths(paths, 'Modules');
//
//     return defineConfig({
//         plugins: [
//             laravel({
//                 input: allPaths,
//                 refresh: true,
//             }),
//             vue(),
//         ]
//     });
// }

// export default getConfig();

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue';
//
// export default defineConfig({
//     build: {
//         outDir: '../../public/build-order',
//         emptyOutDir: true,
//         manifest: true,
//     },
//     plugins: [
//         laravel({
//             publicDirectory: '../../public',
//             buildDirectory: 'build-order',
//             input: [
//                 __dirname + '/resources/assets/sass/app.scss',
//                 __dirname + '/resources/assets/js/app.js'
//             ],
//             refresh: true,
//         }),
//         vue(),
//     ],
// });
