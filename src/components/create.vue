<template>
<form @submit.prevent="onSubmit()">
  <div class="form-group">

    <input type="text"
    name="title"
    placeholder="Title"
    v-model="poll.title"
    required>

  </div>
  <div
  v-for="(option, index) in poll.options" 
  :key="index"  class="form-group">

    <input type="text" 
    :name="`option${index + 1}`"
    :placeholder="`Option ${index + 1}`"
    v-model="poll.options[index].text"
    required>

    <button
    type="button"
    class="btn btn-link"
    @click="remove(index)"
    v-if="poll.options.length > 2">
      Remove
    </button>

  </div>
  <div class="form-group">

    <button
    type="button"
    class="btn btn-link"
    @click="add()">
      Add
    </button>

  </div>
  <input type="submit">
</form>
</template>

<script>
import Api from '../api'
export default {
  // on nomme notre component
  name: 'create',
  // la fonction data retourne les données INTERNES de notre component, data DOIT être une fonction
  data(){
    return {
      poll: {
        title: "",
        options: [{text: ""},{text: ""}]
      }
    }
  },
  // on déclare les méthodes du component
  methods: {
    // la méthode onSubmit() est appelée lorsqu'on submit le formulaire
    onSubmit(){
      // On créé une instance de l'api pour pouvoir envoyer des requêtes en ajax au serveur
      let api = new Api
      // On envoie le nouveau sondage dans l'api
      api.setPoll(this.poll).then((response) => {
        // Puis, lorsque le serveur à répondu, on affiche la page pour voter
        // au passage, on récupère l'id du poll que l'api nous à retourné dans l'objet response
        this.$router.push({name: 'answer', params: {id: response.data.id}})
      })
    },
    // la méthode add() est appelée lorsqu'on clique sur le bouton "add"
    add(){
      // on ajoute une string vide dans le tableau options, ce qui ajoutera un input dans notre formulaire
      this.poll.options.push({text: ""})
    },
    // la méthode remove() est appelée lorsqu'on clique sur le bouton "remove"    
    remove(index){
      // on retire du tableau l'élément correspodant à l'index
      this.poll.options.splice(index, 1)
    }
  }
}
</script>

<style scoped>
</style>
