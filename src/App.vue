<template>
  <div id="app">
    <result></result>
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
