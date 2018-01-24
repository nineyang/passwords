/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        selectedBox: 0,
        passwordList: {},
        passwordCount: {},
        deletedPasswordList: {},
        selectedPassword: 0,
        deletePassword: 0,
        // 查看密码时的弹框类型
        passwordModal: {
            type: 'password',
            error: {
                info: '',
                password: false,
                code: false
            },
            mainPassword: '',
            code: ''
        }
    },
    mutations: {
        updateSelectedBox(state, id){
            state.selectedBox = id;
        },
        initPasswordList(state, list){
            state.passwordList = {};
            list.map((pwd) => {
                state.passwordList[pwd.id] = pwd;
            });
        },
        updatePasswordList(state, password){
            let tmp = state.passwordList;
            state.passwordList = {};
            tmp[password.id] = password;
            state.passwordList = tmp;
        },
        deletePasswordList(state, id){
            let tmp = state.passwordList;
            state.passwordList = {};
            delete tmp[id];
            state.passwordList = tmp;
        },
        updatePasswordAccount(state, payload){
            if (payload.count > 99) {
                return '99+';
            }
            let tmp = state.passwordCount;
            state.passwordCount = {};
            tmp[payload.id] = payload.count;
            state.passwordCount = tmp;
        },
        updateSelectedPassword(state, id){
            state.selectedPassword = id;
        },
        updateDeletePassword(state, id){
            state.deletePassword = id;
        },
        initDeletedPasswordList(state, list){
            state.deletedPasswordList = {};
            list.map((pwd) => {
                state.deletedPasswordList[pwd.id] = pwd;
            });
        },
        addDeletedPasswordList(state, password){
            let tmp = state.deletedPasswordList;
            state.deletedPasswordList = {};
            tmp[password.id] = password;
            state.deletedPasswordList = tmp;
        },
        removeDeletedPasswordList(state, id){
            let tmp = state.deletedPasswordList;
            state.deletedPasswordList = {};
            delete tmp[id];
            state.deletedPasswordList = tmp;
        },
        updatePasswordModal(state, payload){
            let tmp = state.passwordModal;
            state.passwordModal = {};
            tmp[payload.key] = payload.value;
            state.passwordModal = tmp;
        }
    },
    actions: {},
    getters: {
        selected (state) {
            return state.selectedBox;
        },
        selectedPassword(state){
            return state.selectedPassword;
        },
        deleted (state) {
            return state.deletePassword;
        },
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
Vue.component('password-delete', require('./components/Password/Delete.vue'));
Vue.component('password-restore', require('./components/Password/Restore.vue'));
Vue.component('password-password', require('./components/Password/Password.vue'));
Vue.component('home-plus', require('./components/Home/Plus.vue'));

Vue.directive('tooltip', function (el, binding) {
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: 'hover'
    })
});

const app = new Vue({
    el: '#app',
    store
});
