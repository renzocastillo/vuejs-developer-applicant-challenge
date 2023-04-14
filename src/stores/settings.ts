import axios, { AxiosError } from "axios";
import {defineStore} from "pinia";
import {ref} from "vue";
import {apiURL, nonce} from "@/router";

type SettingsDataResponse ={
    numrows: string,
    humandate: boolean,
    emails: Array<string>,
}

export const useSettingsStore = defineStore('setter',()=>{
    const emails = ref<string []>([]);
    const humandate = ref(true);
    const numrows = ref(0);
    let callSettingsError: Error = {
        name: "",
        message: ""
    }
    let updateSettingError: Error = {
        name: "",
        message: ""
    }

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
        try {
            const {
                emails: emailsData,
                humandate: humandateData,
                numrows: numrowsData
            } = await axios.get(apiGetSettings, config).then(({data}: { data: SettingsDataResponse }) => {
                return data;
            });
            emails.value = emailsData;
            humandate.value = humandateData;
            numrows.value = parseInt(numrowsData);
        }catch (e:unknown){
            if (axios.isAxiosError(e)) {
                callSettingsError.name=e.message;
                if(e.response){
                    if(e.response.data){
                        callSettingsError.message= e.response.data.message;
                    }
                }
            } else {
                callSettingsError.name="Error";
                callSettingsError.message="Unexpected error ocurred"
            }
        }
    }

    const updateSetting = async (key:string, value:any)=> {
        /*console.log("key is");
        console.log(key);
        console.log("value is");
        console.log(value);
        console.log(nonce);*/
        const apiUpdateSettings = apiURL + "/renzo/v1/settings";
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
        try {
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
            });
            return updated;
        }catch (e: unknown){
            if (axios.isAxiosError(e)) {
                updateSettingError.name=e.message;
                if(e.response){
                    if(e.response.data){
                        updateSettingError.message= e.response.data.message;
                    }
                }
            } else {
                updateSettingError.name="Error";
                updateSettingError.message="Unexpected error ocurred"
            }
        }

    }

    return {emails, humandate, numrows, callSettingsError,updateSettingError,callSettings, updateSetting}
})