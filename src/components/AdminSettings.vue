<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="number" v-model="settings.numrows" min="1" max="5">
    <input type="checkbox" v-model="settings.humandate" id="humandate"/>
    <label for="humandate">{{ settings.humandate }}</label>
    <div v-for="(email,index) in settings.emails" >
      <input type="text" v-model="settings.emails[index]" :key="index">
      <button @click="settings.addEmailField" class="">+ Add</button>
      <button @click="settings.removeEmailField(index)" class="">- Remove</button>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
import {onMounted, reactive, ref} from "vue";
import {useSettingsStore} from "@/stores/settings";

const settings = useSettingsStore();

</script>