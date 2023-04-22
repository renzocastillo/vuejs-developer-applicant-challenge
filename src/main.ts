import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import {adminPages,apiURL, router} from './router'
import "bootstrap/dist/css/bootstrap.min.css";
import './assets/main.scss'
import axios from 'axios'
import VueAxios from 'vue-axios'
/**
 * Creates a new Vue.js application instance and mounts it to the DOM.
 *
 * @function
 * @param {Object} options - An options object that specifies the application's configuration.
 * @param {Array} options.adminPages - An array of objects representing the admin pages.
 * @param {string} options.apiURL - The base URL for the application's API.
 * @returns {Object} - The new Vue.js application instance.
 */
const app = createApp(App,{adminPages,apiURL})

/**
 * Registers the Pinia state management plugin with the Vue.js application.
 *
 * @function
 */
app.use(createPinia())

/**
 * Registers the Vue Router plugin with the Vue.js application.
 *
 * @function
 * @param {Object} router - The router instance to register.
 */
app.use(router)

/**
 * Registers the Vue Axios plugin with the Vue.js application.
 *
 * @function
 * @param {Object} VueAxios - The Vue Axios plugin to register.
 * @param {Object} axios - The Axios library to use with the Vue Axios plugin.
 */
app.use(VueAxios,axios)

/**
 * Makes the Axios library available to all components in the Vue.js application.
 *
 * @function
 * @param {string} key - The name of the global property to use to access the Axios library.
 * @param {Object} value - The Axios library to make available as a global property.
 */
app.provide('axios', app.config.globalProperties.axios)

/**
 * Mounts the Vue.js application instance to the DOM.
 *
 * @function
 * @param {string} selector - The CSS selector for the element to mount the application to.
 */
app.mount('#app')


