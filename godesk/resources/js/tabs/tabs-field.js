import DetailField from './components/DetailTabs';
import FormTabs from './components/FormTabs';

Nova.booting((Vue, router) => {
    Vue.component('detail-tabs', DetailField);
    Vue.component('form-tabs', FormTabs);
})
