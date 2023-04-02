<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="number" :value="settings.numrows" min="1" max="5" @change="superQueso">
    <input type="checkbox" v-model="settings.humandate" id="humandate"/>
    <label for="humandate">{{ settings.humandate }}</label>
    <div v-for="(email,index) in settings.emails" >
      <input type="text" v-model="settings.emails[index]" :key="index">
      <button @click="settings.addEmailField" class="">+ Add</button>
      <button @click="settings.removeEmailField(index)" class="">- Remove</button>
    </div>
    <p v-if="settingPopup">algo se actualizó pe mascot</p>
  </div>
</template>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>

<script setup lang="ts">
import {onMounted, reactive, ref, watch} from "vue";
import {useSettingsStore} from "@/stores/settings";


interface HTMLInputEvent extends Event {
  target: HTMLInputElement
}

const settings = useSettingsStore();
const settingPopup = ref(false);
const superQueso = (event: HTMLInputEvent)=>{
  console.log(event.target.value);
  if(true){
    event.target.value = String(settings.numrows);
  }
  console.log(settings.numrows);
  console.log('super queso');
}

 watch(() => settings.$state.humandate, async (current: boolean, prev: boolean) => {
   const updated = await settings.updateSetting('humandate', current);
   if (updated) {
     poppupShow();
   }
 })

const poppupShow= () =>{
  settingPopup.value=true;
  setTimeout(() => {
    settingPopup.value = false;
  }, 3000);
}

</script>