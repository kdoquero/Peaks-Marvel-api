<template>
  <form @submit.prevent="onSubmit()">
    <h2>{{poll.title}}</h2>

    <div
    v-for="(option, index) in poll.options" 
    :key="index"  class="form-group">

      <input type="radio" 
      name="poll"
      :value="option.id"
      v-model="picked">

      <label for="">{{option.text}}</label>
    </div>
    <input type="submit">
  </form>
</template>

<script>
import Api from '../api'

export default {
  // on nomme notre component  
  name:'answer',
  // la fonction data retourne les données INTERNES de notre component, data DOIT être une fonction  
  data(){
    return {
      // la données picked contiendra l'id de la réponse choisie
      picked: null,
      poll: {}
    }
  },
  // on déclare les méthodes du component  
  methods:{
    // la méthode onSubmit() est appelée lorsqu'on submit le formulaire    
    onSubmit(){
      // On créé une instance de l'api pour pouvoir envoyer des requêtes en ajax au serveur      
      let api = new Api
      // On envoie à l'api l'ordre d'incrémenter le conteur de vote pour la réponse sélectionnée
      api.vote(this.picked).then(() => {
        // l'orsque l'api nous répond, cela signifie que la demande à bien été traitée
        // on peux donc afficher la page de réultat en injectant l'id du poll dans l'url
        this.$router.push({name: 'result', params: {id: this.poll.id}})
      })
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
    })
  }

}
</script>

<style>

</style>
