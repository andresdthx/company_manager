/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('index-company', require('./components/Company/Index.vue').default);
Vue.component('create-company', require('./components/Company/CreateCompany.vue').default);
Vue.component('edit-company', require('./components/Company/EditCompany.vue').default);
Vue.component('show-logo', require('./components/Company/ShowLogo.vue').default);

Vue.component('index-employee', require('./components/Employee/Index.vue').default);
Vue.component('create-employee', require('./components/Employee/CreateEmployee.vue').default);
Vue.component('edit-employee', require('./components/Employee/EditEmployee.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
