import { createRouter, createWebHistory } from "vue-router";

import Dashboard from '../views/Dashboard'

const routes = [
    {
        path: '/',
        component: Dashboard,
        name: 'Dashboard'
    }
]

export default createRouter({
    history: createWebHistory(),
    routes

})