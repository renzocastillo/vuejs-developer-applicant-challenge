import axios from "axios";
import {defineStore} from "pinia";
import {ref} from "vue";
import {apiURL, nonce} from "@/router";

type SettingsDataResponse ={
    numrows: string,
    humandate: boolean,
    emails: Array<string>,
}

export const useSettingsStore = defineStore('setter',()=>{
    const emails = ref(['']);
    const humandate = ref(true);
    const numrows = ref(0);

    const callSettings = async () => {
        const apiGetSettings = apiURL + "/renzo/v1/settings";
        const config = {
            headers: {
                'X-WP-Nonce': nonce,
                'Content-Type': 'application/json',
            },
            withCredentials: true,
            credentials: 'same-origin',
        }
        const {
            emails : emailsData,
            humandate: humandateData,
            numrows: numrowsData
        } = await axios.get(apiGetSettings).then(({data}: { data: SettingsDataResponse }) => {
            return data;
        })
        emails.value = emailsData;
        humandate.value = humandateData;
        numrows.value = parseInt(numrowsData);
    }

    const updateSetting = async (key:string, value:any)=> {
        console.log("key is");
        console.log(key);
        console.log("value is");
        console.log(value);
        //const apigetNonce = apiURL + "/renzo/v1/nonce";
        const apiUpdateSettings = apiURL + "/renzo/v1/settings";
        //const nonce= await axios.get(apigetNonce,{withCredentials:true}).then(({data})=>{ return data });
        console.log(nonce);
        const data = {
            key: key,
            value: value,
        }
        const config = {
            headers: {
                'X-WP-Nonce': nonce,
                'Content-Type': 'application/json',
            },
            withCredentials: true,
        }

        const updated = await axios.post(apiUpdateSettings, data, config).then(({data}: { data: boolean }) => {
            if (data) {
                switch (key) {
                    case 'emails':
                        emails.value = value;
                        break;
                    case 'humandate':
                        humandate.value = value;
                        break;
                    case 'numrows':
                        numrows.value = value;
                        break;
                }
            }
            return data;
        }).catch((error) => {
            console.log("hubo un error");
            // @ts-ignore
            console.error(error.response.status);
        })
        return updated;

    }

    return {emails, humandate, numrows, callSettings, updateSetting}
})