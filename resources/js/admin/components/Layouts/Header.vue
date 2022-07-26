<template>
    <header class="bg-white shadow">
        <div class="py-3 px-6 flex flex-wrap justify-between items-center mx-auto" v-if="myHeader.title">
            <h6 class="text-3xl font-bold">{{myHeader.title??""}}</h6>
            <div class="flex space-x-2 justify-end q-gutter-sm" v-if="myHeader.routerLink">
                <q-btn  :color="link.color??'primary'" :to="link.to" size="md" :icon="link.icon" :label="link.text" v-for="link in myHeader.routerLink" />
            </div>
        </div>
        <div class="q-pa-md q-gutter-sm">
            <q-breadcrumbs class="fs-2 my-1 px-3" style="font-size: 14px">
                <q-breadcrumbs-el :to="nav.url??null"  :label="nav.title" v-for="(nav, index) in myHeader.navBar"/>
            </q-breadcrumbs>
        </div>

    </header>
</template>

<script>
export default {
    props: ['myHeader'],
}
</script>
