import { createRouter, createWebHistory } from 'vue-router'
interface WPData{
    adminURL: string,
    adminPath: string,
    adminPages: any,
    ajaxURL: string,
    apiURL: string,
    basePath: string,
    nonce: string,
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
        'apiURL':'https://vue-plugin.test/wp-json',
        'basePath':'',
        'nonce':'abc',
    };
const {adminURL,adminPath,adminPages,ajaxURL,apiURL,basePath,nonce} = wpData;
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

export { router, adminURL,adminPath,adminPages,ajaxURL,apiURL,basePath,nonce};