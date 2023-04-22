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
/**
 * Component for displaying different admin pages depending on the current page and adminPages object.
 *
 * @prop {string} page - The current page being viewed.
 * @prop {AdminPages} adminPages - An object containing the slugs of the different admin pages.
 */
import AdminTable from '@/components/AdminTable.vue'
import AdminSettings from "@/components/AdminSettings.vue";
import AdminGraph from "@/components/AdminGraph.vue";
import {useSettingsStore} from "@/stores/settings";
import {useDataStore} from "@/stores/data";
import {adminPages} from "@/router";

/**
 * Represents an object with admin page names as keys and their corresponding string values as values.
 *
 * @property {string} table - The slug of the admin table page.
 * @property {string} graph - The slug of the admin graph page.
 * @property {string} settings - The slug of the admin settings page.
 */
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