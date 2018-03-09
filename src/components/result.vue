<template>
  <section>
    <h2>{{poll.title}}</h2>
    <h5>{{totalCount}} vote(s) au total.</h5>
    <div v-for="option in poll.options" :key="option.id">
      <label>{{option.text}}</label>
      <div class="progress">

        <div class="progress-bar"
        role="progressbar"
        :style="`width: ${getPercent(option.count)}%`">
          {{getPercent(option.count)}}%
        </div>

      </div>
    </div>
  </section>
</template>

<script>
import Api from '../api'

export default {
  name: 'result',
  data(){
    return {
      poll: {},
      totalCount: 0
    }
  },
  methods: {
    // La méthode getPercent() permet de calculer le pourcentage de votes qu'une option à obtenu
    getPercent(count){
      // on calcule le pourcentage
      let percent = ( count / this.totalCount ) * 100
      // on arrondi le résultat puis on le retourne
      return Number.parseFloat(percent).toFixed(1)
    }
  },
  // le hook beforeCreate() est appelé lorsque le component à été instancié et avant qu'il soit ajouté dans le DOM
  beforeCreate(){
    // On créé une instance de l'api pour pouvoir envoyer des requêtes en ajax au serveur        
    let api = new Api
    // On récupère le poll à partir de l'id qui été passé dans l'url
    api.getPollById(this.$route.params.id).then((response) => {
      // on peux ensuite enregistrer le poll dans les datas du component
      this.poll = response.data
      // on a besoin de connaitre le nombre total de votes sur le sondage pour calculer le pourcentage de chaque options
      this.poll.options.forEach((option) => {
        // pour chaque options, on additionne la valeur de count avec la data totalCount qui est initialisé à 0
        this.totalCount += option.count
      })
    })
  }
}
</script>

<style>

</style>
