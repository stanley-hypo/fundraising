const Auth = {
    namespaced: true,
    state () {
        return {
            access_token: null,
            permission: [],
            user: {
            },
        }
    },
    getters:{
        isLogin(state){
            return state.access_token;
        },
        isAdmin(state){
            return state.user.isadmin;
        },
        haspermission(state) {
            return state.user.haspermissions??[];
        }
    },
    mutations: {
        updateAdminUser(state, user){
            state.user = user
        },
        updateAdminToken(state, token){
            state.access_token = token
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
        },
    },
    actions:{
        logout ({ commit }) {
            commit('updateAdminUser', null)
            commit('updateAdminToken', null)
        },

    }
}

export default Auth;

