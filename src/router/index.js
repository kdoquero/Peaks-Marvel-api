import Vue from 'vue'
import Router from 'vue-router'
import create from '@/components/create'
import answer from '@/components/answer'
import result from '@/components/result'

Vue.use(Router)
// les routes de l'application sont définnies lors de l'instanciation du router
export default new Router({
  routes: [
    {
      // path est l'url de la route
      path: '/',
      // il est fortement recommandé de nommer les routes
      name: 'create',
      // on indique au router quel component doit être affiché sur chaque routes
      component: create
    },
    {
      // on peux ajouter des params au path en ajoutant : suivi du nom du param
      // ici on à donc un param nommé id soit :id
      path: '/answer/:id',
      name: 'answer',
      component: answer
    },
    {
      path: '/result/:id',
      name: 'result',
      component: result
    }
  ]
})
