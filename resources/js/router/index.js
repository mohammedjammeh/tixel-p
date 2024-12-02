import { createRouter, createWebHistory } from 'vue-router';

import home from '../components/Home.vue';
import about from '../components/About.vue';
import order from '../components/Order.vue';
import notFound from '../components/NotFound.vue';

const routes = [
    // {
    //     path: '/',
    //     component: home
    // },
    // {
    //     path: '/about',
    //     component: about
    // },
    // {
    //     path: '/order',
    //     component: order
    // },
    // {
    //     path: '/:pathMatch(.*)*',
    //     component: notFound
    // }ha
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;



