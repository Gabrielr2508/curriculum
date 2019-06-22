export default {
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