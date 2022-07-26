import { createWebHistory, createRouter } from "vue-router";
//user 職員
import Login from "../view/Auth/Login.vue";
import Dashboard from "../view/Auth/Dashboard.vue";
import User from "../view/Auth/list.vue";
import UserView from "../view/Auth/view.vue";
import UserAdd from "../view/Auth/add.vue";
import UserEdit from "../view/Auth/edit.vue";
import Updatepwd from "../view/Auth/updatepwd.vue"

//User Group
import UserGroupList from "../view/UserGroup/list.vue";
import UserGroupEdit from "../view/UserGroup/edit.vue";

//Store
import AdminStore from "../store/AdminStore";


const routes = [
    {path: '/admin/login', component: Login, name: 'Admin Login',  meta: { requiresAuth: false, keepAlive:false }},

    //login 後
    {path: '/admin', component: Dashboard,  meta: { requiresAuth: true, keepAlive:false }},

    //User
    {path: '/admin/user', component: User,  meta: { requiresAuth: true, keepAlive:false, permission:['settings'] }},
    {path: '/admin/user_view/:id', component: UserView,  meta: { requiresAuth: true, keepAlive:false, permission:['settings'] }},
    {path: '/admin/user_add', component: UserAdd,  meta: { requiresAuth: true, keepAlive:false, permission:['settings'] }},
    {path: '/admin/user_edit/:id', component: UserEdit,  meta: { requiresAuth: true, keepAlive:false, permission:['settings'] }},

    //admin only
    {path: '/admin/usergroup', component: UserGroupList, name: 'UserGroupList', meta: { requiresAuth: true, keepAlive:false, permission:['admin'] }},
    {path: '/admin/usergroup/edit/:id', component: UserGroupEdit, name: 'UserGroupEdit', meta: { requiresAuth: true, keepAlive:false, permission:['admin'] }},
    {path: '/admin/user/updatepwd/:id', component: Updatepwd, name: 'Updatepwd', meta: { requiresAuth: true, keepAlive:false, permission:['admin'] }},

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
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
            }
        }else {
            window.scrollTo({ top: 0, left: 0, behavior: 'instant' })
        }
    }
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
