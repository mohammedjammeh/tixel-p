import { createRouter, createWebHistory } from 'vue-router';

import haha from '../components/Haha.vue';

const routes = [
    {
        path: '/haha',
        component: haha
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;



