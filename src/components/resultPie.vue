<template>
  <section>
    <h2>{{poll.title}}</h2>
    <vue-chart
      type="pie"
      :data="chartData"
    ></vue-chart>
  </section>
</template>

<script>
import Api from '../api'
import VueChart from 'vuechart'

export default {
  name: 'result',
  components: {
    [VueChart.name]: VueChart,
  },
  data(){
    return {
      poll: {},
      chartData:{
        datasets: [{
          data: [],
          backgroundColor: []
        }],
        labels: []
      }
    }
  },
  methods: {
    // la méthode randomInt() est utilisée par randomColor(), sont rôle est de tirer un entier aléatoire compris entre deux valeurs
    randomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    },
    // la méthode randomColor() permet de tirer des couleurs aléatoire dans un spectre de couleur restreint.
    randomColor() {
      return `hsl(${this.randomInt(200, 260)},${this.randomInt(42, 98)}%,${this.randomInt(40, 70)}%)`
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
        // on ajoute les valeurs de count dans notre dataset
        this.chartData.datasets[0].data.push(option.count)
        // on associe à chaque option une couleur aléatoire
        this.chartData.datasets[0].backgroundColor.push(this.randomColor())
        // on associe le texte de chaque option à un label du chart
        this.chartData.labels.push(option.text)
      })
    })
  }
}
</script>

<style>

</style>
