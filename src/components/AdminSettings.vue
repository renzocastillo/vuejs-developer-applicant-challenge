<template>
  <div class="settings">
    <h2>Settings page</h2>
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
</script>