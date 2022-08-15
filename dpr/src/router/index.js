import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/news/:slug',
        name: 'news',
        component: () => import('../views/NewsView.vue')
    },
    {
        path: '/aspiration',
        name: 'aspiration',
        component: () => import('../views/AspirationView.vue')
    },
    {
        path: '/report',
        name: 'report',
        component: () => import('../views/ReportView.vue')
    }]
})

export default router
