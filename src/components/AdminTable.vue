<template>
  <h1>This is the table page</h1>
  <TableComponent :fields='responseData.table.data.headers' :items ="responseData.table.data.rows"/>
</template>


<script setup lang="ts">
// Importing the table component
import TableComponent from "@/components/TableComponent.vue";
import {apiURL} from "@/router";
import {inject} from "vue";
import type {AxiosResponse} from "axios";
const studentData = [
  {ID:"01", Name: "Abiola Esther", Course:"Computer Science", Gender:"Female", Age:"17"},
  {ID:"02", Name: "Robert V. Kratz", Course:"Philosophy", Gender:"Male", Age:'19'},
  {ID:"03", Name: "Kristen Anderson", Course:"Economics", Gender:"Female", Age:'20'},
  {ID:"04", Name: "Adam Simon", Course:"Food science", Gender:"Male", Age:'21'},
  {ID:"05", Name: "Daisy Katherine", Course:"Business studies", Gender:"Female", Age:'22'},
]
const fields = [
  'ID','Name','Course','Gender','Age'
]

const api = apiURL + "renzo/v1/remote-responseData"
console.log(api);
const axios: any = inject('axios');
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
type responseData = {
  graph: Graph,
  table: Table
}
const responseData = await axios.get(api).then((response: {
    data: responseData; responseData: AxiosResponse
}) => { return response.data; });
</script>

