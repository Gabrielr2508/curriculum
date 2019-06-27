<template>
	<v-content class="grey lighten-2">
    	<v-container fluid fill-height>
        	<v-layout align-center justify-center>
				<login-form-card/>
        	</v-layout>
		</v-container>
	</v-content>
</template>

<script>
import LoginFormCard from './components/LoginFormCard';

export default {
	components: {
		LoginFormCard
	},
}
</script>

<style>

</style>
