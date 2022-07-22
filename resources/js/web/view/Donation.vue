<template>
  <q-page class="q-pa-md">
    <div
      class="max-w-5xl p-10 bg-white mx-auto my-20 rounded-md drop-shadow-lg"
    >
      <form class="donationForm">
        <h5 class="text-center">Donation</h5>
        <div class="rectangleRadio">
          <input
            type="radio"
            id="oneOffDonation"
            name="donationType"
            value="oneOffDonation"
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
        <hr />
        <h5 class="text-center">Donation</h5>
        <q-input
          outlined
          v-model="ph"
          placeholder="Placeholder"
          :dense="dense"
          class="max-w-lg"
        />
        <div>
          <label for="name">Name</label>
          <input type="text" id="name" placeholder="Enter your name" />
        </div>
        <div>
          <label for="age">Your Age</label>
          <input type="text" id="age" name="age" placeholder="Enter your age" />
        </div>
      </form>
    </div>
  </q-page>
</template>

<script>
import { ref } from "vue";
export default {
  props: [],
  name: "Donation",
  components: {},
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


