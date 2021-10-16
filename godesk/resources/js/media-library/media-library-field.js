import VuejsClipper from 'vuejs-clipper';
import IndexField from './components/fields/IndexField';
import DetailField from './components/fields/DetailField';
import FormField from './components/fields/FormField';

Nova.booting((Vue, router) => {
    Vue.use(VuejsClipper);
    Vue.component('index-media-library-field', IndexField);
    Vue.component('detail-media-library-field', DetailField);
    Vue.component('form-media-library-field', FormField);
});