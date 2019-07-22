<template>
	<v-flex xs12 sm8 md6 lg4>
		<v-card>
			<v-layout align-center justify-center>
				<v-flex xs8 offset-xs-2>
					<v-img
						class="mt-4"
						src="../img/logo.png"
						contain
						width="100%"
						position="center"
					/>
				</v-flex>
			</v-layout>

			<v-card-text>
				<v-form
					v-model="valid"
					ref="resetPasswordForm"
				>
					<v-container>
						<v-layout column>
                            <v-flex xs12 class="mb-3">
                                <v-alert
                                    :value="true"
                                    color="info"
                                    icon="info"
                                    outline
                                >
                                    Insira seu endereço de e-mail. Se houver uma conta cadastrada, você receberá um e-mail com mais instruções em breve.
                                </v-alert>
                            </v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									v-model="formData.email"
									:rules="rules.email"
									label="E-mail*"
									outline
									prepend-icon="email"
									required
								></v-text-field>
							</v-flex>
							<v-flex xs12>
								<span class="red--text caption">* campos obrigatórios</span>
							</v-flex>
							<vue-recaptcha
								:sitekey="sitekey"
								ref="invisibleRecaptcha"
								size="invisible"
								badge="bottomleft"
								@verify="onVerifyRecaptcha"
								@expired="resetRecaptcha"
							/>
						</v-layout>
					</v-container>
				</v-form>
			</v-card-text>
			<v-card-actions>
				<v-container>
					<v-layout justify-space-between>
						<v-btn
							@click="handleBackToLogin"
							dark
							flat
							color="primary"
						>
							Login
						</v-btn>
						<v-btn
							@click="handleSubmit"
							color="primary"
							:disabled="disableSubmit"
						>
							<v-progress-circular
								v-if="disableSubmit"
								color="primary"
								indeterminate
							/>
							<span v-else>Enviar</span>
						</v-btn>
					</v-layout>
				</v-container>
			</v-card-actions>
		</v-card>
	</v-flex>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
import validators from '../../../common/validators';

export default {
	components: {
		VueRecaptcha,
    },

	data() {
		return {
			showPassword: false,
			sitekey: process.env.MIX_SITE_KEY,
			valid: true,
			disableSubmit: false,
			formData: {
				email: '',
				recaptcha_response: null,
			},
			rules: {
				...validators,
			}
		}
	},

	methods: {
		onVerifyRecaptcha(response) {
			this.formData.recaptcha_response = response;

			this.resetRecaptcha();

			console.log('Verify: ' + response)

			axios.post(
				'/auth',
				this.formData,
			)
			.then((response) => {
				console.log(response);
			})
			.catch((error) => {
				console.log(error.response);
			})
			.then(() => {
				this.disableSubmit = false;
			});
		},

		resetRecaptcha() {
			this.$refs.invisibleRecaptcha.reset();
		},

		handleSubmit() {
			if (!this.disableSubmit && this.$refs.resetPasswordForm.validate()) {
				this.disableSubmit = true;
				this.$refs.invisibleRecaptcha.execute();
			}
		},

		handleBackToLogin() {
            this.$refs.resetPasswordForm.reset();
			this.$emit('toggleResetForm');
        }
	}
}
</script>

<style>

</style>
