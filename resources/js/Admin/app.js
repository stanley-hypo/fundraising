import '../bootstrap';
import '../../css/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from "./router/webrouter"
import AdminStore from "./store/AdminStore";

import { Quasar, Notify, Dialog, Loading } from 'quasar'
import iconSet from 'quasar/icon-set/fontawesome-v6'
import '@quasar/extras/roboto-font/roboto-font.css'
//lang
import langTW from 'quasar/lang/zh-TW'
// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-symbols-outlined/material-symbols-outlined.css'
import '@quasar/extras/material-symbols-rounded/material-symbols-rounded.css'
import '@quasar/extras/material-symbols-sharp/material-symbols-sharp.css'
import '@quasar/extras/mdi-v6/mdi-v6.css'
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'
import '@quasar/extras/ionicons-v4/ionicons-v4.css'
import '@quasar/extras/eva-icons/eva-icons.css'

axios.defaults.headers.common['Authorization'] = 'Bearer ' + AdminStore.state.auth.access_token

const app = createApp(App)
app.use(Quasar, {
    config: {
        brand: {
            primary: '#00418d',
            secondary: '#71b434',
            accent: '#cc4b63',

            dark: '#1d1d1d',
            'dark-page': '#121212',

            positive: '#21BA45',
            negative: '#C10015',
            info: '#31CCEC',
            warning: '#F2C037'
        },
        notify: { /* look at QuasarConfOptions from the API card */ },

    },
    plugins: {
        Notify,
        Dialog,
        Loading
    }, // import Quasar plugins and add here
    iconSet: iconSet,
    lang: langTW
})
app.use(AdminStore)
app.use(router)
app.mixin({
    methods:{
        can(permission){
            if(this.$store.getters['auth/isAdmin']){
                return true
            }else{
                const haspermissions = this.$store.getters['auth/haspermission']
                return haspermissions.indexOf(permission) > -1
            }
        }
    }
});
app.mount('#app')
