<template>
  <table id="tableComponent" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th v-for="field in fields" :key='field'>
        {{ field }} <i class="bi bi-sort-alpha-down" aria-label='Sort Icon'></i>
      </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in items" :key='item'>
      <td v-for="field in fields" :key='field'>{{ item[field.toLowerCase()] }}</td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>
</style>

<script setup lang="ts">
import {computed} from "vue";

const props = defineProps({
  items: Array,
  fields:Array,
})

/*const keyFields = computed((fields)=>{ return fields.map(
    (field) => { return field.toLowerCase() }
)})*/
</script>