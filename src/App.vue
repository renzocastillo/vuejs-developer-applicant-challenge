<script setup lang="ts">
import {onMounted} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
/*const props = defineProps({
  adminURL: String,
  ajaxURL: String,
  apiURL: String,
  baseURL: String,
})*/
function removeTrailingSlash(str: string) {
  return str.replace(/\/+$/, '');
}
// lifecycle hooks
onMounted(() => {
  //console.log(props.adminURL)
})
</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <HelloWorld msg="You did it!" />

      <nav>
        <RouterLink :to="{ name: 'admin', query: { page: 'renzo-castillo' }}">Home</RouterLink>
        <RouterLink :to="{ name: 'admin', query: { page: 'renzo-castillo-settings' }}">About</RouterLink>
      </nav>
    </div>
  </header>
  <RouterView :adminPages="{home:'renzo-castillo',settings:'renzo-castillo-settings'}"/>
</template>

<style scoped>
</style>

