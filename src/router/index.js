import Vue from 'vue'
import Router from 'vue-router'
import create from '@/components/create'
import answer from '@/components/answer'
import result from '@/components/result'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'create',
      component: create
    }
  ]
})
