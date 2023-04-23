<template>
    <main v-if="page!='' && adminPages!= undefined">
        <suspense>
            <AdminTable v-if="page=== adminPages.table"/>
        </suspense>
        <suspense>
            <AdminGraph v-if="page=== adminPages.graph"/>
        </suspense>
        <suspense>
            <AdminSettings v-if="page=== adminPages.settings" ref="adminSettingsRef"/>
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
import {onBeforeMount,ref,unref} from "vue";

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

/**
 * The settings for the Pinia settings store
 *
 * */
const settings = useSettingsStore();

// Create a ref for the child component
const adminSettingsRef = ref< typeof AdminSettings|null>(null)

/**
 * The on before mount function which calls the settings to initiliaze the app.
 * */
onBeforeMount(async () => {
    await settings.callSettings();
    const adminSettings = adminSettingsRef.value;
    if(adminSettings ){
        adminSettings.numrows = unref(settings.numrows);
        adminSettings.humandate = unref(settings.humandate);
        adminSettings.emails = unref(settings.emails);
    }
});

</script>