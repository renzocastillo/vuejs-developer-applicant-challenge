import {defineStore} from "pinia";
import {inject, ref} from "vue";
import {apiData, apiName, apiURL, nonce, translationStrings} from "@/router";
import axios from 'axios';
import {toDate} from "@/helper";

type GraphItem = {
    date: number,
    value: number,
}

type Graph = Array<GraphItem>;

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
    const graph = ref(<Graph>{});
    const table = ref(<Table>{});
    const callData = async (update:boolean = false) => {
        const apiRemoteData = apiURL + apiName + apiData + "?update="+update
        const config = {
            headers: {
                'X-WP-Nonce': nonce,
                'Content-Type': 'application/json',
            },
            withCredentials: true,
            credentials: 'same-origin',
        }
        const {table: tableData, graph: graphData} = await axios.get(apiRemoteData,config).then(({data}: { data: RemoteDataResponse }) => {
            return data;
        });
        graph.value = graphData;
        table.value = tableData;
    };

    const  chartData = ()=>{
        const graphData:Graph = graph.value;
        const dates= Object.keys(graphData).map((index)=>{
            const item= graphData[parseInt(index)]
            return toDate(item.date).toLocaleString();
        });
        const values= Object.keys(graphData).map((index)=>{
            const item= graphData[parseInt(index)]
            return item.value;
        });
        return {
            labels: dates,
            datasets: [{
                label: translationStrings.graph_values,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                data:values
            }]
        }

    }

    return { graph,table,callData,chartData}
});