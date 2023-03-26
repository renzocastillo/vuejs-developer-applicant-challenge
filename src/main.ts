import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import {adminPages,apiURL, router} from './router'
import "bootstrap/dist/css/bootstrap.min.css";
import './assets/main.scss'
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(App,{adminPages,apiURL})
app.use(createPinia())
app.use(router)
app.use(VueAxios,axios)
app.provide('axios', app.config.globalProperties.axios)
app.mount('#app')


