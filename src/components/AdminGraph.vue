<template>
  <div class="settings">
    <h2>Graph page</h2>
    <a href="#" class="btn btn-info float-end" @click="data.callData()">Refresh</a>
    <BarChartComponent/>
    {{data.graph}}
  </div>
</template>

<style>
</style>
<script setup lang="ts">
import BarChartComponent from "@/components/BarChartComponent.vue";
import {useDataStore} from "@/stores/data";

const data=useDataStore();
const props = defineProps<{
  graph: any,
}>();
</script>