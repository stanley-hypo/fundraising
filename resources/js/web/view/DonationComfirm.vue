<template>
  <q-page class="q-pa-md">
    <div
      class="
        max-w-xl
        min-w-xl
        sm:max-w-5xl
        p-10
        bg-[#fffffa]
        mx-auto
        my-20
        rounded-md
        drop-shadow-lg
      "
    >
      <div class="flex justify-center">
        <p>{{ $t("donation") }}</p>
      </div>

      <div class="leading-loose grid grid-cols-2 gap-4 break-words sm:grid-cols-5">
        <div class="sm:col-start-1 col-span-1">{{ $t("donation_type") }}</div>
        <p class="pl-4 col-start-2 sm:col-start-2 col-span-4">{{formData.donationType}}</p>

        <div class="sm:col-start-1 col-span-1">{{ $t("donation_amount") }}</div>
        <p class="pl-4 col-start-2 col-span-1 sm:col-start-2 col-span-4">
            {{formData.donationAmount}}
        </p>

        <div class="sm:col-start-1 col-span-1">{{ $t("payment_method") }}</div>
        <p class="pl-4 sm:col-start-2 col-span-4">
          {{ formData.address1 }}{{ formData.address2 }}{{ formData.address3 }}
        </p>

        <div class="sm:col-start-1 col-span-1">{{ $t("need_receipt") }}</div>
        <p v-if="formData.receipt" class="pl-4 sm:col-start-2 col-span-4">
          {{ $t("display_yes") }}
        </p>
        <p v-else class="pl-4 sm:col-start-2 col-span-4">
          {{ $t("display_no") }}
        </p>
      </div>
      <br /><br />
      <div class="border-b-2"></div>
      <br />
      <div class="flex justify-center">
        <p>{{ $t("donor_info") }}</p>
      </div>
        <div class="leading-loose grid grid-cols-2 gap-4 break-words sm:grid-cols-5">
            <div class="sm:col-start-1 col-span-1">{{ $t("full_name") }}</div>
            <p class="pl-4 col-start-2 sm:col-start-2 col-span-4">{{ formData.title }}.&nbsp;{{ formData.fullname }}</p>

            <div class="sm:col-start-1 col-span-1">{{ $t("mobile_number") }}</div>
            <p class="pl-4 sm:col-start-2 col-span-4">
                +{{ formData.mobileAreacode }}&nbsp;{{ formData.mobile }}
            </p>

            <div class="sm:col-start-1 col-span-1">{{ $t("email") }}</div>
            <p class="pl-4 sm:col-start-2 col-span-4">
                {{ formData.email }}
            </p>

            <div class="sm:col-start-1 col-span-1">{{ $t("address") }}</div>
            <p class="pl-4 sm:col-start-2 col-span-4">
                {{ formData.address1 }}{{ formData.address2 }}{{ formData.address3 }}
            </p>
            <div class="sm:col-start-1 col-span-1">{{ $t("remark") }}</div>
            <p class="pl-4 sm:col-start-2 col-span-4">
                {{ formData.remark }}
            </p>


            <div
                class="col-start-2 justify-self-end sm:col-start-5 col-span-1"
            >

                <q-btn @click="showdata123" class="col-end-6">clickclick</q-btn>
            </div>
        </div>

    </div>
  </q-page>
</template>

<script>
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

/*    const route = useRoute()
    const router = useRouter() */
export default {
  //props:['name','ccc','donationtype','phone','email','address1','address2','address3','text'],
  props: ["name"],
  computed: {},
  methods: {
    showdata123() {
      console.log(parseInt(this.formData.donationAmount)+ "D");
        axios.post("http://127.0.0.1:8000/api/subscription/store",{
            type:this.formData.donationType,
            amount:parseInt(this.formData.donationAmount),
            name:this.formData.fullname,
            title:this.formData.title,
            contact_number:this.formData.mobile,
            email:this.formData.email,
            address:this.formData.address1+" "+this.formData.address2+" "+this.formData.address3,
            area:this.formData.area,
            district:this.formData.district,
            receipt:this.formData.receipt,
            interested:this.formData.interested,
            payment_method:this.formData.paymentMethod,

            /*
            type:'123',
            amount:123,
            name:'xtr',
            title:'mr',
            contact_number:'12345',
            email:'chu@fds',
            address:'hr',
            area:'kt',
            district:'hk',
            receipt:1,
            interested:1,
            payment_method:'not yet',
            */
        }).then((response) => console.log(response))
            .catch((error) => console.log(error))
    },
  },
  setup() {
    const formData = JSON.parse(localStorage.getItem("formData"));
    return {
      formData,
    };
  },
};
</script>
