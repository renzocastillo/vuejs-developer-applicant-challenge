<template>
  <h2>{{data.table.title}}</h2>
  <TableComponent
      :fields="data.table.data.headers"
      :items ="data.table.data.rows"
  />
  <ListComponent/>
</template>


<script setup lang="ts">
import TableComponent from "@/components/TableComponent.vue";
import ListComponent from "@/components/ListComponent.vue";
import {useDataStore} from "@/stores/data";

const data = useDataStore();
if(Object.keys(data.table).length == 0){
    await data.callData();
}



</script>

