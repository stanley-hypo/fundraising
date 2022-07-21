import { createWebHistory, createRouter } from "vue-router";
import Auth from "../store/Auth";
//VUE
import Home from '../view/Home.vue'

const routes = [
    {path: '/', component: Home,  meta: { requiresAuth: false }},
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