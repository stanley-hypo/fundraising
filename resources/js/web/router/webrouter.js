import { createWebHistory, createRouter } from "vue-router";
import Auth from "../store/Auth";
//VUE
import Home from '../view/Home.vue'
import Donation  from '../view/Donation.vue'
import donateComfirm  from '../view/donateComfirm.vue'

const routes = [
    {path: '/', component: Donation,  meta: { requiresAuth: false }},
    {path: '/donateComfirm/:name/:ccc', name:'donateComfirm',component: donateComfirm,props:true},
    { path: "/:pathMatch(.*)*", component: {
            template: "",
            created: function() {
                // Redirect outside the app using plain old javascript
                window.location.href = "/";
            }
        }
    }

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
    if (to.meta.requiresAuth && !Auth.getters.isLogin) {
        return {
            path: '/login',
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
        }
    }
});

export default router;
