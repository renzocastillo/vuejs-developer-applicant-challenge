import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './assets/main.scss'

declare global {
    interface Window { wpData: any; }
}
const wpData= window.wpData ||
    {
        'adminURL':'http://localhost:10009/wp-admin/',
        'apiURL':'http://localhost:10009/wp-json/',
        'ajaxURL':'http://localhost:10009/wp-admin/admin_ajax.php'
    };
const {adminURL,apiURL,ajaxURL} = wpData;
const app = createApp(App,{adminURL,apiURL,ajaxURL})
app.use(createPinia())
app.use(router)
app.mount('#app')
console.log('queso');


//console.log(wpData);


