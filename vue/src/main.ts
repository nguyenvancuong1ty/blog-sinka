import { createApp } from 'vue';
import App from './App.vue';
import './assets/main.css';
import { createPinia } from 'pinia';
import router from './router';
import { library } from '@fortawesome/fontawesome-svg-core';
import {
  faBars,
  faUser,
  faMagnifyingGlass,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/reset.css';

library.add(faBars, faUser, faMagnifyingGlass);

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(Antd);
app.use(createPinia());
app.use(router);

app.mount('#app');
