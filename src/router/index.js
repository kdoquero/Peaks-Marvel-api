import Vue from 'vue'
import Router from 'vue-router'
import MarvelChart from '@/components/marvel-char'


Vue.use(Router)
// les routes de l'application sont définnies lors de l'instanciation du router
export default new Router({
  routes: [
    {
      // path est l'url de la route
      path: '/',
      // il est fortement recommandé de nommer les routes
      name: 'marvel-chart',
      // on indique au router quel component doit être affiché sur chaque routes
      component: MarvelChart
    },
    // {
    //   // on peux ajouter des params au path en ajoutant : suivi du nom du param
    //   // ici on à donc un param nommé id soit :id
    //   path: '/answer/:id',
    //   name: 'answer',
    //   component: answer
    // },
    // {
    //   path: '/result/:id',
    //   name: 'result',
    //   component: resultPie
    // }
  ]
})
