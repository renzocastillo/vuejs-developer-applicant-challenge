<template>
<li v-if="item.length">
  {{item}}
</li>
</template>


<style scoped>
</style>

<script setup lang="ts">
/**
 * Props object containing the 'item' prop.
 * @property {string} item - The item to be rendered.
 */
const props = defineProps<{
  item:string,
}>();
</script>