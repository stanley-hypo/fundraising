<template>
    <q-page class="bg-orange-50 q-pa-md border-2">
        <div class="flex justify-center">
            <p>{{$t('donation')}}</p>
        </div>

        <div class="grid grid-cols-5 gap-4">
            <div class="col-start-1 col-span-1">{{$t('donation_type')}}</div>
            <p class="col-start-2 col-span-6">{{name}}</p>

            <div class="col-start-1 col-span-1">{{$t('donation_amount')}}</div>
            <p class="col-start-2 col-span-6">{{ccc}}&nbsp;{{phone}}</p>

            <div class="col-start-1 col-span-1">{{$t('payment_method')}}</div>
            <p class="col-start-2 col-span-6">{{address1}}{{address2}}{{address3}}</p>
        </div>
        <br><br><div class='border-b-2'></div><br>
        <div class="flex justify-center">
            <p>{{$t('donor_info')}}</p>
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div class="col-start-1 col-span-1">{{$t('full_name')}}</div>
            <p class="col-start-2 col-span-6">{{name}}</p>

            <div class="col-start-1 col-span-1">{{$t('mobile_number')}}</div>
            <p class="col-start-2 col-span-6">{{ccc}}{{phone}}</p>

            <div class="col-start-1 col-span-1">{{$t('email')}}</div>
            <p class="col-start-2 col-span-6">{{email}}</p>

            <div class="col-start-1 col-span-1">{{$t('address')}}</div>
            <p class="col-start-2 col-span-6">{{address1}}{{address2}}{{address3}}</p>

            <div class="col-start-1 col-span-1">{{$t('remark')}}</div>
            <p class="col-start-2 col-span-6">{{text}}</p>
        </div>
    </q-page>
</template>

<script>
import { useRoute,useRouter } from 'vue-router';
/*    const route = useRoute()
    const router = useRouter() */

export default{
    /*data(){
        return {
            name:'',
            ccc:''
        }
    },
    created(){
        this.name = this.$route.params.name;
        this.ccc=this.$route.params.ccc;
    }*/
    props:['name','ccc','phone','email','address1','address2','address3','text','']
}
</script>
