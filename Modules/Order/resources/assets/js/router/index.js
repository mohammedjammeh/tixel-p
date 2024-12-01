import { createRouter, createWebHistory } from 'vue-router';

import home from '../components/Haha.vue';
// import about from '../components/About.vue';
import order from '../components/Order.vue';
// import notFound from '../components/NotFound.vue';

const routes = [
    {
        path: '/',
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



