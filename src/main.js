// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import printer from './printer'
import api from './js/api.js'

// index.js or main.js
import('../node_modules/vuetify/dist/vuetify.min.css')
Vue.use(Vuetify)
Vue.prototype.$printer = printer
Vue.prototype.$http = api
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  api,
  template: '<App/>',
  components: { App }
})
