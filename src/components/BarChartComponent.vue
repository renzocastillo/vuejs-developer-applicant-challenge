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
/**
 * Vue component for rendering a bar chart using Chart.js library.
 */
import {Bar} from 'vue-chartjs'
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'
import {toDate} from "@/helper";
import {useDataStore} from "@/stores/data";
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

/**
 * Retrieves the data store and initializes the graph data.
 */
const data=useDataStore();

/**
 * Stores the graph data from the data store as an any type.
 */
const graph:any = data.graph;

/**
 * Defines the structure of an item in the chart data.
 *
 * @property {number} date - The date of the item.
 * @property {number} value - The value of the item.
 */
type Item={
  date:number,
  value:number,
}

/**
 * Defines the options to be used when rendering the chart.
 *
 * @property {boolean} responsive - Whether or not the chart is responsive.
 * @property {object} plugins - The plugins to be used for the chart.
 * @property {object} plugins.legend - The legend plugin for the chart.
 * @property {function} plugins.legend.onClick - The click event handler for the legend.
 */
const chartOptions = {
  responsive: true,
  plugins: {
    legend: {
      onClick: ()=>{}
    }
  }
}

</script>