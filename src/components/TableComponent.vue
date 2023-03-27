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
      <td v-for="field in keyFields" :key='field'>
        {{ field == 'date' ? toDate(item[field]) : item[field] }}
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>
</style>

<script setup lang="ts">
import {computed, onMounted} from "vue";

const props = defineProps({
  items: Array,
  fields:Array,
  humandate: Boolean,
  numrows: Number,
})

const keyFields = props.fields !== undefined ? props.fields.map((field:any) => { return  field.toLowerCase()}) : null;

onMounted(() => {
});

const maxItems = computed((fields)=>{});

const toDate = (unixDate:number) => { return new Date(unixDate * 1000)}
</script>