import CurriculumFormView from '../views/curriculumForm/CurriculumFormView.vue';
import LoginFormView from  '../views/loginForm/LoginFormView.vue';

export default [
	{
		path: '/',
		component: CurriculumFormView,
	},
	{
		path: '/login',
		component: LoginFormView,
	},
];
