<template>
  <main v-if="adminPages!= undefined">
    <AdminTable v-if="page=== adminPages.table"/>
    <AdminGraph v-if="page=== adminPages.graph"/>
    <AdminSettings v-if="page=== adminPages.settings" :emails="emails" :humandate="humanDate" :numrows="numRows" />
  </main>
</template>

<script setup lang="ts">
import {inject} from 'vue'
import type {PropType} from "vue";
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";

type AdminPages = {
  table: string,
  graph: string,
  settings: string,
}

const props = defineProps<{
  page: string,
  adminPages: AdminPages,
}>()

const emails = ["a","b","c"];
const humanDate= true;
const numRows = 5;

</script>