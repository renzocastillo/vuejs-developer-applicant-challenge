<template>
  <Bar
      id="my-chart-id"
      :options="chartOptions"
      :data="chartData"
  />
</template>

<style scoped>

</style>

<script setup lang="ts">
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'
import {toDate} from "@/helper";
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps<{
  graph: any,
}>();
type Item={
  date:number,
  value:number,
}
console.log(props.graph)
const dates= Object.keys(props.graph).map((index)=>{
  const item:Item= props.graph[index]
  return toDate(item.date).toLocaleString();
});

console.log(dates)

const values= Object.keys(props.graph).map((index)=>{
  const item:Item= props.graph[index]
  return item.value;
});
console.log(values)

const chartData = {
  labels: dates,
  datasets: [{data:values}]
}
const chartOptions = {
  responsive: true
}

</script>