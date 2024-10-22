import { createRouter, createWebHistory } from 'vue-router';
import Login from './src/components/Login.vue';
import UserList from './src/components/UsersList.vue'
import UserCreate from './src/components/CreateUser.vue';

const routes = [
    {
        path: '/',
        redirect: '/users',
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/users',
        name: 'UserList',
        component: UserList,
        meta: { requiresAuth: true },
    },
    {
        path: '/users/create',
        name: 'UserCreate',
        component: UserCreate,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('auth_token');

    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;
