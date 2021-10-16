import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
import FormField from './components/FormField';

Nova.booting((Vue, router) => {
    Vue.component('index-toggle', IndexField);
    Vue.component('detail-toggle', DetailField);
    Vue.component('form-toggle', FormField);
})