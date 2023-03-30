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
import {useDataStore} from "@/stores/data";
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const remoteData=useDataStore();
await remoteData.callData();
const graph:any = remoteData.graph;
type Item={
  date:number,
  value:number,
}
console.log(remoteData.graph)


const dates= Object.keys(graph).map((index)=>{
  const item:Item= graph[index]
  return toDate(item.date).toLocaleString();
});

const values= Object.keys(graph).map((index)=>{
  const item:Item= graph[index]
  return item.value;
});
console.log(dates)
console.log(values)

const chartData = {
  labels: dates,
  datasets: [{data:values}]
}
const chartOptions = {
  responsive: true
}

</script>