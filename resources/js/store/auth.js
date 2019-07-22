import { set } from 'vue';

export default {
	namespaced: true,

	state: {
		authenticated: false,
	},

	mutations: {
		setAuthenticated(state, authenticated) {
			set(state, 'authenticated', authenticated);
		},
	},
};
