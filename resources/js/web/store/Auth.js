import {createStore} from 'vuex'
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
import Auth from "./modules/Auth";
const ls = new SecureLS({ isCompression: false });

const store = createStore({
    modules: {
        auth: Auth,
    },
    plugins: [
        createPersistedState({
            storage: {
                getItem: key => ls.get(key),
                setItem: (key, value) => ls.set(key, value),
                removeItem: key => ls.remove(key)
            }
        })
    ],
})

export default store;
