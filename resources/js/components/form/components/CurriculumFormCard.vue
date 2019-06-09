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
									v-model="filename"
									@click.native="onFocus"
									label="Currículo (pdf)*"
									outline
									prepend-icon="attach_file"
									ref="fileTextField"
								/>
								<input
									:multiple="false"
									:accept="accept"
									@change="onFileChange"
									ref="fileInput"
									class="d-none"
									type="file"
								>
							</v-flex>
							<v-flex xs12>
								<v-select
									v-model="areas"
									:items="options"
									label="Áreas de interesse"
									multiple
									chips
									outline
									deletable-chips
									prepend-icon="work"
									small-chips
								/>
							</v-flex>
							<v-flex
								xs12
							>
								<v-switch
									label="Estágio"
									color="primary"
								/>
							</v-flex>
							<v-flex xs12>
								<v-subheader class="red--text">* campos obrigatórios</v-subheader>
							</v-flex>
						</v-layout>
					</v-container>
				</v-form>
			</v-card-text>
			<v-card-actions>
				<v-btn
					absolute
					dark
					fab
					bottom
					right
					color="primary"
					>
					<v-icon>send</v-icon>
				</v-btn>
			</v-card-actions>
		</v-card>
	</v-flex>
</template>

<script>
export default {
	data() {
		return {
			card_text: 'Test',
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
			areas: [],
			filename: '',
		}
	},

	methods: {
		getFormData(files){
			const data = new FormData();
			[...files].forEach(file => {
				data.append('data', file, file.name); // currently only one file at a time
			});
			return data;
		},

		onFocus(){
			if (!this.disabled) {
				this.$refs.fileInput.click();
			}
		},

		onFileChange($event){
			const files = $event.target.files || $event.dataTransfer.files;
			const form = this.getFormData(files);

			if (files) {
				if (files.length > 0) {
					this.filename = [...files].map(file => file.name).join(', ');
				} else {
					this.filename = null;
				}
			} else {
				this.filename = $event.target.value.split('\\').pop();
			}

			this.$emit('input', this.filename);
			this.$emit('formData', form);
		}
	}
}
</script>

<style>

</style>
