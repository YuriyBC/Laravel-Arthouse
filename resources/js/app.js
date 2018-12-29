require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home-page', require('./pages/HomePage.vue').default);
Vue.component('movie-page', require('./pages/MoviePage.vue').default);
Vue.component('faggot-page', require('./pages/FaggotPage.vue').default);

const app = new Vue({
    el: '#app'
});
