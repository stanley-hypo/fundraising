<template>
    <q-layout view="hHh lpR fFf" class="bg-grey-1">
        <drawer v-if="$store.getters['auth/isLogin']"></drawer>
        <q-page-container>
            <Notify></Notify>
            <router-view v-slot="{ Component }">
                <keep-alive :max="15">
                    <component :is="Component" :key="$route.name" v-if="$route.meta.keepAlive" />
                </keep-alive>
                <component :is="Component" :key="$route.name" v-if="!$route.meta.keepAlive" />
            </router-view>
        </q-page-container>

    </q-layout>
</template>

<script>
import Drawer from "./components/Layouts/Drawer.vue";
import Notify from "./components/notify.vue";
import AdminAuthService from "./service/AdminAuthService";

export default {
    components:{
        Drawer
    },
    created() {
        //reload data and get permission

    }
}
</script>
