<template>
    <header>
        <div class="wrapper">
            <div v-if="adminPages!= undefined" class="tabs-container">
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.table }}">{{ translationStrings.table }}</RouterLink>
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.graph }}">{{ translationStrings.graph }}</RouterLink>
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.settings }}">{{ translationStrings.settings }}</RouterLink>
            </div>
        </div>
    </header>

    <RouterView :adminPages="adminPages"/>

</template>

<style scoped>
</style>

<script setup lang="ts">
/**
 * Vue.js template for the plugin admin page.
 *
 * @property {string} table - The name of the admin page for displaying a table.
 * @property {string} graph - The name of the admin page for displaying a graph.
 * @property {string} settings - The name of the admin page for managing settings.
 * @prop {AdminPages} adminPages - The object containing the names of the admin pages.
 * @prop {string} apiURL - The URL of the API.
 * @return {Object} The Vue.js template.
 */
import {onBeforeMount, onMounted, type PropType} from "vue";
import {RouterLink, RouterView} from 'vue-router'
import {adminPages} from "@/router";
import {useSettingsStore} from "@/stores/settings";
import {translationStrings} from "@/router";

interface AdminPages {
    table: string,
    graph: string,
    settings: string,
}
/**
 * The props for the Vue.js template.
 * @typedef {Object} Props
 * @property {AdminPages} adminPages - The object containing the names of the admin pages.
 * @property {string} apiURL - The URL of the API.
 */
const props = defineProps<{
    adminPages: AdminPages,
    apiURL: string,
}>()

</script>