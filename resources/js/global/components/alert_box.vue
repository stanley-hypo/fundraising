<template>
    <div>
        <div class="alert alert-box" :class="Message.alertType" role="alert" ref="alertBox" v-if="Message.content">
            {{ Message.content }}
        </div>
    </div>
</template>
<script>
import {mapState} from "vuex";

export default {
    computed: {
        ...mapState({
            Message: state => state.alert?.Message??'',
        }),
    },
    created() {
    },
    watch: {
        Message: {
            handler(newValue, oldValue) {
            },
            deep: true
        }
    },
    updated() {
        this.$refs?.alertBox?.scrollIntoView({behavior: "smooth", block: "center"});
    }
}

</script>

