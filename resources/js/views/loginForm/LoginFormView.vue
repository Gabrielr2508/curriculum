<template>
	<v-content class="grey lighten-2">
    	<v-container fluid fill-height>
        	<v-layout align-center justify-center>
				<reset-password-form-card
					v-if="showResetForm"
					@toggleResetForm="toggleResetForm"
				/>

				<login-form-card
					v-else
					@toggleResetForm="toggleResetForm"
				/>
        	</v-layout>
		</v-container>
	</v-content>
</template>

<script>
import LoginFormCard from './components/LoginFormCard';
import ResetPasswordFormCard from './components/ResetPasswordFormCard';

export default {
	components: {
		LoginFormCard,
		ResetPasswordFormCard,
	},

	data() {
		return {
			showResetForm: false,
		};
	},

	methods: {
		toggleResetForm() {
			this.showResetForm = !this.showResetForm;
		},
	}
}
</script>

<style>

</style>
