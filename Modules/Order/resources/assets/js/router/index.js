import { createRouter, createWebHistory } from 'vue-router';

import home from '../components/Home.vue';
import order from '../components/Order.vue';

import notFound from '../components/NotFound.vue';

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/order',
        component: order
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;



