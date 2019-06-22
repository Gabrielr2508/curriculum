import { shallowMount } from '@vue/test-utils';
import Vue from 'vue';
import Vuetify from 'vuetify';

import CurriculumFormView from '@/views/curriculumForm/CurriculumFormView';
import CurriculumFormCard from '@/views/curriculumForm/components/CurriculumFormCard';

Vue.use(Vuetify);

describe('CurriculumFormView', () => {
    const build = () => {
        const wrapper = shallowMount(CurriculumFormView);

        return {
            wrapper,
            curriculumFormCard: () => wrapper.find(CurriculumFormCard),
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
        const { curriculumFormCard } = build();

        // assert
        expect(curriculumFormCard().exists()).toBe(true);
    });
});
