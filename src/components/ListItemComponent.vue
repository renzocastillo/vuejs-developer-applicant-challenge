<template>
<li v-if="item.length">
  {{item}}
</li>
</template>


<style scoped>

</style>

<script setup lang="ts">
const props = defineProps<{
  item:string,
}>();
</script>