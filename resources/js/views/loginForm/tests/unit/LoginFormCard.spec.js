import { shallowMount } from '@vue/test-utils';
import Vue from 'vue';
import Vuetify from 'vuetify';

import LoginFormCard from '@/views/loginForm/components/LoginFormCard';
import VueRecaptcha from 'vue-recaptcha';

Vue.use(Vuetify);

describe('LoginFormCard', () => {
    const build = () => {
        const wrapper = shallowMount(LoginFormCard);

        return {
            wrapper,
            vueRecaptcha: () => wrapper.find(VueRecaptcha),
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
        const { vueRecaptcha } = build();

        // assert
        expect(vueRecaptcha().exists()).toBe(true);
    });

    it('passes a binded sitekey prop to vue-recaptcha component', () => {
        // arrange
        const { wrapper, vueRecaptcha } = build();

        wrapper.setData({
            sitekey: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        });

        // assert
        expect(vueRecaptcha().vm.sitekey).toBe(wrapper.vm.sitekey);
    });
});
