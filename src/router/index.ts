import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from "@/views/AboutView.vue";
const wpData= window.wpData ||
    {
        'adminURL':'http://localhost:10009/wp-admin/',
        'adminPATH': '/wp-admin',
        'apiURL':'http://localhost:10009/wp-json/',
        'ajaxURL':'http://localhost:10009/wp-admin/admin_ajax.php',
    };
const {adminURL,adminPATH,apiURL,ajaxUR} = wpData;
console.log(adminPATH);
const router = createRouter({
  history: createWebHistory(adminPATH),
  routes: [
    {
        path: '/admin.php',
        name: 'admin',
        component:HomeView,
        props: route => ({ query: route.query.page })
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      /*component: function (path) {
          console.log('dd');
          return import('../views/AboutView.vue');
      }*/
    }
  ],
})

export default router
