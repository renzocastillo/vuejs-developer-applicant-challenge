<template>
  <div class="settings">
    {{setter}}
    <h2>Settings page</h2>
    <input type="number"  v-model="setter.numrows" min="1">
    <input type="checkbox" v-model="setter.humandate" id="humandate"/>
    <label for="humandate">{{ setter.humandate }}</label>
    <div v-for="(email,index) in setter.emails" >
      <input type="text" v-model="setter.emails[index]" :key="index">
      <button @click="setter.addEmailField" class="">+ Add</button>
      <button @click="setter.removeEmailField(index)" class="">- Remove</button>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
import {onMounted, reactive, ref} from "vue";
import {useSettingsStore} from "@/stores/settings";

const props = defineProps<{
  emails: string[],
  humandate: boolean,
  numrows: number,
}>();
const setter = useSettingsStore();


setter.emails = props.emails;
setter.humandate = props.humandate;
setter.numrows = props.numrows;

</script>