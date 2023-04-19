<template>
    <header>
        <!--    <img alt="Vue logo" class="logo" src="@/assets/logo.png" width="125" height="125" />-->

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
import {onMounted, type PropType} from "vue";
import {RouterLink, RouterView} from 'vue-router'
import {adminPages} from "@/router";
import Header from './components/Header.vue'

interface AdminPages {
    table: string,
    graph: string,
    settings: string,
}

const props = defineProps<{
    adminPages: AdminPages,
    apiURL: string,
}>()

</script>