require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import routes from './routes';
import dataStore from './store/index';

import VueGoodTable from 'vue-good-table';
import VueGoodTablePlugin from 'vue-good-table';
// import the styles
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTable);
Vue.use(VueGoodTablePlugin);



Vue.use(ElementUI);
Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(dataStore);
const router = new VueRouter(routes);


// Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('header-component', require('./components/Header.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);
Vue.component('app-component', require('./components/App.vue').default);
Vue.component('admin-sidebar', require('./components/AdminSidebar.vue').default);


const app = new Vue({
    el: '#app',
    store:store,
    router: router
});
