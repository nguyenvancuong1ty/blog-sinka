import { createRouter, createWebHistory } from 'vue-router';
import DashboardLayout from '../components/DashboardLayout.vue';
import Dashboard from '../views/Dashboard.vue';
import Forms from '../views/Forms.vue';
import Card from '../views/Card.vue';
import Tables from '../views/Tables.vue';
import UIElements from '../views/UIElements.vue';
import Modal from '../views/Modal.vue';
import Blank from '../views/Blank.vue';
import Login from '../views/Login.vue';
import Homepage from '../views/client/Homepage.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
const routes = [
  {
    path: '/admin',
    name: '',
    component: DashboardLayout,
    children: [
      {
        path: 'dashboard',
        name: 'Dashboard',
        component: Dashboard,
      },
      {
        path: 'forms',
        name: 'Forms',
        component: Forms,
      },
      {
        path: 'cards',
        name: 'Cards',
        component: Card,
      },
      {
        path: 'tables',
        name: 'Tables',
        component: Tables,
      },
      {
        path: 'ui-elements',
        name: 'UIElements',
        component: UIElements,
      },
      {
        path: 'modal',
        name: 'Modal',
        component: Modal,
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
