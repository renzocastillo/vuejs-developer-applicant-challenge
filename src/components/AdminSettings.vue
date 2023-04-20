<template>
  <div class="settings">
    <h2>Settings page</h2>
    <div class="numrows-setting">
      <label for="numrows">Numrows:</label>
      <input type="number" v-model="settings.numrows" min="1" max="5" id="numrows">
    </div>
    <div class="humandate-setting">
      <label for="humandate">Humandate:</label>
      <input type="checkbox" v-model="settings.humandate" id="humandate"/>

    </div>
    <div class="emails-setting">
      <label>Emails:</label>
      <div v-for="(email,index) in settings.emails">
        <input type="text" v-model="settings.emails[index]" @change="updateEmailsSetting" :key="index">
        <button @click="removeEmailField(index)" class="">- Remove</button>
      </div>
      <div v-if="settings.emails.length>=0">
        <button @click="addEmailField" class="" :disabled="settings.emails.length==5">+ Add</button>
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

const settings = useSettingsStore();
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
  if(settings.emails.length < 5) {
    settings.emails.push('');
  }
};

const removeEmailField = async (index: number) => {
  settings.emails.splice(index, 1);
  updateEmailsSetting();
};

const updateEmailsSetting = async () => {
    const updated = await settings.updateSetting('emails', settings.emails);
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

watch(()=> settings.humandate, async (current: boolean, prev: boolean) => {
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

watch(()=> settings.numrows, async (current: number, prev: number) => {
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

</script>