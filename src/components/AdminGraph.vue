<template>
    <div class="settings">
        <h2>{{ translationStrings.graph_page }}</h2>
        <a class="btn btn-info float-end" @click="callData(true)" :disabled="btnDisabled">{{ translationStrings.refresh }}</a>
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
import {onBeforeMount,ref} from "vue";

/**
 * Retrieves Pinia data store.
 */
const data = useDataStore();
const btnDisabled = ref(false);
const callData = async(update:boolean = false)=>{
    if(!btnDisabled.value){
        btnDisabled.value=true;
        await data.callData(update);
        btnDisabled.value=false;
    }
}
if(Object.keys(data.graph).length == 0){
    callData();
}

</script>