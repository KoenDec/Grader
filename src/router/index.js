import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Reports from '@/components/Reports'
import Home from '@/components/Home'
import Students from '@/components/Students'
import AddStudent from '@/components/AddStudent'
import Print from '@/components/Print'
import checkboxes from '@/components/CheckboxContainer'
import Subjects from '@/components/Subjects'
import fileInput from '@/components/file-input'
import SearchBar from '@/components/SearchBar'
import Evaluate from '@/components/Evaluate'

Vue.component('fileInput', fileInput)
Vue.component('checkboxes', checkboxes)
Vue.component('searchbar', SearchBar)

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
          component: Students
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
          path: '/addstudent',
          name: 'addstudent',
          component: AddStudent
        },
        {
          path: '/evaluate',
          name: 'evaluate',
          component: Evaluate
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
