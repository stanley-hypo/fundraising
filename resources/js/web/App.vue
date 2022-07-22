<template>
    <q-layout view="hHh lpR fFf" class="bg-grey-1 flex flex-col h-screen justify-between">
        <topmenu></topmenu>
        <q-page-container>
            <router-view v-slot="{ Component }">
                <keep-alive :max="15">
                    <component :is="Component" :key="$route.name" v-if="$route.meta.keepAlive" />
                </keep-alive>
                <component :is="Component" :key="$route.name" v-if="!$route.meta.keepAlive" />
            </router-view>
            <pagefooter></pagefooter>
        </q-page-container>

    </q-layout>
</template>

<script setup>
import topmenu from "./components/Layout/Topmenu.vue"
import pagefooter from "./components/Layout/Footer.vue"
</script>
