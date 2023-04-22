import { createRouter, createWebHistory } from 'vue-router'
/**
 * The `WPData` interface defines the shape of an object that holds various data related to WordPress.
 *
 * @interface WPData
 * @property {string} adminURL - The URL of the WordPress admin dashboard.
 * @property {string} adminPath - The slug path to the WordPress admin directory.
 * @property {any} adminPages - An object that contains all the admin pages slugs of our plugin.
 * @property {string} ajaxURL - The URL for the WordPress AJAX handler.
 * @property {string} apiURL - The URL for the WordPress REST API.
 * @property {string} apiName - The name of the WordPress REST API namespace.
 * @property {string} apiSettings - The WordPress REST API settings url.
 * @property {string} apiData - The WordPress REST API data url.
 * @property {string} basePath - The base Wordpress website url.
 * @property {string} nonce - The WordPress security nonce for form submissions and AJAX requests.
 * @property {Object} translationStrings - An object that maps translation string keys to their corresponding values.
 * @property {string} translationStrings.table_page - The translation string for the "Table" page.
 * @property {string} translationStrings.graph_page - The translation string for the "Graph" page.
 * @property {string} translationStrings.graph_values - The translation string for graph values.
 * @property {string} translationStrings.settings_page - The translation string for the "Settings" page.
 * @property {string} translationStrings.numrows - The translation string for the number of rows.
 * @property {string} translationStrings.humandate - The translation string for a human-readable date.
 * @property {string} translationStrings.emails - The translation string for email addresses.
 * @property {string} translationStrings.emails_list - The translation string for a list of email addresses.
 * @property {string} translationStrings.remove - The translation string for the "Remove" button.
 * @property {string} translationStrings.add - The translation string for the "Add" button.
 * @property {string} translationStrings.refresh - The translation string for the "Refresh" button.
 */
interface WPData{
    adminURL: string,
    adminPath: string,
    adminPages: any,
    ajaxURL: string,
    apiURL: string,
    apiName: string,
    apiSettings: string,
    apiData: string,
    basePath: string,
    nonce: string,
    translationStrings: {
        table_page: string,
        graph_page: string,
        graph_values: string,
        settings_page: string,
        numrows: string,
        humandate: string,
        emails: string,
        emails_list: string,
        remove: string,
        add: string,
        refresh: string,
    }
}
declare global {
    interface Window { wpData: WPData }
}
const wpData= window.wpData ||
    {
        'adminURL':'https://vue-plugin.test/wp-admin/',
        'adminPath': '',
        'adminPages': {table:'renzo-castillo',graph:'renzo-castillo-graph',settings:'renzo-castillo-settings'},
        'ajaxURL':'https://vue-plugin.test/wp-admin/admin_ajax.php',
        'apiURL':'https://vue-plugin.test/wp-json/',
        'apiName': 'renzo-castillo/v1',
        'apiSettings': '/settings',
        'apiData': '/remote-data',
        'basePath':'',
        'nonce':'abc',
        'translationStrings': {
            "table_page": 'text',
            "graph_page": 'text',
            "graph_values": 'text',
            "settings_page": 'text',
            "numrows": 'text',
            "humandate": 'text',
            "emails": 'text',
            "emails_list": 'text',
            "remove": 'text',
            "add": 'text',
            "refresh": 'text',
        }
    };
const {adminURL,adminPath,adminPages,ajaxURL,apiURL,apiName,apiSettings, apiData, basePath,nonce,translationStrings} = wpData;

/**
 * Creates a new router instance for the Vue.js application.
 *
 * @constructor
 * @param {Object} options - An options object that specifies the history mode and the routes of the router.
 * @param {string} options.history - The type of history mode to use for the router (e.g. "hash" or "history").
 * @param {Array} options.routes - An array of route objects that define the paths and components for the router.
 * @param {string} options.routes[].path - The path to match for the route.
 * @param {string} options.routes[].name - The name of the route.
 * @param {function} options.routes[].component - A function that asynchronously loads the component for the route.
 * @param {function} options.routes[].props - A function that defines the props to be passed to the component for the route.
 * @returns {Object} - The new router instance.
 */
const router = createRouter({
  history: createWebHistory(basePath),
  routes: [
    {
        path: adminPath,
        name: 'admin',
        component: async () => await import( '../views/AdminPageView.vue'),
        props: route => ({ page: route.query.page || '' })
    }
  ],
})

export { router, adminURL,adminPath,adminPages,ajaxURL,apiURL,apiName, apiSettings, apiData, basePath,nonce,translationStrings};