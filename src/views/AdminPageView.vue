<template>
  <main v-if="adminPages!= undefined">
    <AdminTable v-if="page=== adminPages.table" :table="table"/>
    <AdminGraph v-if="page=== adminPages.graph" :graph="graph"/>
    <AdminSettings v-if="page=== adminPages.settings"/>
  </main>
</template>

<script setup lang="ts">
import {inject} from 'vue'
import type {PropType} from "vue";
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";
import {apiURL} from "@/router";
import {useSettingsStore} from "@/stores/settings";
import type {AxiosResponse} from "axios";
const axios: any = inject('axios');
const apiRemoteData = apiURL + "/renzo/v1/remote-data"
const apiGetSettings = apiURL + "/renzo/v1/settings"

type Graph = [
  date: number,
  value: number,
]

type Table = {
  title: string,
  data : {
    headers: Array <string>,
    rows: Array < {
      id: number,
      url: string,
      title: string,
      pageviews: number,
      date: number,
    }>
  }
}
type RemoteDataResponse = {
  graph: Graph,
  table: Table
}
type SettingsDataResponse ={
  numrows: string,
  humandate: boolean,
  emails: Array<string>,
}

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

const {table, graph} = await axios.get(apiRemoteData).then(({data}:{data:RemoteDataResponse})=>{
  return data;
});

const {emails, humandate, numrows} = await axios.get(apiGetSettings).then(({data}: { data: SettingsDataResponse }) => {
  return data;
});


settings.emails = emails;
settings.humandate = humandate;
settings.numrows = numrows;

</script>