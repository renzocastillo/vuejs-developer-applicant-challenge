import {defineStore} from "pinia";
import {inject, ref} from "vue";
import {apiURL} from "@/router";
import axios from 'axios';

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
type RemoteDataResponse = {
    graph: Graph,
    table: Table
}

export const useDataStore = defineStore('data',()=>{
    const graph = ref({});
    const table = ref({});

    const callData = async () => {
        console.log('entra');
        const apiRemoteData = apiURL + "/renzo/v1/remote-data"
        console.log(apiRemoteData);
        const {table: tableData, graph: graphData} = await axios.get(apiRemoteData).then(({data}: { data: RemoteDataResponse }) => {
            return data;
        });
        graph.value = graphData;
        table.value = tableData;
    };

    return { graph,table,callData}
});