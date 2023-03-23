<script setup lang="ts">
import TheWelcome from '../components/TheWelcome.vue'
const props = defineProps({
  query: { type: String, required: true },
})
</script>

<template>
  <main>
    <h1>{{query}}</h1>
<!--    <h1 v-bind:query="'renzo-castillo'">home</h1>
    <h1 v-bind:query="'renzo-castillo-settings'">settings</h1>-->
<!--    <TheWelcome />-->
  </main>
</template>
