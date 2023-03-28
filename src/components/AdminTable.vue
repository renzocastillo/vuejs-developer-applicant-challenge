<template>
  <h2>Table page</h2>
  <TableComponent
      :fields='remoteData.table.data.headers'
      :items ="remoteData.table.data.rows"
      :humandate="settingsData.humandate"
      :numrows="parseInt(settingsData.numrows)"
  />
  <ListComponent :items="settingsData.emails"/>
</template>


<script setup lang="ts">
// Importing the table component
import TableComponent from "@/components/TableComponent.vue";
import ListComponent from "@/components/ListComponent.vue";

const props = defineProps<{
  remoteData: any,
  settingsData: any,
}>();
</script>

