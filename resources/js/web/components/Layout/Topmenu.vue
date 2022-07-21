<template>
    <q-header elevated>
      <q-toolbar class="bg-white">
          <q-toolbar-title>
              <router-link to="/" class="text-white text-bold" style="text-decoration: none;" >
              <q-img  src="../images/logo_Ymca.png"
                     style="width:80px;"
              ></q-img>
              </router-link>
          </q-toolbar-title>
            <q-separator/>
          <div class="flex justify-center mt-4 text-black">
                <span class="mx-4">
                    <a class="text-md text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out" href="javascript:void(0)"  v-if="$i18n.locale != 'hk'" v-on:click="setLocate('hk')">中</a>
                    <span class="text-black" v-else>中</span>
                </span>
              |
              <span class="mx-4">
                    <a class="text-md text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out" href="javascript:void(0)" v-if="$i18n.locale != 'en'" v-on:click="setLocate('en')">English</a>
                    <span  class="text-black" v-else>English</span>
                </span>
          </div>
      </q-toolbar>
    </q-header>
</template>
<script>
    export default{
        name: 'MyLayout',
        data(){
            return{
                leftDrawerOpen: false
            }
        },
        methods:{
            setLocate(lang){
                this.$store.commit(
                    'auth/updateLocale',
                    lang
                )
                this.$router.go()
            }
        },
        computed: {
            localLabel() {
                console.log(this.$i18n.locale)
                if(this.$i18n.locale == "hk"){
                    return "中";
                }
                else{
                    return "ENG";
                }
            }
        },
    }
</script>
