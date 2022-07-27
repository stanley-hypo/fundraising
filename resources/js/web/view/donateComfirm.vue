<template>
    <q-page class="q-pa-md">
        <div
            class="
        max-w-5xl
        p-10
        bg-[#fffffa]
        mx-auto
        my-20
        rounded-md
        drop-shadow-lg
      "
        >
        <div class="flex justify-center">
            <p>{{$t('donation')}}</p>
        </div>

        <div class="leading-loose grid grid-cols-5 gap-4 ">

            <div class="sm:col-start-1 col-span-1">{{$t('donation_type')}}</div>
            <p class="pl-4 col-start-2 sm:col-start-2 col-span-6 ">dsadsa</p>


            <div class="sm:col-start-1 col-span-1">{{$t('donation_amount')}}</div>
            <p class="pl-4 sm:col-start-2 col-span-6">{{formData.mobileAreacode}}&nbsp;{{formData.mobile}}</p>

            <div class="sm:col-start-1 col-span-1">{{$t('payment_method')}}</div>
            <p class="pl-4 sm:col-start-2 col-span-6">{{formData.address1}}{{formData.address2}}{{formData.address3}}</p>

            <div class="sm:col-start-1 col-span-1">{{$t('need_receipt')}}</div>
            <p v-if="formData.receipt" class="pl-4 sm:col-start-2 col-span-6">{{$t('display_yes')}}</p>
            <p v-else class="pl-4 sm:col-start-2 col-span-6">{{$t('display_no')}}</p>
        </div>
        <br><br><div class='border-b-2'></div><br>
        <div class="flex justify-center">
            <p>{{$t('donor_info')}}</p>
        </div>
        <div class="leading-loose justify-items-stretch sm:grid grid-cols-5 gap-4">
            <div class="col-start-1 col-span-1">{{$t('full_name')}}</div>
            <p class="pl-4 col-start-2 col-span-6">{{formData.title}}.&nbsp;{{formData.fullname}}</p>

            <div class="col-start-1 col-span-1">{{$t('mobile_number')}}</div>
            <p class="pl-4 col-start-2 col-span-6">+{{formData.mobileAreacode}}&nbsp;{{formData.mobile}}</p>

            <div class="col-start-1 col-span-1">{{$t('email')}}</div>
            <p class="pl-4 col-start-2 col-span-6">{{formData.email}}</p>

            <div class="col-start-1 col-span-1">{{$t('address')}}</div>
            <p class="pl-4 col-start-2 col-span-6">{{formData.address1}}&nbsp;&nbsp;{{formData.address2}}&nbsp;&nbsp;{{formData.address3}}</p>

            <div class="col-start-1 col-span-1">{{$t('remark')}}</div>
            <p class="pl-4 col-start-2 col-span-6">{{formData.remark}}</p>



            <q-btn @click="showdata123" class="col-end-6 ">clickclick</q-btn>

        </div>
        </div>
    </q-page>
</template>

<script>
import { useRoute,useRouter } from 'vue-router';

/*    const route = useRoute()
    const router = useRouter() */
export default{

    //props:['name','ccc','donationtype','phone','email','address1','address2','address3','text'],
    props:['name'],
    computed:{
    },
    methods:{
        showdata123(){
            console.log(this.formData.fullname)
        }
    },
    setup(){
        const formData=JSON.parse(localStorage.getItem("formData"))
        return{
            formData
        }
    }


}
</script>
