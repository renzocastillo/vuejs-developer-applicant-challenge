<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="number"  v-model="settings.numrows" min="1">
    <input type="checkbox" v-model="settings.humandate" id="humandate"/>
    <label for="humandate">{{ settings.humandate }}</label>
    <div v-for="(email,index) in settings.emails" >
      <input type="text" v-model="settings.emails[index]" :placeholder="index" :key="index">
      <button @click="addField" class="">+ Add</button>
      <button @click="removeField(index)" class="">- Remove</button>
    </div>
  </div>
  {{settings}}
</template>

<style>
</style>

<script setup lang="ts">
import {reactive, ref} from "vue";
type Settings = {
  emails: string[],
  humandate: boolean,
  numrows: number,
}
const props = defineProps<Settings>();

const settings:Settings = reactive({
  emails: props.emails,
  humandate: props.humandate,
  numrows: props.numrows,
})
const emailCount = ref(1);
//const emit = defineEmits(['onChange', 'updateHumanDate']);

const updateHumanDate = (humanDate:boolean) => {
  console.log("choconino is "+humanDate)
};

const addField = ()=>{
  emailCount.value++
  settings.emails.push('');
  /*console.log('agregar');
  console.log(emailCount.value);
  console.log(emailsArr);*/
};
const removeField = (index:number)=>{
  if(emailCount.value >1) {
    emailCount.value--
    settings.emails.splice(index, 1);
  }
 /* console.log('remover')
  console.log(emailCount.value);
  console.log(emailsArr);*/
};
</script>