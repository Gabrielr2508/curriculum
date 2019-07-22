<template>
	<v-flex xs12 sm6>
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
					ref="loginForm"
				>
					<v-container>
						<v-layout column>
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
							<v-flex
								xs12
							>
								<v-text-field
									v-model="formData.password"
									:rules="rules.password"
									:type="showPassword ? 'text' : 'password'"
									:append-icon="showPassword ? 'visibility' : 'visibility_off'"
									prepend-icon="vpn_key"
									label="Senha*"
									outline
									@click:append="showPassword = !showPassword"
								/>
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
							@click="handleForgotPassword"
							dark
							flat
							color="primary"
						>
							Resetar senha
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
							<span v-else>Login</span>
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
import { mapMutations } from 'vuex';

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
				password: '',
				recaptcha_response: null,
			},
			rules: {
				...validators,
			}
		}
	},

	methods: {
		...mapMutations('auth', ['setAuthenticated']),

		onVerifyRecaptcha(response) {
			this.formData.recaptcha_response = response;

			this.resetRecaptcha();

			axios.post(
				'/auth',
				this.formData,
			)
			.then(() => this.setAuthenticated(true))
			.catch((error) => {
				console.log(error.response);
			})
			.finally(() => {
				this.disableSubmit = false;
			});
		},

		resetRecaptcha() {
			this.$refs.invisibleRecaptcha.reset();
		},

		handleSubmit() {
			if (!this.disableSubmit && this.$refs.loginForm.validate()) {
				this.disableSubmit = true;
				this.$refs.invisibleRecaptcha.execute();
			}
		},

		handleForgotPassword() {
			this.$emit('toggleResetForm');
		}
	}
}
</script>

<style>

</style>
