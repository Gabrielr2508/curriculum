<template>
	<v-app>
		<router-view />
	</v-app>
</template>

<script>
import { mapMutations } from 'vuex';

export default {
	name: 'Root',

	created() {
		const { content: authenticated } = document.querySelector('meta[name="authenticated"]');
		this.setAuthenticated(!!Number(authenticated));
	},

	methods: mapMutations('auth', ['setAuthenticated']),
};
</script>
