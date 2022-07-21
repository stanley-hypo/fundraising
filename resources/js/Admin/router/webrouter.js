import { createWebHistory, createRouter } from "vue-router";
//user 職員
import Login from "../view/Auth/Login.vue";
import Dashboard from "../view/Auth/Dashboard.vue";

//Store
import AdminStore from "../store/AdminStore";


const routes = [
    {path: '/admin/login', component: Login, name: 'Admin Login',  meta: { requiresAuth: false }},

    //login 後
    {path: '/admin', component: Dashboard,  meta: { requiresAuth: true, keepAlive:false }},

    // 404
    { path: "/admin/:pathMatch(.*)*", component: {
            template: "",
            created: function() {
                // Redirect outside the app using plain old javascript
                window.location.href = "/admin/login";
            }
        }
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !AdminStore.getters['auth/isLogin']) {
        return {
            path: '/admin/login',
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
        }
    }
    if(to.meta.permission){
        if(!AdminStore.getters['auth/isAdmin']){
            const haspermissions = AdminStore.getters['auth/haspermission']
            //no permissions
            if(haspermissions.indexOf(to.meta.permission) == -1){
                return {
                    path: '/admin',
                }
            }
        }
    }
});

export default router;
