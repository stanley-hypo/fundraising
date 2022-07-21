<template>
    <div></div>
</template>
<script>
import { useQuasar } from 'quasar'
import {mapState} from 'vuex'

export default {
    setup(){
        //should create notify in setup
        const $q = useQuasar()
        function showNotify () {
            const { color, icon, message, position } = this.Message

            $q.notify({
                color,
                icon,
                message,
                position,
                timeout: Math.random() * 5000 + 3000
            })
        }
        return {
            showNotify
        }
    },
    computed: {
        ...mapState({
            Message: state => state.alert?.Message??'',
        }),
    },
    watch:{
        Message:{
            handler(newValue, oldValue) {
                //if there is message to show and haven't been read, show notify
                if(this.Message.message && !this.Message.read){
                    this.showNotify()
                }
            },
            deep:true
        }
    },
}
</script>
