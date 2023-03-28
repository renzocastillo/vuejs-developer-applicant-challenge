<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="checkbox" :checked="humandate" id="humandate" @change="updateHumanDate(humandate)"/>
    <label for="humandate">{{ humandate }}</label>
    <div v-for="(email,index) in emailsArr" >
      <input type="text" v-model="emailsArr[index]" :placeholder="index" :key="index">
      <button @click="addField" class="">+ Add</button>
      <button @click="removeField(index)" class="">- Remove</button>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
import {reactive, ref} from "vue";
const props = defineProps<{
  emails: string[],
  humandate: boolean,
  numrows: number,
}>();

const emailsArr = reactive(
    props.emails
);
const emailCount = ref(0);
//const emit = defineEmits(['onChange', 'updateHumanDate']);

const updateHumanDate = (humanDate:boolean) => {
  console.log("choconino is "+humanDate)
};

const addField = ()=>{
  emailCount.value++
  emailsArr.push('');
  /*console.log('agregar');
  console.log(emailCount.value);
  console.log(emailsArr);*/
};
const removeField = (index:number)=>{
  emailCount.value--
  emailsArr.splice(index,1);
 /* console.log('remover')
  console.log(emailCount.value);
  console.log(emailsArr);*/
};
</script>