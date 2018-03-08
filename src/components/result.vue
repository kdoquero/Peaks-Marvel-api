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
    getPercent(count){
      let percent = ( count / this.totalCount ) * 100
      return Number.parseFloat(percent).toFixed(1)
    }
  },
  beforeCreate(){
    let api = new Api
    api.getPollById(5).then((response) => {
      this.poll = response.data

      this.poll.options.forEach((option) => {
        this.totalCount += option.count
      })
    })
  }
}
</script>

<style>

</style>
