import {createStore} from 'vuex'
import Auth from "./modules/Auth";
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
import AlertStore from "../../global/store/modules/AlertStore";
const admin_ls = new SecureLS({ isCompression: false });

//admin store
const store = createStore({
    modules: {
        auth: Auth,
        alert: AlertStore
    },
    plugins: [
        createPersistedState({
            storage: {
                getItem: key => admin_ls.get("admin_"+key),
                setItem: (key, value) => admin_ls.set("admin_"+key, value),
                removeItem: key => admin_ls.remove("admin_"+key)
            }
        })
    ],
})

export default store;
