<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="number" v-model="numrows" min="1" max="5">
    <input type="checkbox" v-model="humandate" id="humandate"/>
    <label for="humandate">{{ humandate }}</label>
    <div v-for="(email,index) in emails" >
      <input type="text" v-model="emails[index]" :key="index">
      <button @click="addEmailField" class="">+ Add</button>
      <button @click="removeEmailField(index)" class="">- Remove</button>
    </div>
    <p v-if="settingUpdatedPopup">{{settingUpdatedLabel}}</p>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
import {onMounted, reactive, ref, watch} from "vue";
import {useSettingsStore} from "@/stores/settings";


interface HTMLInputEvent extends Event {
  target: HTMLInputElement
}

const settings = useSettingsStore();
const humandate = ref(settings.humandate);
const emails = ref(settings.emails);
const numrows = ref(settings.numrows);
const settingUpdatedPopup = ref(false);
const settingUpdatedLabel = ref('');


const poppupShow= (updated:boolean) =>{
  settingUpdatedLabel.value = updated ? 'Setting was updated':'Setting was not updated';
  settingUpdatedPopup.value=true;
  setTimeout(() => {
    settingUpdatedPopup.value = false;
  }, 3000);
}

const addEmailField = () => {
  emails.value.push('');
};

const removeEmailField = (index:number) => {
  if(emails.value.length > 1){
    emails.value.splice(index, 1);
  }
};

watch(humandate, async (current: boolean, prev: boolean) => {
  const updated = await settings.updateSetting('humandate', current);
  poppupShow(updated);
})

watch(numrows, async (current: number, prev: number) => {
  const updated = await settings.updateSetting('numrows', current);
  poppupShow(updated);
})

watch(()=>[...emails.value], async (current: string[], prev: string[]) => {
  const updated = await settings.updateSetting('emails', current);
  poppupShow(updated);
})


</script>