<template>
  <div id="app">
    <!-- :key="$route.fullPath" est nécessaire pour mettre à jour les components lors d'un changement d'url -->
    <router-view :key="$route.fullPath"/>
  </div>
</template>

<script>
import result from './components/result'

export default {
  name: 'App',
  components: {
    result
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
