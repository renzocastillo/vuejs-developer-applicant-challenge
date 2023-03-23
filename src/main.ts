import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './assets/main.scss'

declare global {
    interface Window { wpData: any; }
}

//const app = createApp(App,{adminURL,apiURL,ajaxURL,baseURL})
const app = createApp(App)
app.use(createPinia())
app.use(router)
app.mount('#app')


