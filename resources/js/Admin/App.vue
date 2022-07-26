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
        Drawer, Notify
    },
    created() {
        //reload data and get permission
        if(this.$store.getters['auth/isLogin']){
            AdminAuthService.getme().then((response)=>{
                this.$store.commit('auth/updateAdminUser', response.result)
            })
                .catch((error) =>{
                    //無效登入
                    if(error.response.status === 401){
                        NotifyService.commitNotify( { color: 'negative', message: '帳號已登出', dangerous: 'check', position: '' });
                        this.$store.dispatch('auth/logout')
                        this.$router.replace('/admin/login')
                    }else{
                        NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
                    }
                })
        }
    }
}
</script>
