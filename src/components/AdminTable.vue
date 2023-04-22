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
/**
 * Renders a table page with a TableComponent and a ListComponent.
 *
 * @vue-data {object} data - The reactive data object returned from useDataStore hook.
 * @vue-data {object} data.table - The table data object containing title, headers, and rows.
 * @vue-data {function} data.callData - A function that makes an API call to retrieve the data for the table.
 * @vue-import {TableComponent} from "@/components/TableComponent.vue" - A Vue component used to render the table.
 * @vue-import {ListComponent} from "@/components/ListComponent.vue" - A Vue component used to render the list.
 * @vue-import {useDataStore} from "@/stores/data" - A hook used to retrieve the reactive data object.
 * @vue-import {translationStrings} from "../router" - An object containing translation strings used in the template.
 */
import TableComponent from "@/components/TableComponent.vue";
import ListComponent from "@/components/ListComponent.vue";
import {useDataStore} from "@/stores/data";
import {translationStrings} from "../router";
import {onBeforeMount} from "vue";

/**
 * Retrieves Pinia data store.
 */
const data = useDataStore();

/**
 * The on before mount function which calls the data to initiliaze the table.
 *
 * */
onBeforeMount(async () => {
    await data.callData();
});


</script>

