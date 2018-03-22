<template>
  <div id="app">
    <img src="assets/images/800px-MarvelLogo.svg.png" alt="">
    <!-- :key="$route.fullPath" est nécessaire pour mettre à jour les components lors d'un changement d'url -->
    <router-view :key="$route.fullPath"/>
  </div>
</template>

<script>
import marvelChart from './components/marvel-char'

export default {
  name: 'App',
  components: {
    marvelChart
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
