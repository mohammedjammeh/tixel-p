import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    build: {
        outDir: "../../public/build-order",
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: "../../public",
            buildDirectory: "build-order",
            input: [
                __dirname + "/resources/assets/css/app.css",
                __dirname + "/resources/assets/sass/app.scss",
                __dirname + "/resources/assets/js/app.js",
            ],
            refresh: true,
        }),
        vue(),
    ],
});
