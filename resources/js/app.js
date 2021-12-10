require('./bootstrap');

import Vue from 'vue'

import App from './components/MainComponent.vue'

const app = new Vue({
    el: '#app',
    components: { App }
});