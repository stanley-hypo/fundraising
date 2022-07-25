<template>
  <q-page class="q-pa-md">
    <div
      class="max-w-5xl p-10 bg-white mx-auto my-20 rounded-md drop-shadow-lg"
    >
      <form class="donationForm divide-y-2">
        <div class="donation">
          <h5 class="text-center my-5">Donation</h5>
          <!-- Donation Type -->
          <div class="flex">
            <div class="w-1/4 self-center break-words mb-auto">
              <label for="">Donation Type</label>
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
              <label for="">Donation Amount</label>
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
        <div class="donationInformation mb-4">
          <h5 class="text-center my-5">Donor Information</h5>
          <!-- Input: Name of Donor -->
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">Name of Donor (Full Name)*</label>
            </div>
            <div class="w-full sm:w-full md:w-3/4 lg:w-1/3">
              <q-input
                outlined
                v-model="ph"
                placeholder="e.g. Chan Tai Man"
                :dense="dense"
              />
            </div>
          </div>
          <!-- Input: Mobile Number -->
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">Mobile Number*</label>
            </div>
            <div class="w-20 mr-8">
              <q-input
                outlined
                v-model="ph"
                placeholder="e.g. 852"
                :dense="dense"
              />
            </div>
            <div class="min-w-8 w-4/12 sm:w-1/4 md:w-1/4 lg:w-1/4">
              <q-input
                outlined
                v-model="ph"
                placeholder="e.g. 87654321"
                :dense="dense"
              />
            </div>
          </div>
          <!-- Input: Email -->
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">Email*</label>
            </div>
            <div class="mr-auto w-full sm:w-full md:w-3/4 lg:w-1/3">
              <q-input
                outlined
                v-model="ph"
                placeholder="e.g. ChanTaiMan@happyemail.com"
                :dense="dense"
              />
            </div>
            <div class="mr-auto">
              Confirmation email will be sent to this email addrss
            </div>
          </div>
          <!-- Input: Address -->
          <div class="flex items-center mb-5">
            <!-- Input: Adress (line 1) -->
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">Address</label>
            </div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                v-model="ph"
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
                v-model="ph"
                placeholder="Building/Estate e.g. Block F, Pamela Youde Nethersole Eastern Hospital"
                :dense="dense"
              />
            </div>
            <!-- Input: Adress (line 3) -->
            <div
              class="w-full sm:w-full lg:w-1/4 self-center break-words"
            ></div>
            <div class="w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                v-model="ph"
                placeholder="Street No. / Street Name e.g. 3 Lok Man Road"
                :dense="dense"
              />
            </div>
          </div>
          <!-- Input: Remark -->
          <div class="flex items-center mb-5">
            <div class="w-full sm:w-full lg:w-1/4 self-center break-words">
              <label for="">Remark</label>
            </div>
            <div class="mb-5 w-full sm:w-full md:w-3/4 lg:w-3/4">
              <q-input
                outlined
                type="textarea"
                v-model="ph"
                placeholder=""
                :dense="dense"
              />
            </div>
          </div>
        </div>
        <!-- Payment Method -->
        <div class="donationInformation mb-4">
          <h5 class="text-center my-5">Payment Method</h5>
          <div class="">
            <div class="flex items-center mb-5">
              <div class="w-1/4 self-center break-words">
                <label for="">Online</label>
              </div>
              <div class="w-3/4">
                <div>Square</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Checkbox -->
        <div class="donationInformation mb-4">
          <div>check</div>
          <div>check</div>
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
    return {
      shape: ref(""),
      text: ref(""),
      ph: ref(""),
      dense: ref(true),
    };
  },
};
</script>


