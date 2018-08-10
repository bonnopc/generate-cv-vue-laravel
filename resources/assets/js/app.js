
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');
Vue.prototype.$appName = "Hello"
Vue.prototype.$hub = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// Pages
Vue.component('index-component', require('./components/pages/index.vue'));
Vue.component('test-parent-component', require('./components/pages/test/parent.vue'));
Vue.component('test-child-component', require('./components/pages/test/child.vue'));
Vue.component('test-grand-child-component', require('./components/pages/test/grand-child.vue'));

// Included Files
Vue.component('navbar-component', require('./components/inc/navbar.vue'));
Vue.component('footer-component', require('./components/inc/footer.vue'));
Vue.component('alert-component', require('./components/inc/alerts.vue'));
Vue.component('bottom-navbar-component', require('./components/inc/bottomNavbar.vue'));

// Layouts
Vue.component('app-component', require('./components/layouts/userApp.vue'));

// User Files
Vue.component('dashboard-component', require('./components/user/dashboard.vue'));

// Pages
Vue.component('overview-component', require('./components/pages/overview.vue'));
Vue.component('themes-component', require('./components/pages/themes.vue'));
Vue.component('settings-component', require('./components/pages/settings.vue'));

// Input Forms
Vue.component('basic-info-component', require('./components/input-forms/basicInfo.vue'));
Vue.component('career-info-component', require('./components/input-forms/careerInfo.vue'));

// window.eventHub = new Vue();


// exports.eventHub = eventHub;


const app = new Vue({
    el: '#app'
});

