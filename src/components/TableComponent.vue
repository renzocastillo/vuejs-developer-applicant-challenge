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
    <tr v-for="item in maxItems(items,settings.numrows)" :key='item.id'>
      <td v-for="field in keyFields" :key='field'>
        {{ field == 'date' && settings.humandate ? toDate(item[field]) : item[field] }}
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>
</style>

<script setup lang="ts">
import {computed, onMounted,type PropType} from "vue";
import {useSettingsStore} from "@/stores/settings";

const settings = useSettingsStore();

type Item = {
  id:number,
  url:string,
  title: string,
  pageviews: number,
  date:number,
}

const props = defineProps<{
  items: Item[],
  fields:string[],
}>()

const keyFields = props.fields !== undefined ? props.fields.map((field:any) => { return  field.toLowerCase()}) : null;

const maxItems = (items :any,max:number)=>{
  return items.slice(0, max)
};

const toDate = (unixDate:number) => { return new Date(unixDate * 1000)}
</script>