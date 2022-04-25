require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import store from './store';
import common from './common'

import App from './app/mainapp.vue';

createApp(App).use(common).use(router).use(store).mount('#app')