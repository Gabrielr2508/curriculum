import { shallowMount } from '@vue/test-utils';
import Vue from 'vue';
import Vuetify from 'vuetify';

import LoginFormView from '@/views/loginForm/LoginFormView';
import LoginFormCard from '@/views/loginForm/components/LoginFormCard';

Vue.use(Vuetify);

describe('LoginFormView', () => {
    const build = () => {
        const wrapper = shallowMount(LoginFormView);

        return {
            wrapper,
            loginFormCard: () => wrapper.find(LoginFormCard),
        }
    }

    it('renders the component', () => {
        // arrange
        const { wrapper } = build();

        // assert
        expect(wrapper.html()).toMatchSnapshot();
    });

    it('renders main child components', () => {
        // arrange
        const { loginFormCard } = build();

        // assert
        expect(loginFormCard().exists()).toBe(true);
    });
});
