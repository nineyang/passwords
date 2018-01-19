/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
window.Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        selected: 0,
        passwordList: [],
    },
    mutations: {
        updateSelected(state, id){
            state.selected = id;
        },
        updatePasswordList(state, list){
            state.passwordList = list;
        }
    },
    actions: {},
    getters: {
        selected (state) {
            return state.selected;
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('common-panel', require('./components/Common/Panel.vue'));
Vue.component('box-add', require('./components/Box/Add.vue'));
Vue.component('box-li', require('./components/Box/Li.vue'));
Vue.component('box-modal', require('./components/Box/Modal.vue'));
Vue.component('password-li', require('./components/Password/Li.vue'));
Vue.component('password-modal', require('./components/Password/Modal.vue'));
Vue.component('password-caption', require('./components/Password/Caption.vue'));
Vue.component('home-plus', require('./components/Home/Plus.vue'));

Vue.directive('tooltip', function(el, binding){
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: 'hover'
    })
})

const app = new Vue({
    el: '#app',
    store
});
