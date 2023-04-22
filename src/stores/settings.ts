import axios, { AxiosError } from "axios";
import {defineStore} from "pinia";
import {ref} from "vue";
import {apiName, apiSettings, apiURL, nonce} from "@/router";

/**
 * Represents the response data for settings.
 *
 * @property {string} numrows - The rows table number setting
 * @property {boolean} humandate - The human date setting for the dates at the table view
 * @property {string[]} emails - The set of emails that are retrieved at the list component view
 */
type SettingsDataResponse ={
    numrows: string,
    humandate: boolean,
    emails: Array<string>,
}

/**
 * Pinia store variable which contains all the state variable for the settings api
 */
export const useSettingsStore = defineStore('setter',()=>{
    /**
     * The set of emails that are retrieved at the list component view
     */
    const emails = ref<string []>([]);
    /**
     * The human date setting for the dates at the table view
     */
    const humandate = ref(true);
    /**
     * The rows table number setting
     */
    const numrows = ref(0);
    /**
     * Saves the error response generated when making the callSettings api request
     */
    let callSettingsError: Error = {
        name: "",
        message: ""
    }
    /**
     * Saves the error response generated when making the updateSettings api request
     */
    let updateSettingError: Error = {
        name: "",
        message: ""
    }

    /**
     * Retrieve all settings through API
     *
     * @return Data object containing all settings values
     */
    const callSettings = async () => {
        /**
         * The API url from which settings are going to be retrieved
         */
        const apiGetSettings = apiURL + apiName + apiSettings;
        /**
         * The config parameters for the Axios request, which incldues the X-WP-Nonce header for authentication
         */
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

    /**
     * Updates a specific setting by making an Axios post request to the settings API
     * @param key The option key identifier
     * @param value The value that will be updated to the key option.
     */
    const updateSetting = async (key:string, value:any)=> {
        /**
         * The API url which will be used to update our settings
         */
        const apiUpdateSettings = apiURL + apiName + apiSettings;
        /**
         * The data object to be sent at the post request which contains the option key and option value
         */
        const data = {
            key: key,
            value: value,
        }
        /**
         * The config parameters for the Axios request, which incldues the X-WP-Nonce header for authentication
         */
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