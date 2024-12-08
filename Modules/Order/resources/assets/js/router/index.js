import { createRouter, createWebHistory } from "vue-router";

import orders from "../components/orders.vue";

const routes = [
    {
        path: "/",
        component: orders,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
