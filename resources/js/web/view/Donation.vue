<template>
  <q-page class="q-pa-md">
    <div
      class="max-w-5xl p-10 bg-white mx-auto my-20 rounded-md drop-shadow-lg"
    >
      <form class="donationForm">
        <h5 class="text-center my-5">Donation</h5>
        <!-- Donation Type -->
        <div class="row">
          <div class="col-3 self-center break-words">
            <label for="">Donation Type</label>
          </div>
          <div class="rectangleRadioGrp col-9">
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
        <!-- <div class="row">
          <div class="col-3 self-center break-words">
            <label for="">Donation Amount</label>
          </div>
          <div class="rectangleRadio col-9">
            <input
              type="radio"
              id="oneOffDonation"
              name="donationType"
              value="200"
              v-model="donationType"
              checked
            />
            <label for="oneOffDonation">One-off Donation</label>
            <input
              type="radio"
              id="monthlyDonation"
              name="donationType"
              value="monthlyDonation"
              v-model="donationType"
            />
            <label for="monthlyDonation">Monthly Donation</label>
          </div>
        </div> -->
        <hr />
        <h5 class="text-center my-5">Donor Information</h5>
        <div class="row">
          <div class="col-3 self-center break-words">
            <label for="">ASDASDasdasdasdnasd,nassadasdasdasdasdsadAS</label>
          </div>
          <div class="col-9">
            <q-input
              outlined
              v-model="ph"
              placeholder="Placeholder"
              :dense="dense"
            />
          </div>
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


