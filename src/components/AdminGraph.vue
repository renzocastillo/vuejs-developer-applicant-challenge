<template>
  <div class="settings">
    <h2>Graph page</h2>
    <a class="btn btn-info float-end" @click="data.callData(true)">Refresh</a>
    <BarChartComponent/>
  </div>
</template>

<style>
</style>
<script setup lang="ts">
import BarChartComponent from "@/components/BarChartComponent.vue";
import {useDataStore} from "@/stores/data";

const data=useDataStore();
if(Object.keys(data.graph).length == 0){
    await data.callData();
}
</script>