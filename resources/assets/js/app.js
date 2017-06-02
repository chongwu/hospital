
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import MaskedInput from 'vue-text-mask';
import Datepicker from 'vuejs-datepicker';
Vue.component('masked-input', MaskedInput);
Vue.component('datepicker', Datepicker);
Vue.component('type-table', require('./components/TypeTable.vue'));
Vue.component('doctors', require('./components/Doctors.vue'));
Vue.component('appointment-form', require('./components/AppointmentForm.vue'));

const app = new Vue({
    el: '#app'
});
