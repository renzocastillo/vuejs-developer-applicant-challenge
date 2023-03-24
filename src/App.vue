<script setup lang="ts">
import {onMounted, type PropType} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/Header.vue'
interface AdminPages{
  home:string,
  settings: string,
}
const props = defineProps({
  adminPages: Object as PropType<AdminPages>,
})
/*function removeTrailingSlash(str: string) {
  return str.replace(/\/+$/, '');
}*/
// lifecycle hooks
onMounted(() => {
  //console.log(props.adminURL)
})
</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <Header msg="You did it!" />

      <nav v-if="adminPages!= undefined">
        <RouterLink :to="{ name: 'admin', query: { page: adminPages.home }}">Home</RouterLink>
        <RouterLink :to="{ name: 'admin', query: { page: adminPages.settings }}">About</RouterLink>
      </nav>
    </div>
  </header>
  <RouterView :adminPages="adminPages"/>
</template>

<style scoped>
</style>

