<template>
	<v-flex xs12>
		<v-toolbar
			app
			color="blue darken-4"
			dark
		>
			<v-toolbar-title>
				<v-img src="../img/logo.png" width="120"></v-img>

			</v-toolbar-title>
			<v-spacer/>

			<v-toolbar-items>
				<v-btn
					flat
					to="/login"
				>
					Login
				</v-btn>
			</v-toolbar-items>
		</v-toolbar>
		<curriculum-form-card class="mb-5 mt-5 pt-5"/>
	</v-flex>
</template>

<script>
import CurriculumFormCard from './components/CurriculumFormCard';

export default {
	components: {
		CurriculumFormCard
	},
}
</script>

<style>

</style>
