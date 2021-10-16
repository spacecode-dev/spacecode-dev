import VueOrder from 'vue'
import VueContact from 'vue'
import VuePrice from 'vue'
import VueOrderStep from 'vue'
import VueOrderModal from 'vue'
import i18n from './i18n'
import VueInputMask from 'vue-inputmask'
import Notifications from 'vue-notification'
import ToggleButton from 'vue-js-toggle-button'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

let order = document.getElementById('orderFormDiv')
let modalOrder = document.getElementById('orderFormModalDiv')
let contact = document.getElementById('contactFormDiv')
let price = document.getElementById('priceTableDiv')
let stepOrder = document.getElementById('orderFormStepDiv')

if(order) {
    VueOrder.use(Notifications)
    VueOrder.use(VueInputMask.default)
    VueOrder.use(VueSweetalert2)
    VueOrder.component('order-form', require('./components/orderForm').default)
    new VueOrder({ i18n }).$mount('#orderFormDiv')
}

if(modalOrder) {
    VueOrderModal.use(Notifications)
    VueOrderModal.use(VueInputMask.default)
    VueOrderModal.component('order-form-modal', require('./components/orderFormModal').default)
    new VueOrder({ i18n }).$mount('#orderFormModalDiv')
}

if(contact) {
    VueContact.use(Notifications)
    VueContact.component('contact-form', require('./components/contactForm').default)
    new VueContact({ i18n }).$mount('#contactFormDiv')
}

if(price) {
    VuePrice.use(ToggleButton)
    VuePrice.component('price-table', require('./components/priceTable').default)
    new VuePrice({ i18n }).$mount('#priceTableDiv')
}

if(stepOrder) {
    VueOrderStep.use(Notifications)
    VueOrderStep.component('modal-order-form', require('./components/orderFormStep').default)
    new VueOrderStep({ i18n }).$mount('#orderFormStepDiv')
}