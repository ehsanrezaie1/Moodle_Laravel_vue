require('./bootstrap');

window.Vue = require('vue');

//import Vue from 'vue'

import HighchartsVue from "highcharts-vue";
Vue.use(HighchartsVue);

import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
