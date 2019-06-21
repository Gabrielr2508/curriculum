import { shallowMount, createLocalVue } from '@vue/test-utils';
import Vue from 'vue';
import Vuetify from 'vuetify';

import CurriculumFormView from '@/components/form/CurriculumFormView';

Vue.use(Vuetify);

describe('CurriculumFormView', () => {
    it('renders the component', () => {
        // arrange
        const wrapper = shallowMount(CurriculumFormView);

        // assert
        expect(wrapper.html()).toMatchSnapshot();
    });
});
