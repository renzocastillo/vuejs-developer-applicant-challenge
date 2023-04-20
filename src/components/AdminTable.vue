<template>
    <h2>{{translationStrings.table_page}}</h2>
  <TableComponent
      :title="data.table.title"
      :fields="data.table.data.headers"
      :items ="data.table.data.rows"
  />
  <ListComponent/>
</template>


<script setup lang="ts">
import TableComponent from "@/components/TableComponent.vue";
import ListComponent from "@/components/ListComponent.vue";
import {useDataStore} from "@/stores/data";
import {translationStrings} from "../router";

const data = useDataStore();
if(Object.keys(data.table).length == 0){
    await data.callData();
}



</script>

