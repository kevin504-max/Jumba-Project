<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <BarChart />
        </div>
      </div>
    </div>
  </div>
</template>
<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  background-color: #CCCCCC;
}
</style>

<script>
import BarChart from './views/BarChartView.vue'

export default {
  name: 'App',
  components: {
    BarChart,
  }
}
</script>
