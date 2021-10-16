import DetailField from './components/DetailField';
import TableField from './components/FormFields/TableField';

Nova.booting((Vue, router, store) => {
    Vue.component('detail-table-field', DetailField);
    Vue.component('form-table-field', TableField);
});