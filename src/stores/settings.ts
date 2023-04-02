import axios from "axios";
import {defineStore} from "pinia";
import {ref} from "vue";
import {apiURL} from "@/router";

type SettingsDataResponse ={
    numrows: string,
    humandate: boolean,
    emails: Array<string>,
}

export const useSettingsStore = defineStore('setter',()=>{
    const emails = ref(['']);
    const humandate = ref(true);
    const numrows = ref(0);

    const addEmailField = () => {
        emails.value.push('');
    };

    const removeEmailField = (index:number) => {
        if(emails.value.length > 1){
            emails.value.splice(index, 1);
        }
    };

    const callSettings = async () => {
        const apiGetSettings = apiURL + "/renzo/v1/settings";
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

    const updateSetting = async (key:any,value:any)=>{
        console.log("key is "+key);
        console.log("value is "+value);
        const apiUpdateSettings= apiURL+"/renzo/v1/settings";
        const updated =await axios.post(apiUpdateSettings,{
            key: key,
            value: value
        }).then(({data}: { data: boolean }) => {
            console.log('response is '+data);
            return data;
        })
        return updated;
    }
    return { emails,humandate,numrows,addEmailField,removeEmailField,callSettings,updateSetting}
})