<template>
        <q-input
            v-model="model"
            dense
            filled
            outlined
            stack-label
            mask="####-##-##"
            :rules="defaultrule"
            :disable="defaultdisable"
            hide-bottom-space
        >
            <template #append>
                <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy
                        cover
                        transition-show="scale"
                        transition-hide="scale"
                        @show="closestatus=false"
                    >
                        <q-date
                            v-model="model"
                            mask="YYYY-MM-DD"
                            minimal
                            @update:model-value="(val)=> onUpdate(val)"
                            v-close-popup="closestatus"
                            years-in-month-view
                        >
                        </q-date>
                    </q-popup-proxy>
                </q-icon>
            </template>
            <template #before>
                <slot name="before"></slot>
            </template>
            <template #after>
                <slot name="after"></slot>
            </template>
        </q-input>
        <slot name="after"></slot>
</template>

<!--simple-->
<!--<datepicker-->
<!--    :model="cav.cheque_request_on"-->
<!--    @onUpdate="(val)=>cav.cheque_request_on=val"-->
<!--&gt;-->
<!--!!!!!!!!optional!!!!!!!-->
<!--<template #before>-->
<!--    <div class="w-40 text-right text-subtitle2 text-weight-bold text-grey-10">Requested on/before:</div>-->
<!--</template>-->
<!--</datepicker>-->
<!--simple-->
<script>
export default {
    props: [
        'model', 'rule', 'disable',
    ],
    emits:[
      'onUpdate'
    ],
    data(){
        return{
            closestatus: false,
            defaultdisable: false,
            defaultrule: [val => /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/.test(val) || '請輸入正確日期']
        }
    },
    created() {
        if(this.rule){
            this.defaultrule = this.rule
        }
        if(this.disable){
            this.defaultdisable = this.disable
        }
    },
    methods:{
        onUpdate(val){
            this.$emit('onUpdate', val)
            this.closestatus=true
        },
    },
}
</script>
