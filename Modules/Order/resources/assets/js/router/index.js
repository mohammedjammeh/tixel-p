import { createRouter, createWebHistory } from 'vue-router';

import home from '../components/Home.vue';
import order from '../components/Order.vue';

// import notFound from '../components/NotFound.vue';

const routes = [
    {
        path: '/home',
        component: home
    },
    {
        path: '/order',
        component: order
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;



