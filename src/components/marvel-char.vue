<template>
  <section class="background">
       
    <char-list :heroes= "heroes"/>
    <div>
        <input @click="previous()" type="button" name="previous" value="previous" >
        <input @click="next()" type="button" name="previous" value="next" >
    </div>
  </section>
</template>

<script>
import Api from '../api'
import axios from 'axios'
import paginator from 'vuejs-paginator'
import charList from './char-list'

export default {
    name: "marvel-char",
    components:{
        paginator,
        charList

    },
    data(){
    return {
      heroes: [],
      offsetPage: 100,
      user: {
          name: "",
          favorites: []
      }
    }
  },
  
  methods: {
    previous(){
        this.offsetPage += 20
        axios.get(`https://gateway.marvel.com:443/v1/public/characters?limit=20&offset=${this.offsetPage}&apikey=e85adc0f267a5fe649a69a2c2b279f1b`).then((response) =>  {
          this.heroes = response.data.data.results;
        })    
    },
    next(){
        this.offsetPage -= 20
        axios.get(`https://gateway.marvel.com:443/v1/public/characters?limit=20&offset=${this.offsetPage}&apikey=e85adc0f267a5fe649a69a2c2b279f1b`).then((response) =>  {
          this.heroes = response.data.data.results;
        }) 
    },
    onSubmit(){
      // On créé une instance de l'api pour pouvoir envoyer des requêtes en ajax au serveur
      let api = new Api
      // On envoie le user dans l'api
      api.setUser(this.user).then((response) => {
        // Puis, lorsque le serveur à répondu, on affiche la page pour voter
        // au passage, on récupère l'id du poll que l'api nous à retourné dans l'objet response
      })
    },
    // la méthode add() est appelée lorsqu'on clique sur le bouton "add"
    add(favName){
      // on ajoute une string vide dans le tableau options, ce qui ajoutera un input dans notre formulaire
      this.user.favorites.push({name: favName})
    }
  },
  beforeCreate(){
        axios.get(`https://gateway.marvel.com:443/v1/public/characters?limit=20&offset=100&apikey=e85adc0f267a5fe649a69a2c2b279f1b`).then((response) =>  {
          console.log(response.data.data);
          this.heroes = response.data.data.results;
        })
    }
}
</script>

<style>
.background {
    background-image: url('../assets/images/wallhaven-167444.jpg');
    background-size: cover;
}

</style>
