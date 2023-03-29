import {defineStore} from "pinia";
import {reactive, ref} from "vue";

type Settings = {
    emails: string[],
    humandate: boolean,
    numrows: number,
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
    return { emails,humandate,numrows,addEmailField,removeEmailField}
})