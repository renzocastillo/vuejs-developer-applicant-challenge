<template>
    <div class="settings">
        <h2>{{ translationStrings.graph_page }}</h2>
        <a class="btn btn-info float-end" @click="data.callData(true)">{{ translationStrings.refresh }}</a>
        <div class="graph-container">
            <BarChartComponent/>
        </div>
    </div>
</template>

<style>
.graph-container{
    max-height: 60vh;
}
</style>
<script setup lang="ts">
/**
 * Component for displaying a bar chart and refreshing its data.
 */
import BarChartComponent from "@/components/BarChartComponent.vue";
import {useDataStore} from "@/stores/data";
import {translationStrings} from "@/router";
import {onBeforeMount} from "vue";

/**
 * Retrieves Pinia data store.
 */
const data = useDataStore();

if(Object.keys(data.graph).length == 0){
    await data.callData();
}
</script>