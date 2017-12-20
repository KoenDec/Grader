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
import Login from '@/components/Login'
import SubjectEditor from '@/components/SubjectEditor'

Vue.component('fileInput', fileInput)
Vue.component('checkboxes', checkboxes)
Vue.component('searchbar', SearchBar)
Vue.component('subjecteditor', SubjectEditor)
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index,
      beforeEnter: (to, from, next) => {
        if (to.path !== '/login' && window.localStorage.getItem('token')) {
          next()
        } else {
          next({path: '/login'})
        }
      },
      children: [
        {
          path: '/rapporten',
          name: 'rapporten',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Reports
        },
        {
          path: '/studenten',
          name: 'studenten',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Students
        },
        {
          path: '/afdrukken',
          name: 'afdrukken',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Print
        },
        {
          path: '/opleidingen',
          name: 'opleidingen',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Subjects
        },
        {
          path: '/addstudent',
          name: 'addstudent',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: AddStudent
        },
        {
          path: '/evaluate',
          name: 'evaluate',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Evaluate
        },
        {
          path: '/home',
          name: 'home',
          beforeEnter: (to, from, next) => {
            if (to.path !== '/login' && window.localStorage.getItem('token')) {
              next()
            } else {
              next({path: '/login'})
            }
          },
          component: Home
        }/*,
        {
          path: '/login',
          name: 'login',
          component: Login
        } */
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ]
})
