<template>
  <h2>Table page</h2>
  <TableComponent
      :fields='table.data.headers'
      :items ="table.data.rows"
  />
  <ListComponent/>
</template>


<script setup lang="ts">
import TableComponent from "@/components/TableComponent.vue";
import ListComponent from "@/components/ListComponent.vue";

const props = defineProps<{
  table: any,
}>();
</script>

