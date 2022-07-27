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
      <q-form class="donationForm divide-y-2" @submit.prevent="handleSubmit">
        <!-- Donation -->
        <div class="donation">
          <h5 class="text-center my-5">Donation</h5>
          <!-- Donation Type -->
          <div class="flex">
            <div class="w-1/4 self-center break-words mb-auto">
              <label for="">{{ $t("donation_type") }}</label>
            </div>
            <div class="rectangleRadioGrp w-3/4">
              <RectangleRadio
                v-for="data in donationTypeData"
                :key="data.value"
                name="donationType"
                :value="data.value"
                :title="data.title"
                @updateData="updateDonationType"
              />
            </div>
          </div>
          <!-- Donation Amount -->
          <div class="flex">
            <div class="w-1/4 self-center break-words mb-auto">
              <label for="">{{ $t("donation_amount") }}</label>
            </div>
            <div class="rectangleRadioGrp w-3/4">
              <RectangleRadio
                v-for="data in donationAmountData"
                :key="data.value"
                name="donationAmount"
                :value="data.value"
                :title="data.title"
                @updateData="updateDonationAmount"
              />
            </div>
          </div>
        </div>
        <!-- Donor Information -->
        <div class="mb-4">
          <h5 class="text-center my-5">Donor Information</h5>
          <!-- Input: Name of Donor -->
          <div class="flex items-center mb-1">
            <div class="mb-5 w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for=""
                >{{ $t("full_name") }}<a class="text-red-600">*</a></label
              >
            </div>
            <div class="flex w-full sm:w-full md:w-3/4 lg:w-3/4">
              <div class="mr-5 self-center w-3/5 sm:w-3/4 md:w-3/4 lg:w-2/3">
                <q-input
                  outlined
                  v-model="fullname"
                  :placeholder="$t('ph_fullname')"
                  :dense="dense"
                />
              </div>
              <div class="w-22">
                <q-select
                  filled
                  label="Title"
                  color="white"
                  label-color="white"
                  bg-color="black"
                  dark
                  v-model="title"
                  :options="titleOptions"
                  :dense="dense"
                />
              </div>
            </div>
          </div>
          <!-- Input: Mobile Number -->
          <div class="flex items-center mb-1">
            <div class="mb-4 w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for=""
                >{{ $t("mobile_number") }}<a class="text-red-600">*</a></label
              >
            </div>
            <div class="w-20 mr-8">
              <q-input
                outlined
                type="tel"
                v-model="mobileAreacode"
                placeholder="e.g. 852"
                :dense="dense"
              />
            </div>
            <div class="min-w-8 w-4/12 sm:w-1/4 md:w-1/4 lg:w-1/4">
              <q-input
                outlined
                type="tel"
                v-model="mobile"
                placeholder="e.g. 87654321"
                :dense="dense"
              />
            </div>
          </div>
          <!-- Input: Email -->
          <div class="flex items-center mb-1">
            <div class="mb-4 w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for=""
                >{{ $t("email") }}<a class="text-red-600">*</a></label
              >
            </div>
            <div class="mr-auto w-full sm:w-full md:w-3/4 lg:w-1/3">
              <q-input
                outlined
                v-model="email"
                placeholder="e.g. ChanTaiMan@happyemail.com"
                :dense="dense"
              />
            </div>
            <div class="mb-5 mr-auto">
              Confirmation email will be sent to this email addrss
            </div>
          </div>
          <!-- Input: Address -->
          <div class="flex items-center">
            <!-- Input: Adress (line 1) -->
            <div class="mb-5 w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">{{ $t("address") }}</label>
            </div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                v-model="address1"
                :placeholder="$t('ph_address1')"
                :dense="dense"
              />
            </div>
            <!-- Input: Adress (line 2) -->
            <div
              class="w-full sm:w-full lg:w-1/4 self-center break-words"
            ></div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                v-model="address2"
                :placeholder="$t('ph_address2')"
                :dense="dense"
              />
            </div>
            <!-- Input: Adress (line 3) -->
            <div
              class="w-full sm:w-full lg:w-1/4 self-center break-words"
            ></div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                v-model="address3"
                :placeholder="$t('ph_address3')"
                :dense="dense"
              />
            </div>
            <div
              class="w-full sm:w-full lg:w-1/4 self-center break-words"
            ></div>
            <div class="min-w-6 mr-8 mb-5">
              <q-select
                filled
                label="Area"
                color="white"
                label-color="white"
                bg-color="black"
                dark
                v-model="area"
                :options="areaOptions"
                :dense="dense"
              />
            </div>
            <div class="mb-5 min-w-7">
              <q-select
                filled
                label="District"
                color="white"
                label-color="white"
                bg-color="black"
                dark
                v-model="district"
                :options="districtOptions"
                :dense="dense"
              />
            </div>
          </div>
          <!-- Input: Remark -->
          <div class="flex items-center mb-5">
            <div class="self-start mt-2 w-full sm:w-full lg:w-1/4 break-words">
              <label for="">{{ $t("remark") }}</label>
            </div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                type="textarea"
                v-model="remark"
                :dense="dense"
              />
            </div>
          </div>
        </div>
        <!-- Payment Method -->
        <div class="mb-4">
          <h5 class="text-center my-5">{{ $t("payment_method") }}</h5>
          <div class="">
            <div class="flex items-center mb-5">
              <div
                class="
                  self-start
                  mb-3
                  w-full
                  sm:w-full
                  md:w-1/4
                  lg:w-1/4
                  break-words
                "
              >
                <label for="">{{ $t("online") }}</label>
              </div>
              <div
                class="
                  justify-items-center
                  w-full
                  sm:w-full
                  md:w-3/4
                  lg:w-3/4
                  grid grid-cols-2
                  sm:grid-cols-2
                  md:grid-cols-3
                  lg:grid-cols-3
                  gap-4
                "
              >
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="
                    width: 100% !important;
                    min-width: 80px !important;
                    height: auto !important;
                    max-width: 150px;
                  "
                />
              </div>
            </div>
          </div>
        </div>
        <!-- Checkbox -->
        <div class="flex items-center mb-5 mt-4">
          <div
            class="
              self-start
              mb-3
              w-full
              sm:w-full
              md:w-1/4
              lg:w-1/4
              break-words
            "
          ></div>
          <div class="grid mt-4 w-3/4">
            <q-checkbox v-model="receipt" :label="$t('donation_checkbox1')">
              <q-item-label caption>{{
                $t("donation_checkbox1_caption")
              }}</q-item-label>
            </q-checkbox>

            <q-checkbox
              v-model="interested"
              :label="$t('donation_checkbox2')"
            />
            <q-btn
              :label="$t('submit')"
              type="submit"
              color="black"
              class="w-fit justify-self-end mt-8"
            />
          </div>
        </div>

        <button @click="testing">Hello</button>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { ref, watch, onMounted } from "vue";
