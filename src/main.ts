import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import {adminPages, router} from './router'
import './assets/main.scss'


const app = createApp(App,{adminPages})
app.use(createPinia())
app.use(router)
app.mount('#app')


