require('./bootstrap');

import Vue from 'vue';

Vue.component('task-list',require('./Components/TaskList.vue').default);

const app = new Vue({
    el: '#app',
});
