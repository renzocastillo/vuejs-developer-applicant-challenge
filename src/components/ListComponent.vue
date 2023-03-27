<template>
  <h3>Emails List</h3>
<ul>
  <ListItemComponent v-for="item in items" :key="item" :item="item"/>
</ul>
</template>

<style scoped>

</style>

<script setup lang="ts">
import ListItemComponent from "@/components/ListItemComponent.vue";
const props = defineProps({
  items:Array,
})
</script>