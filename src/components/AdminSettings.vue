<template>
  <div class="settings">
    <h2>{{ translationStrings.settings_page }}</h2>
    <div class="numrows-setting">
      <label for="numrows">{{ translationStrings.numrows }}:</label>
      <input type="number" v-model="numrows" min="1" max="5" id="numrows">
    </div>
    <div class="humandate-setting">
      <label for="humandate">{{ translationStrings.humandate }}:</label>
      <input type="checkbox" v-model="humandate" id="humandate"/>

    </div>
    <div class="emails-setting">
      <label>{{ translationStrings.emails }}:</label>
      <div v-for="(email,index) in emails">
        <input type="text" v-model="emails[index]" @change="updateEmailsSetting" :key="index">
        <button @click="removeEmailField(index)" class="">- {{ translationStrings.remove }}</button>
      </div>
      <div v-if="emails.length>=0">
        <button @click="addEmailField" class="" :disabled="emails.length==5">+ {{ translationStrings.add }}</button>
      </div>
      <p v-if="popupShow">{{ popupLabel }}</p>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
/**
 * Component for displaying and updating user settings.
 */
import {onMounted, reactive, ref, unref,watch, shallowRef, onBeforeMount} from "vue";
import {useSettingsStore} from "@/stores/settings";
import {translationStrings} from "../router";

/**
 * Interface for HTML input event.
 *
 * @interface
 * @extends Event
 */
interface HTMLInputEvent extends Event {
  target: HTMLInputElement
}

const settings = useSettingsStore();
const popupShow = ref(false);
const popupLabel = ref('');
const numrows = ref(settings.numrows);
const humandate = ref(settings.humandate);
const emails = ref<string []>([...settings.emails]);

/**
 * Displays a popup message.
 *
 * @function
 * @param {string} label - The message to display.
 */
const poppupShow = (label: string) => {
  popupLabel.value = label;
  popupShow.value = true;
  setTimeout(() => {
    popupShow.value = false;
  }, 3000);
}

/**
 * Adds an email input field.
 *
 * @function
 */
const addEmailField = () => {
  if(emails.value.length < 5) {
    emails.value.push('');
  }
};

/**
 * Removes an email input field.
 *
 * @function
 * @async
 * @param {number} index - The index of the email field to remove.
 */
const removeEmailField = async (index: number) => {
  emails.value.splice(index, 1);
  updateEmailsSetting();
};

/**
 * Updates the email setting.
 *
 * @function
 * @async
 */
const updateEmailsSetting = async () => {
    const updated = await settings.updateSetting('emails', emails.value);
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

/**
 * Watches the humandate setting for changes.
 */
watch(humandate, async (current: boolean, prev: boolean) => {
    if(current !=prev) {
        const updated = await settings.updateSetting('humandate', current);
        if (updated) {
            poppupShow('Humandate was updated');
        } else {
            poppupShow('Humandate was not updated');
        }
    }
})

/**
 * Watches the numrows setting for changes.
 */
watch(numrows, async (current: number, prev: number) => {
    if(current !=prev && prev!=0){
        const updated = await settings.updateSetting('numrows', current);
        if(updated){
            poppupShow('Numrows was updated');

        }else{
            poppupShow('Numrows was not updated');
        }
    }
})

/**
 * Displays a popup message if there is an error calling the settings API.
 */
if(settings.callSettingsError.name != ''){
    poppupShow(settings.callSettingsError.name+': '+settings.callSettingsError.message);
    settings.callSettingsError= { name: "", message: ""}
}

defineExpose({
    numrows,
    humandate,
    emails,
})
</script>