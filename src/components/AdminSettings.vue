<template>
  <div class="settings">
    <h2>Settings page</h2>
    <div class="numrows-setting">
      <label for="numrows">Numrows:</label>
      <input type="number" v-model="numrows" min="1" max="5" id="numrows">
    </div>
    <div class="humandate-setting">
      <label for="humandate">Humandate:</label>
      <input type="checkbox" v-model="humandate" id="humandate"/>

    </div>
    <div class="emails-setting">
      <label>Emails:</label>
      <div v-for="(email,index) in emails">
        <input type="text" v-model="emails[index]" @change="updateEmailsSetting" :key="index">
        <button @click="removeEmailField(index)" class="">- Remove</button>
      </div>
      <div v-if="emails.length>=0">
        <button @click="addEmailField" class="" :disabled="emails.length==5">+ Add</button>
      </div>
      <p v-if="popupShow">{{ popupLabel }}</p>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
import {onMounted, reactive, ref, watch,shallowRef} from "vue";
import {useSettingsStore} from "@/stores/settings";


interface HTMLInputEvent extends Event {
  target: HTMLInputElement
}
/*const settings = useSettingsStore();
const humandate = ref(true);
const emails = ref<string []>([]);
const numrows = ref(0);
const popupShow = ref(false);
const popupLabel = ref('');*/

const settings = useSettingsStore();
await settings.callSettings();
const humandate = shallowRef(settings.humandate);
const emails = shallowRef<string []>(settings.emails);
const numrows = shallowRef(settings.numrows);
const popupShow = ref(false);
const popupLabel = ref('');

const poppupShow = (label: string) => {
  popupLabel.value = label;
  popupShow.value = true;
  setTimeout(() => {
    popupShow.value = false;
  }, 3000);
}

const addEmailField = () => {
  if(emails.value.length < 5) {
    emails.value.push('');
  }
};

const removeEmailField = async (index: number) => {
  emails.value.splice(index, 1);
  updateEmailsSetting();
};

const updateEmailsSetting = async () => {
    const updated = await settings.updateSetting('emails', emails.value);
    console.log(settings.updateSettingError);
    if (settings.updateSettingError.name != '') {
        poppupShow(settings.updateSettingError.name + ': ' + settings.updateSettingError.message);
        settings.updateSettingError = {name: "", message: ""}
    } else {
        if (updated) {
            poppupShow('Emails were updated');
        } else {
            poppupShow('Emails were not updated');
        }
    }
}

watch(humandate, async (current: boolean, prev: boolean) => {
    console.log(current);
    console.log(prev);
    if(current !=prev) {
        const updated = await settings.updateSetting('humandate', current);
        if (updated) {
            poppupShow('Humandate was updated');
        } else {
            poppupShow('Humandate was not updated');
        }
    }
})

watch(numrows, async (current: number, prev: number) => {
    if(current !=prev && prev!=0){
        console.log(current);
        console.log(prev);
        const updated = await settings.updateSetting('numrows', current);
        if(updated){
            poppupShow('Numrows was updated');

        }else{
            poppupShow('Numrows was not updated');
        }
    }
})

if(settings.callSettingsError.name != ''){
    poppupShow(settings.callSettingsError.name+': '+settings.callSettingsError.message);
    settings.callSettingsError= { name: "", message: ""}
}
/*if (numrows.value == 0) {
    await settings.callSettings();

    if(settings.callSettingsError.name != ''){
        poppupShow(settings.callSettingsError.name+': '+settings.callSettingsError.message);
        settings.callSettingsError= { name: "", message: ""}
    }else{
        humandate.value = settings.humandate
        emails.value = settings.emails;
        numrows.value = settings.numrows;
    }
}*/

</script>