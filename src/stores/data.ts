import {defineStore} from "pinia";
import {inject, ref} from "vue";
import {apiURL} from "@/router";
import axios from 'axios';
import {toDate} from "@/helper";

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
    const callData = async (update:boolean = false) => {
        console.log('entra');
        const apiRemoteData = apiURL + "/renzo/v1/remote-data"+ "?update="+update
        console.log(apiRemoteData);
        const {table: tableData, graph: graphData} = await axios.get(apiRemoteData).then(({data}: { data: RemoteDataResponse }) => {
            console.log(data);
            return data;
        });
        graph.value = graphData;
        table.value = tableData;
    };

    const  chartData = ()=>{
        const graphData:any = graph.value;
        const dates= Object.keys(graphData).map((index)=>{
            const item= graphData[index]
            return toDate(item.date).toLocaleString();
        });
        const values= Object.keys(graphData).map((index)=>{
            const item= graphData[index]
            return item.value;
        });
        return {
            labels: dates,
            datasets: [{data:values}]
        }

    }

    return { graph,table,callData,chartData}
});