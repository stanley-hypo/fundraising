const AlertStore = {
    namespaced: true,
    state () {
        return {
            Message:{
                content: null,
                alertType: null,

                //quasar notify
                color: null,
                icon: null,
                message: null,
                position: null,
                //quasar notify

                read: false,
            }
        }
    },
    getters:{
        getMessage(state){
            return state.Message;
        },
        isRead(state){
            return state.Message.read;
        }
    },
    mutations: {
        updateMessage(state, Message){
            Message.read = false
            state.Message = Message
        },
        ReadMessage(state){
            state.Message.read = true
        }
    },
    actions:{
        reset ({ commit }) {
            commit('updateMessage', {
                content: null,
                alertType: null,
                color: null,
                icon: null,
                message: null,
                position: null,
            })
        },
        read ({ commit }) {
            commit('ReadMessage')
        }
    }
}

export default AlertStore;
