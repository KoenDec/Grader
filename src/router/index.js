import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Reports from '@/components/Reports'
import Home from '@/components/Home'
import Studenten from '@/components/Studenten'
import Print from '@/components/Print'
import checkboxes from '@/components/CheckboxContainer'
import Subjects from '@/components/Subjects'
import fileInput from '@/components/file-input'
Vue.component('fileInput', fileInput)
Vue.component('checkboxes', checkboxes)

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index,
      children: [
        {
          path: '/rapporten',
          name: 'rapporten',
          component: Reports
        },
        {
          path: '/studenten',
          name: 'studenten',
          component: Studenten
        },
        {
          path: '/afdrukken',
          name: 'afdrukken',
          component: Print
        },
        {
          path: '/opleidingen',
          name: 'opleidingen',
          component: Subjects
        },
        {
          path: '/',
          name: 'home',
          component: Home
        }
      ]
    }
  ]
})
