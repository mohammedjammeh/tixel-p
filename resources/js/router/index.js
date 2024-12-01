import { createRouter, createWebHistory } from 'vue-router';

import home from '../components/Home.vue';
import about from '../components/About.vue';
import notFound from '../components/NotFound.vue';

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/about',
        component: about
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



