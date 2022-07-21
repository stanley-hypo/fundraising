import '../bootstrap';
import '../../css/app.css'
import Auth from './store/Auth.js';
import { createApp } from 'vue'
import { createI18n } from 'vue-i18n'
import hk from './lang/hk.json'
import en from './lang/en.json'
import webrouter from "./router/webrouter"
import App from './App.vue'
import { Quasar } from 'quasar'
import IconSet from 'quasar/icon-set/fontawesome-v6'
import 'tw-elements';
// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-symbols-outlined/material-symbols-outlined.css'
import '@quasar/extras/material-symbols-rounded/material-symbols-rounded.css'
import '@quasar/extras/material-symbols-sharp/material-symbols-sharp.css'
import '@quasar/extras/mdi-v6/mdi-v6.css'
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'


axios.defaults.headers.common['Authorization'] = 'Bearer ' + Auth.state.access_token
const i18n = createI18n({
    locale: Auth.getters['auth/Locale'],
    fallbackLocale: 'en',
    messages: {
        hk,
        en
    }
})

const app = createApp(App)
app.use(Quasar, {
    config: {
        brand: {
            primary: '#254f48',
            secondary: '#2c674c',
            accent: '#9C27B0',

            dark: '#1d1d1d',
            'dark-page': '#121212',

            positive: '#21BA45',
            negative: '#C10015',
            info: '#31CCEC',
            warning: '#F2C037'
        },
    },
    plugins: {
    }, // import Quasar plugins and add here
    iconSet: IconSet,
})
app.use(i18n)
app.use(Auth)
app.use(webrouter)
app.mount('#app')
