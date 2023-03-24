<script setup lang="ts">
import type {PropType} from "vue";
import AdminHome from '@/components/AdminHome.vue'
import AdminSettings from "@/components/AdminSettings.vue";
interface AdminPages{
  home:string,
  settings: string,
}
const props = defineProps({
  page: String,
  adminPages: Object as PropType<AdminPages>,
})
</script>

<template>
  <main v-if="adminPages!= undefined">
    <AdminHome v-if="page=== adminPages.home"/>
    <AdminSettings v-if="page=== adminPages.settings"/>
  </main>
</template>
