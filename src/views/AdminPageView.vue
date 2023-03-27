<template>
  <main v-if="adminPages!= undefined">
    <AdminTable v-if="page=== adminPages.table"/>
    <AdminGraph v-if="page=== adminPages.graph"/>
    <AdminSettings v-if="page=== adminPages.settings"/>
  </main>
</template>

<script setup lang="ts">
import {inject, type PropType} from 'vue'
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";

interface AdminPages {
  table: string,
  graph: string,
  settings: string,
}

const props = defineProps({
  page: String,
  adminPages: Object as PropType<AdminPages>,
  data: Object,
})

</script>