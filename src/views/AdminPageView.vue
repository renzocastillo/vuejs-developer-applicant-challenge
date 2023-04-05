<template>
  <main v-if="page!='' && adminPages!= undefined">
    <AdminTable v-if="page=== adminPages.table"/>
    <AdminGraph v-if="page=== adminPages.graph"/>
    <AdminSettings v-if="page=== adminPages.settings"/>
  </main>
</template>

<script setup lang="ts">
import {inject} from 'vue'
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";
import {useSettingsStore} from "@/stores/settings";
import {useDataStore} from "@/stores/data";
import {adminPages} from "@/router";


type AdminPages = {
  table: string,
  graph: string,
  settings: string,
}

const props = defineProps<{
  page: string,
  adminPages: AdminPages,
}>();

const settings = useSettingsStore();
const data = useDataStore();

await data.callData();
await settings.callSettings();


</script>