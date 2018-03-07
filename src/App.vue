<template>
  <div id="app">
    <create></create>
  </div>
</template>

<script>
import create from './components/create'

export default {
  name: 'App',
  components: {
    create
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
