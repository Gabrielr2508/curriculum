
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router'

import Root from './Root';

import routes from './routes';
import store from './store';

const router = new VueRouter({
	mode: 'history',
	routes, // short for `routes: routes`
});

Vue.use(VueRouter);

Vue.use(Vuetify, {
	icons: {
		'linkedin': 'icon-linkedin',
		'linkedin-box': 'icon-linkedin1',
		'whatsapp': 'icon-whatsapp',
		'github': 'icon-github',
	}
});

const app = new Vue({
	el: '#app',
	components: { Root },
	template: '<Root/>',
	router,
	store,
});
