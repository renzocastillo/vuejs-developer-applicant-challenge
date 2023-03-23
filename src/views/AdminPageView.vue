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
  <main>
    <AdminHome v-if="page==='renzo-castillo'"/>
    <AdminSettings v-if="page==='renzo-castillo-settings'"/>
  </main>
</template>
