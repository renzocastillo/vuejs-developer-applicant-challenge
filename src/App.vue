<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.png" width="125" height="125" />

    <div class="wrapper">
      <Header msg="You did it!" />

      <nav v-if="adminPages!= undefined">
        <RouterLink :to="{ name: 'admin', query: { page: adminPages.table }}">Table</RouterLink>
        <RouterLink :to="{ name: 'admin', query: { page: adminPages.graph }}">Graph</RouterLink>
        <RouterLink :to="{ name: 'admin', query: { page: adminPages.settings }}">Settings</RouterLink>
      </nav>
    </div>
  </header>
  <Suspense>
  <RouterView :adminPages="adminPages"/>
  </Suspense>
</template>

<style scoped>
</style>

<script setup lang="ts">
import {onMounted, type PropType} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/Header.vue'
interface AdminPages{
  table:string,
  graph: string,
  settings: string,
}
const props = defineProps({
  adminPages: Object as PropType<AdminPages>,
  apiURL: String,
})
/*function removeTrailingSlash(str: string) {
  return str.replace(/\/+$/, '');
}*/
// lifecycle hooks
onMounted(() => {
  //console.log(props.adminURL)
})
</script>