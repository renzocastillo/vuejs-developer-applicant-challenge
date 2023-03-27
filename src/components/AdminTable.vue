<template>
  <h2>Table page</h2>
  <TableComponent :fields='remoteData.table.data.headers' :items ="remoteData.table.data.rows"/>
  <ListComponent :items="settingsData.emails"/>
</template>


<script setup lang="ts">
// Importing the table component
import TableComponent from "@/components/TableComponent.vue";
import {apiURL} from "@/router";
import {inject} from "vue";
import type {AxiosResponse} from "axios";
import ListComponent from "@/components/ListComponent.vue";
const axios: any = inject('axios');

const apiRemoteData = apiURL + "renzo/v1/remote-remoteData"
const apiGetSettings = apiURL + "renzo/v1/settings"
console.log(apiRemoteData);


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
type remoteData = {
  graph: Graph,
  table: Table
}
type settingsData ={
  numrows: string,
  humandate: boolean,
  emails: Array<string>,
}

const remoteData = await axios.get(apiRemoteData).then((response: {
    data: remoteData; remoteData: AxiosResponse
}) => { return response.data; });

const settingsData = await axios.get(apiGetSettings).then((response: {
  data: any; remoteData: AxiosResponse
}) => { return response.data; });

</script>

