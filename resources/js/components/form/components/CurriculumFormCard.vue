<template>
	<v-flex xs12 sm6 offset-sm3>
		<v-card>
			<v-card-title primary-title>
			</v-card-title>
			<v-card-text>
				<v-form>
					<v-container>
						<v-layout column>
							<v-flex
								xs12
							>
								<v-text-field
									label="Nome*"
									outline
									prepend-icon="person"
								></v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="E-mail*"
									outline
									prepend-icon="email"
								></v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="Telefone*"
									outline
									prepend-icon="call"
								></v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="Linkedin"
									outline
								>
									<template v-slot:prepend>
											<div class="v-input__icon v-input__icon--prepend">
												<i aria-hidden="true" class="v-icon material-icons icon-linkedin1 theme--light"></i>
											</div>
									</template>
								</v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="GitHub"
									outline
								>
									<template v-slot:prepend>
											<div class="v-input__icon v-input__icon--prepend">
												<i aria-hidden="true" class="v-icon material-icons icon-github theme--light"></i>
											</div>
									</template>
								</v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="Currículo (pdf)*"
									outline
									prepend-icon="attach_file"
								>
								</v-text-field>
							</v-flex>
						</v-layout>
					</v-container>
				</v-form>
			</v-card-text>
			<v-card-actions>
				<v-btn flat color="orange">Share</v-btn>
				<v-btn flat color="orange">Explore</v-btn>
			</v-card-actions>
		</v-card>
	</v-flex>
</template>

<script>
export default {
	data() {
		return {
			card_text: 'Test',
		}
	},
}
</script>

<style>

</style>
