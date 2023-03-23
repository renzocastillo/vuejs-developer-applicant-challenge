import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './assets/main.scss'
interface WPData{
    adminURL: string,
    adminPath: string,
    adminPages: any,
    ajaxURL: string,
    apiURL: string,
    basePath: string,
}
declare global {
    interface Window { wpData: WPData }
}

//const app = createApp(App,{adminURL,apiURL,ajaxURL,baseURL})
const app = createApp(App)
app.use(createPinia())
app.use(router)
app.mount('#app')