import RectangleRadio from "../components/Input/RectangleRadio.vue";
import { useRoute, useRouter } from "vue-router";
import router from "../router/webrouter";

export default {
  props: [],
  name: "Donation",
  components: { RectangleRadio },
  setup() {
    // data
    const dense = ref(true);
    const url = ref("https://placeimg.com/500/300/nature");
    const formData = ref([]);
    const donationType = ref("monthlyDonation");
    const donationAmount = ref("");
    const fullname = ref("");
    const title = ref(null);
    const mobileAreacode = ref("");
    const mobile = ref("");
    const email = ref("");
    const address1 = ref("");
    const address2 = ref("");
    const address3 = ref("");
    const area = ref(null);
    const district = ref(null);
    const remark = ref("");
    const receipt = ref(false);
    const interested = ref(false);
    const titleOptions = ["Mr", "Miss", "Ms", "Mrs", "Dr", "Prof"];
    const areaOptions = [
      "WONG NAI CHUNG GAP",
      "Miss",
      "Ms",
      "Mrs",
      "Dr",
      "Prof",
    ];
    const districtOptions = [
      "HONG_KONG",
      "KOWLOON",
      "NEW TERRITORIES",
      "LANTAU",
    ];

    const donationTypeData = [
      {
        name: "donationType",
        value: "oneOffDonation",
        title: "One-off donation",
      },
      {
        name: "donationType",
        value: "monthlyDonation",
        title: "Monthly donation",
      },
    ];

    const donationAmountData = [
      { name: "donationAmount", value: "200", title: "$200" },
      { name: "donationAmount", value: "400", title: "$400" },
      { name: "donationAmount", value: "600", title: "$600" },
      { name: "donationAmount", value: "800", title: "$800" },
      { name: "donationAmount", value: "3000", title: "$3000" },
      { name: "donationAmount", value: "5000", title: "$5000" },
      { name: "donationAmount", value: "10000", title: "$10000" },
      { name: "donationAmount", value: "other", title: "Others" },
    ];

    // update value from child component (RectangleRadio.vue)
    const updateDonationType = (value) => {
      donationType.value = value;
    };
    const updateDonationAmount = (value) => {
      donationAmount.value = value;
    };

    const testing = () => {
      console.log(formData.value.fullname);
    };

    // functions
    const handleSubmit = () => {
      // router.push({
      //   name: "donateComfirm",
      //   params: {
      //     name: fullname.value,
      //     donationType: donationType.value,
      //     donationAmount: donationAmount.value,
      //     ccc: mobileAreacode.value,
      //     phone: mobile.value,
      //     email: email.value,
      //     address1: address1.value,
      //     address2: address2.value,
      //     address3: address3.value,
      //     title: title.value,
      //     //area: area.value,
      //     //district: district.value,
      //     //text:remark.value
      //   },
      // });
      formData.value = {
        donationType: donationType.value,
        donationAmount: donationAmount.value,
        fullname: fullname.value,
        title: title.value,
        mobileAreacode: mobileAreacode.value,
        mobile: mobile.value,
        email: email.value,
        address1: address1.value,
        address2: address2.value,
        address3: address3.value,
        area: area.value,
        district: district.value,
        remark: remark.value,
        receipt: receipt.value,
        interested: interested.value,
      };
    };

    watch(
      formData,
      (newVal) => {
        localStorage.setItem("formData", JSON.stringify(newVal));
      },
      { deep: true }
    );

    onMounted(() => {
      formData.value = JSON.parse(localStorage.getItem("formData")) || [];

      // if (formData.value.donationType) {
      //   // console.log("helloooo");
      //   console.log(donationType);
      // }
      if (formData.value.fullname) {
        fullname.value = formData.value.fullname;
      }
      if (formData.value.title) {
        title.value = formData.value.title;
      }
      if (formData.value.mobileAreacode) {
        mobileAreacode.value = formData.value.mobileAreacode;
      }
      if (formData.value.mobile) {
        mobile.value = formData.value.mobile;
      }
      if (formData.value.email) {
        email.value = formData.value.email;
      }
      if (formData.value.address1) {
        address1.value = formData.value.address1;
      }
      if (formData.value.address2) {
        address2.value = formData.value.address2;
      }
      if (formData.value.address3) {
        address3.value = formData.value.address3;
      }
      if (formData.value.area) {
        area.value = formData.value.area;
      }
      if (formData.value.district) {
        district.value = formData.value.district;
      }
      if (formData.value.remark) {
        remark.value = formData.value.remark;
      }
      if (formData.value.receipt) {
        receipt.value = formData.value.receipt;
      }
      if (formData.value.interested) {
        interested.value = formData.value.interested;
      }
    });

    return {
      // return data
      dense,
      url,
      donationType,
      donationAmount,
      fullname,
      title,
      mobileAreacode,
      mobile,
      email,
      address1,
      address2,
      address3,
      area,
      district,
      remark,
      titleOptions,
      areaOptions,
      districtOptions,
      receipt,
      interested,
      donationTypeData,
      donationAmountData,
      // return functions
      handleSubmit,
      testing,
      updateDonationType,
      updateDonationAmount,
    };
  },
};
</script>


