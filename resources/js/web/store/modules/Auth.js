const Auth = {
    namespaced: true,
    state () {
        return {
            locale: "en",
            access_token: null,
            permission: [],
            user: {
            },
        }
    },
    getters:{
        Locale(state){
            return state.locale;
        },
        isLogin(state){
            return state.access_token;
        },
        haspermission(state) {
            return state.user.haspermissions??[];
        }
    },
    mutations: {
        updateLocale(state, locale){
            state.locale = locale
        },
        updateUser(state, user){
            state.user = user
        },
        updateToken(state, token){
            state.access_token = token
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
        },
    },
    actions:{
        logout ({ commit }) {
            commit('updateUser', null)
            commit('updateToken', null)
        },

    }
}

export default Auth;

