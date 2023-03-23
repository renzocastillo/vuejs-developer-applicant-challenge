import { createRouter, createWebHistory } from 'vue-router'
import AdminPageView from '../views/AdminPageView.vue'
const wpData= window.wpData ||
    {
        'adminURL':'http://localhost:10009/wp-admin/',
        'adminPath': '',
        'adminPages': {home:'renzo-castillo',settings:'renzo-castillo-settings'},
        'ajaxURL':'http://localhost:10009/wp-admin/admin_ajax.php',
        'apiURL':'http://localhost:10009/wp-json/',
        'basePath':'',
    };
const {adminURL,adminPath,adminPages,ajaxURL,apiURL,basePath} = wpData;
console.log(adminPath);
const router = createRouter({
  history: createWebHistory(basePath),
  routes: [
    {
        path: adminPath,
        name: 'admin',
        component:AdminPageView,
        props: route => ({ page: route.query.page })
    }
  ],
})

export default router
