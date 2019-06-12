<template>
	<v-flex xs12 sm6 offset-sm3>
		<v-card>
			<v-img
				src="../img/card-bg.jpg"
				aspect-ratio="2.75"
				class="white--text"
			>
				<v-container fill-height fluid>
					<v-layout fill-height align-end>
						<v-flex xs12>
							<span class="headline font-weight-light">May your force be with us</span>
						</v-flex>
					</v-layout>
				</v-container>
			</v-img>

			<v-card-text>
				<v-form
					v-model="valid"
					ref="curriculumForm"
				>
					<v-container>
						<v-layout column>
							<v-flex
								xs12
							>
								<v-text-field
									v-model="formData.name"
									:rules="rules.name"
									label="Nome*"
									outline
									prepend-icon="person"
									required
								></v-text-field>
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
							<v-flex
								xs12
							>
								<v-text-field
									v-model="formData.phone"
									:rules="rules.phone"
									mask="(##) ##### - ####"
									label="Celular*"
									outline
									required
								>
									<template v-slot:prepend>
											<div class="v-input__icon v-input__icon--prepend">
												<i aria-hidden="true" class="v-icon material-icons icon-whatsapp theme--light"></i>
											</div>
									</template>
								</v-text-field>
							</v-flex>
							<v-flex
								xs12
							>
								<v-text-field
									label="Linkedin"
									v-model="formData.linkedin"
									:rules="rules.linkedin"
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
									v-model="formData.github"
									:rules="rules.github"
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
									v-model="formData.filename"
									@click.native="onFocus"
									label="Currículo (pdf)*"
									outline
									prepend-icon="attach_file"
									ref="fileTextField"
									required
									:rules="rules.filename"
								/>
								<input
									:multiple="false"
									accept="application/pdf"
									@change="onFileChange"
									ref="fileInput"
									class="d-none"
									type="file"
								>
							</v-flex>
							<v-flex xs12>
								<v-select
									v-model="formData.areas"
									:items="options"
									:rules="rules.areas"
									label="Áreas de interesse*"
									multiple
									chips
									outline
									deletable-chips
									prepend-icon="work"
									small-chips
									required
								/>
							</v-flex>
							<v-flex
								xs12
							>
								<v-switch
									label="Estágio"
									v-model="formData.is_internship"
									color="primary"
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
				<v-tooltip top>
					<template v-slot:activator="{ on }">
						<v-btn
							v-on="on"
							@click="handleSubmit"
							absolute
							dark
							fab
							bottom
							right
							color="primary"
						>
							<v-progress-circular
								v-if="disableSubmit"
								indeterminate
							/>
							<v-icon v-else>send</v-icon>
						</v-btn>
					</template>
					<span>Enviar</span>
				</v-tooltip>
			</v-card-actions>
		</v-card>
	</v-flex>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
	components: {
		VueRecaptcha,
	},
	data() {
		return {
			sitekey: '6LfuXagUAAAAAHLGJo4BaJKb9lJ_hiBsYmrvXVHC',
			options: [
				'Front-end',
				'Back-end',
				'Administrativo',
				'Financeiro',
				'Cozinha',
				'Limpeza',
				'DevOps',
				'Design',
				'UI/UX'
			],
			valid: true,
			disableSubmit: false,
			formData: {
				areas: null,
				filename: '',
				name: '',
				email: '',
				phone: '',
				linkedin: '',
				github: '',
				is_internship: false,
				file: null,
				recaptcha_response: null,
			},
			rules: {
				name: [
					v => !!v || 'Esse campo é obrigatório',
					v => (v && v.length >= 10) || 'O nome precisa ter pelo menos 10 caracteres'
				],
				email: [
					v => !!v || 'Esse campo é obrigatório',
					v => {
						const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						return pattern.test(v) || 'O E-mail precisa ser válido';
					}
				],
				phone: [
					v => !!v || 'Esse campo é obrigatório',
					v => {
						const pattern = /^(1[2-9]{1})|([2-9]{1}\d{1})(9\d{8})$/;
						return pattern.test(v) || 'O número de celular precisa ser válido';
					}
				],
				github: [
					v => {
						if (v.length === 0) {
							return true;
						}
						const pattern = /^http(s)?:\/\/(www\.)?github\.com\/[A-z0-9_-]+\/?$/;
						return pattern.test(v) || 'O link do GitHub precisa ser válido';
					}
				],
				linkedin: [
					v => {
						if (v.length === 0) {
							return true;
						}
						const pattern = /^http(s)?:\/\/([\w]+\.)?linkedin\.com\/in\/[A-z0-9_-]+\/?$/;
						return pattern.test(v) || 'O link do LinkedIn precisa ser válido';
					}
				],
				filename: [
					v => !!v || 'Esse campo é obrigatório',
				],
				areas: [
					v => (!!v && v.length !== 0) || 'Escolha pelo menos uma área',
				],

			}
		}
	},

	methods: {
		getFormData(pdf){
			const data = new FormData();
			Object.keys(this.formData)
				.forEach(key => {
					data.append(key, this.formData[key]);
				});

			return data;
		},

		onFocus(){
			if (!this.disabled) {
				this.$refs.fileInput.click();
			}
		},

		onFileChange(){
			const pdf = this.$refs.fileInput.files[0];
			if (pdf) {
				this.formData.filename = pdf.name;
				this.formData.file = pdf;
			} else {
				this.formData.filename = null;
				this.formData.file = null;
			}
		},

		onVerifyRecaptcha(response) {
			this.formData.recaptcha_response = response;

			this.resetRecaptcha();

			console.log('Verify: ' + response)

			axios.post(
				'/curriculum',
				this.getFormData(),
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
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
			if (!this.disableSubmit && this.$refs.curriculumForm.validate()) {
				this.disableSubmit = true;
				this.$refs.invisibleRecaptcha.execute();
			}
		}
	}
}
</script>

<style>

</style>
