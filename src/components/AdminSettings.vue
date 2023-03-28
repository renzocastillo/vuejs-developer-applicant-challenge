<template>
  <div class="settings">
    <h2>Settings page</h2>
    <input type="checkbox" :checked="humandate" id="humandate" @change="updateHumanDate(humandate)"/>
    <label for="humandate">{{ humandate }}</label>
    <div v-for="email in emails">
      <span>+</span> {{email}} <span>-</span>
    </div>
  </div>
</template>

<style>
</style>

<script setup lang="ts">
const props = defineProps<{
  emails: string[],
  humandate: boolean,
  numrows: number,
}>();

//const emit = defineEmits(['onChange', 'updateHumanDate']);

const updateHumanDate = function (humanDate:boolean) {
  console.log("choconino is "+humanDate)
};
</script>