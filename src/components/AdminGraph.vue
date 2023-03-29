<template>
  <div class="settings">
    <h2>Graph page</h2>
    <BarChartComponent />
  </div>
</template>

<style>
</style>
<script setup lang="ts">
import BarChartComponent from "@/components/BarChartComponent.vue";
const props = defineProps<{
  graph: any,
}>();
</script>