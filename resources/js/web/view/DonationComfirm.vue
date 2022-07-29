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
          {{ formData.paymentMethod }}
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
        <div class="leading-loose grid grid-cols-2 gap-4 break-words sm:grid-cols-10">
            <div class="sm:col-start-1 col-span-1">{{ $t("full_name") }}</div>
            <p class="pl-4 col-start-2 sm:col-start-3 col-span-4">{{ formData.title }}.&nbsp;{{ formData.fullname }}</p>

            <div class="sm:col-start-1 col-span-1">{{ $t("mobile_number") }}</div>
            <p class="pl-4 sm:col-start-3 col-span-4">
                {{ formData.mobileAreacode }}&nbsp;{{ formData.mobile }}
            </p>

            <div class="sm:col-start-1 col-span-1">{{ $t("email") }}</div>
            <p class="pl-4 sm:col-start-3 col-span-4">
                {{ formData.email }}
            </p>

            <div class="sm:col-start-1 col-span-1">{{ $t("address") }}</div>
            <p class="pl-4 sm:col-start-3 col-span-4">
                {{ formData.address1 }}{{ formData.address2 }}{{ formData.address3 }}
            </p>
            <div class="sm:col-start-1 col-span-1">{{ $t("remark") }}</div>
            <p class="pl-4 sm:col-start-3 col-span-4">
                {{ formData.remark }}
            </p>



                <q-btn @click="backtoform" class="justify-self-end col-start-2 sm:col-start-8 col-span-1">back</q-btn>
                <q-btn @click="showdata123" class="bg-gray-900 text-white justify-self-end col-start-2 sm:col-start-10 col-span-1">submit</q-btn>


        </div>

    </div>
  </q-page>
</template>

<script>

import axios from "axios";
import router from "../router/webrouter";


/*    const route = useRoute()
    const router = useRouter() */
const url="http://127.0.0.1:8000";

export default {

    beforeRouteEnter() {
        const formData = JSON.parse(localStorage.getItem("formData"));
        console.log(formData.remark);
        if(!formData.donationType ||
            !formData.donationAmount ||
            !formData.fullname ||
            !formData.mobile ||
            !formData.paymentMethod){
            router.push({path:'/'})
        }
    },
    setup() {
        const formData = JSON.parse(localStorage.getItem("formData"));

        function showdata123() {
            console.log(parseInt(formData.donationAmount));
            axios.post(url + "/api/subscription/store", {
                type: formData.donationType,
                amount: parseInt(formData.donationAmount),
                name: formData.fullname,
                title: formData.title,
                contact_number: formData.mobile,
                email: formData.email,
                address: formData.address1 + " " + formData.address2 + " " + formData.address3,
                area: formData.area,
                district: formData.district,
                receipt: formData.receipt,
                interested: formData.interested,
                payment_method: formData.paymentMethod,

              /*  type: formData.donationType,
                amount: parseInt(formData.donationAmount),
                name: formData.fullname,
                title: "mr",
                contact_number: "434324",
                email: "434324",
                address: "434324",
                area: "434324",
                district: "434324",
                receipt: true,
                interested: false,
                payment_method: "434324",*/

            }).then((response) => console.log(response))
                .catch((error) => console.log(error))
        }



        function backtoform() {
            router.go(-1)
        }
        return{
            formData,
            showdata123,
            backtoform
        }
    }


};
</script>
