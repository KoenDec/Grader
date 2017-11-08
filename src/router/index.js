import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Reports from '@/components/Reports'
import Home from '@/components/Home'
import Studenten from '@/components/Studenten'

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
          path: '/',
          name: 'home',
          component: Home
        }
      ]
    }
  ]
})
