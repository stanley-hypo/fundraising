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
      <form class="donationForm divide-y-2">
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
                name="donationType"
                value="oneOffDonation"
                title="One-off Donation"
              />
              <RectangleRadio
                name="donationType"
                value="monthlyDonation"
                title="Monthly Donation"
              />
            </div>
          </div>
          <!-- Donation Amount -->
          <div class="flex">
            <div class="w-1/4 self-center break-words mb-auto">
              <label for="">{{ $t("donation_amount") }}</label>
            </div>
            <div class="rectangleRadioGrp w-3/4">
              <RectangleRadio name="donationAmount" value="200" title="$200" />
              <RectangleRadio name="donationAmount" value="400" title="$400" />
              <RectangleRadio name="donationAmount" value="600" title="$600" />
              <RectangleRadio name="donationAmount" value="800" title="$800" />
              <RectangleRadio
                name="donationAmount"
                value="1000"
                title="$1000"
              />
              <RectangleRadio
                name="donationAmount"
                value="3000"
                title="$3000"
              />
              <RectangleRadio
                name="donationAmount"
                value="5000"
                title="$5000"
              />
              <RectangleRadio
                name="donationAmount"
                value="10000"
                title="$10000"
              />
              <RectangleRadio
                name="donationAmount"
                value="others"
                title="Others"
              />
            </div>
          </div>
        </div>
        <!-- Donor Information -->
        <div class="mb-4">
          <h5 class="text-center my-5">Donor Information</h5>
          <!-- Input: Name of Donor -->
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for=""
                >{{ $t("full_name") }}<a class="text-red-600">*</a></label
              >
            </div>
            <div class="flex w-full sm:w-full md:w-3/4 lg:w-3/4">
              <div class="mr-5 self-center w-3/5 sm:w-3/4 md:w-3/4 lg:w-2/3">
                <q-input
                  outlined
                  v-model="fullname"
                  placeholder="e.g. Chan Tai Man"
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
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
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
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
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
            <div class="mr-auto">
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
                placeholder=" Room/Flat/Floor e.g. 18A"
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
                placeholder="Building/Estate e.g. Block F, Pamela Youde Nethersole Eastern Hospital"
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
                placeholder="Street No. / Street Name e.g. 3 Lok Man Road"
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
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
                />
                <q-img
                  :src="url"
                  spinner-color="white"
                  style="height: 140px; max-width: 150px"
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
            <q-checkbox v-model="receipt">
              <label for="" class="inline-block"
                >{{ $t("donation_checkbox1") }}
              </label>
            </q-checkbox>
            <q-checkbox v-model="interested">
              <label for="">{{ $t("donation_checkbox2") }}</label>
            </q-checkbox>
          </div>
          <q-btn label="Submit" type="submit" color="primary" />
        </div>
      </form>
    </div>
  </q-page>
</template>

<script>
import { ref } from "vue";
import RectangleRadio from "../components/Input/RectangleRadio.vue";
export default {
  props: [],
  name: "Donation",
  components: { RectangleRadio },
  data() {
    return {
      donationType: "",
    };
  },
  setup() {
    const url = ref("https://placeimg.com/500/300/nature");
    return {
      dense: ref(true),
      url,
      // v-model value
      fullname: ref(""),
      mobileAreacode: ref(""),
      mobile: ref(""),
      email: ref(""),
      address1: ref(""),
      address2: ref(""),
      address3: ref(""),
      title: ref(null),
      area: ref(null),
      district: ref(null),
      remark: ref(""),
      titleOptions: ["Mr", "Miss", "Ms", "Mrs", "Dr", "Prof"],
      areaOptions: ["WONG NAI CHUNG GAP", "Miss", "Ms", "Mrs", "Dr", "Prof"],
      districtOptions: ["HONG_KONG", "KOWLOON", "NEW TERRITORIES", "LANTAU"],
      receipt: ref(false),
      interested: ref(false),
    };
  },
};
</script>


