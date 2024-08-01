import { createRouter, createWebHistory } from 'vue-router';
import DashboardLayout from '../components/DashboardLayout.vue';
import Login from '../views/Login.vue';

import Category from '../views/admin/Category/index.vue';
import Post from '../views/admin/Post/index .vue';
import Homepage from '../views/client/Homepage.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
import Blank from '@/views/admin/Example/Blank.vue';
const routes = [
  {
    path: '/admin',
    name: '',
    component: DashboardLayout,
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: Blank,
      },
      {
        path: 'categories',
        name: 'categories',
        children: [
          {
            path: '',
            name: 'categories.index',
            component: Category,
          },
          {
            path: 'create',
            name: 'categories.create',
            component: () => import('@/views/admin/Category/create.vue'),
          },
          {
            path: ':id',
            name: 'categories.update',
            component: () => import('@/views/admin/Category/update.vue'),
          },
        ],
      },
      {
        path: 'post',
        name: 'post',
        children: [
          {
            path: '',
            name: 'post.index',
            component: Post,
          },
          {
            path: 'create',
            name: 'post.create',
            component: () => import('@/views/admin/Post/create.vue'),
          },
          {
            path: ':id',
            name: 'post.update',
            component: () => import('@/views/admin/Post/update.vue'),
          },
        ],
      },
      {
        path: 'forms',
        name: 'Forms',
        component: Blank,
      },
      {
        path: 'cards',
        name: 'Cards',
        component: Blank,
      },
      {
        path: 'tables',
        name: 'Tables',
        component: Blank,
      },
      {
        path: 'ui-elements',
        name: 'UIElements',
        component: Blank,
      },
      {
        path: 'modal',
        name: 'Modal',
        component: Blank,
      },
      {
        path: 'blank',
        name: 'Blank',
        component: Blank,
      },
    ],
  },
  {
    path: '/',
    name: '',
    component: DefaultLayout,
    children: [
      {
        path: '',
        name: '',
        component: Homepage,
      },
    ],
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
