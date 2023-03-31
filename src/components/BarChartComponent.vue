<template>
  <Bar
      id="my-chart-id"
      :options="chartOptions"
      :data="data.chartData()"
  />
</template>

<style scoped>

</style>

<script setup lang="ts">
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'
import {toDate} from "@/helper";
import {useDataStore} from "@/stores/data";
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const data=useDataStore();
const graph:any = data.graph;
type Item={
  date:number,
  value:number,
}
const chartOptions = {
  responsive: true
}

</script>