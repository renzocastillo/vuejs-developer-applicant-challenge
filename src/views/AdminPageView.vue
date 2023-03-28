<template>
  <main v-if="adminPages!= undefined">
    <AdminTable v-if="page=== adminPages.table" :remote-data="remoteData" :settings-data="settingsData"/>
    <AdminGraph v-if="page=== adminPages.graph"/>
    <AdminSettings v-if="page=== adminPages.settings" :emails="settingsData.emails" :humandate="settingsData.humandate"
                   :numrows="parseInt(settingsData.numRows)" />
  </main>
</template>

<script setup lang="ts">
import {inject} from 'vue'
import type {PropType} from "vue";
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";
import {apiURL} from "@/router";
import type {AxiosResponse} from "axios";
const axios: any = inject('axios');
const apiRemoteData = apiURL + "/renzo/v1/remote-data"
const apiGetSettings = apiURL + "/renzo/v1/settings"
//console.log('api remote data '+apiRemoteData);
//console.log('api settings '+apiGetSettings);


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

const remoteData = await axios.get(apiRemoteData).then((response: {
  data: RemoteDataResponse;
}) => { return response.data; });

const settingsData = await axios.get(apiGetSettings).then((response: {
  data: SettingsDataResponse;
}) => { return response.data; });


type AdminPages = {
  table: string,
  graph: string,
  settings: string,
}

const props = defineProps<{
  page: string,
  adminPages: AdminPages,
}>()

</script>