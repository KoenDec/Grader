// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
<<<<<<< HEAD
import axios from 'axios'
import printer from './printer'
// index.js or main.js
import('../node_modules/vuetify/dist/vuetify.min.css')
Vue.use(Vuetify)
Vue.prototype.$http = axios
Vue.prototype.$printer = printer
=======
import api from './js/api.js'

// index.js or main.js
import('../node_modules/vuetify/dist/vuetify.min.css')
Vue.use(Vuetify)
Vue.prototype.$http = api
>>>>>>> a8b58ff8d9bd2301d2007f18510fabe816e1b85a
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
<<<<<<< HEAD
  printer,
=======
  api,
>>>>>>> a8b58ff8d9bd2301d2007f18510fabe816e1b85a
  template: '<App/>',
  components: { App }
})
