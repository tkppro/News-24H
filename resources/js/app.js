require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'
import router from './router/route'
import { store } from './store/store'
import {datePlugin} from './plugins/date'

Vue.use(datePlugin);
Vue.config.productionTip = false;



const app = new Vue({
    store,
    router,
    render: h => h(App)
}).$mount('#app');
