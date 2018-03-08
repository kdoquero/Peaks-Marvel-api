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
export default {
  name: 'result',
  data(){
    return {
      poll: {}
    }
  },
  computed: {
    totalCount(){
      let total = 0
      this.poll.options.forEach((option) => {
        total += option.count
      })
      return total
    }
  },
  methods: {
    getPercent(count){
      let percent = ( count / this.totalCount ) * 100
      return Number.parseFloat(percent).toFixed(1)
    }
  },
  beforeCreate(){
    // data calls goes here
  }
}
</script>

<style>

</style>
