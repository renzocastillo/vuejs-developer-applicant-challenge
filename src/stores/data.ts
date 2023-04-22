import {defineStore} from "pinia";
import {inject, ref} from "vue";
import {apiData, apiName, apiURL, nonce, translationStrings} from "@/router";
import axios from 'axios';
import {toDate} from "@/helper";

/**
 * Represents the Graph Item
 *
 * @property {number} date - The graph item date
 * @property {number} value - The graph item value
 */
type GraphItem = {
    date: number,
    value: number,
}

/**
 * Represents a graph as an array of graph items.
 */
type Graph = Array<GraphItem>;

/**
 * Represents a table with a title and data.
 *
 * @property {string} title - The title of the table.
 * @property {object} data - The data of the table.
 * @property {string[]} data.headers - The headers of the table.
 * @property {object[]} data.rows - The rows of the table.
 */
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

/**
 * Represents a response containing remote data, including a graph and a table.
 *
 * @property {Graph} graph - The graph data.
 * @property {Table} table - The table data.
 */
type RemoteDataResponse = {
    graph: Graph,
    table: Table
}

/**
 * Pinia store variable which contain all the data retrieving through data API
 */
export const useDataStore = defineStore('data',()=>{
    const graph = ref(<Graph>{});
    const table = ref(<Table>{});
    /**
     * Fetches data from a remote API and updates state variables with the response data.
     *
     * @async
     * @param {boolean} [update=false] - Whether to update the API data or not.
     * @throws {Error} If the API request fails.
     * @returns {Promise<void>}
     */
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

    /**
     * Extracts data from the `graph` state variable and formats it for use in a chart.
     *
     * @returns {ChartData} An object containing labels and datasets that can be used to display a chart.
     */
    const  chartData = ()=>{
        /**
         * Extracts data from the `graph` state variable for use in a chart.
         *
         * @type {Graph}
         */
        const graphData:Graph = graph.value;

        /**
         * Generates an array of date strings from the `graphData` constant.
         */
        const dates= Object.keys(graphData).map((index)=>{
            const item= graphData[parseInt(index)]
            return toDate(item.date).toLocaleString();
        });
        /**
         * Generates an array of data values from the `graphData` constant.
         */
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