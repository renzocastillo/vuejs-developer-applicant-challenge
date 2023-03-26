<template>
  <main v-if="adminPages!= undefined">
    <h1>{{getData}}</h1>
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
import {apiURL} from "@/router";

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

const api = apiURL + "renzo/v1/remote-data"
console.log(api);

//const post = await fetch(apiURL).then((a) => a.json())

const axios: any = inject('axios');
const getData = await axios.get(api).then((response: { data: any }) => { return response.data; });
//console.log(getData);
//const posts = await getData();
//console.log( posts);


</script>