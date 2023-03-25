<script setup lang="ts">
import type {PropType} from "vue";
import AdminHome from '@/components/AdminHome.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";
interface AdminPages{
  table:string,
  graph: string,
  settings: string,
}
const props = defineProps({
  page: String,
  adminPages: Object as PropType<AdminPages>,
})
</script>

<template>
  <main v-if="adminPages!= undefined">
    <AdminHome v-if="page=== adminPages.table"/>
    <AdminGraph v-if="page=== adminPages.graph"/>
    <AdminSettings v-if="page=== adminPages.settings"/>
  </main>
</template>
