<template>
    <h4>{{props.title}}</h4>
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
/**
 * Vue component that displays a table of items with specified fields
 *
 * @component
 * @prop {string} title - The title of the table
 * @prop {Item[]} items - The items to be displayed in the table
 * @prop {string[]} fields - The fields to be displayed in the table
 * @typedef {Object} Item
 * @property {number} id - The unique identifier of the item
 * @property {string} url - The URL of the item
 * @property {string} title - The title of the item
 * @property {number} pageviews - The number of page views of the item
 * @property {number} date - The date of the item in Unix timestamp format
 * @returns {Object} - The Vue component that displays a table of items
 */
import {computed, onMounted,type PropType} from "vue";
import {useSettingsStore} from "@/stores/settings";
import {toDate} from "@/helper";

/**
 * Retrieves Pinia settings store.
 */
const settings = useSettingsStore();

/**
 * Represents an item object.
 *
 * @property {number} id - The item's unique identifier.
 * @property {string} url - The item's URL.
 * @property {string} title - The item's title.
 * @property {number} pageviews - The item's number of pageviews.
 * @property {number} date - The item's date in timestamp format.
 */
type Item = {
  id:number,
  url:string,
  title: string,
  pageviews: number,
  date:number,
}

const props = defineProps<{
  title: string,
  items: Item[],
  fields:string[],
}>()

/**
 * An array of lowercase key fields.
 */
const keyFields = props.fields !== undefined ? props.fields.map((field:any) => { return  field.toLowerCase()}) : null;

/**
 * Returns a new array containing the first items according to the maximum value.
 * @param {Array<any>} items - The original array to slice.
 * @param {number} max - The maximum number of items to include in the new array.
 * @returns {Array<any>} - A new array containing the first items according to the maximum value.
 */
const maxItems = (items :any,max:number)=>{
  return items.slice(0, max)
};
</script>