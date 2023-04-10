<template>
    <main v-if="page!='' && adminPages!= undefined">
        <suspense>
            <AdminTable v-if="page=== adminPages.table"/>
        </suspense>
        <suspense>
            <AdminGraph v-if="page=== adminPages.graph"/>
        </suspense>
        <suspense>
            <AdminSettings v-if="page=== adminPages.settings"/>
        </suspense>
    </main>
</template>

<script setup lang="ts">
import {inject, onBeforeMount, onMounted} from 'vue'
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


</script>