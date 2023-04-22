<template>
    <header>
        <div class="wrapper">
            <div v-if="adminPages!= undefined" class="tabs-container">
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.table }}">Table</RouterLink>
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.graph }}">Graph</RouterLink>
                <RouterLink :to="{ name: 'admin', query: { page: adminPages.settings }}">Settings</RouterLink>
            </div>
        </div>
    </header>

    <RouterView :adminPages="adminPages"/>

</template>

<style scoped>
</style>

<script setup lang="ts">
import {onBeforeMount, onMounted, type PropType} from "vue";
import {RouterLink, RouterView} from 'vue-router'
import {adminPages} from "@/router";
import {useSettingsStore} from "@/stores/settings";

interface AdminPages {
    table: string,
    graph: string,
    settings: string,
}

const props = defineProps<{
    adminPages: AdminPages,
    apiURL: string,
}>()

const settings = useSettingsStore();


onBeforeMount(async () => {
    await settings.callSettings();
});
</script>