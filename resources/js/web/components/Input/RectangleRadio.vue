<template>
  <div class="rectangleRadioContainer">
    <input
      v-if="radioChecked"
      checked
      type="radio"
      :id="value"
      class="rectangleRadioInput"
      :name="name"
      :value="value"
      :v-model="name"
    />
    <input
      v-else
      type="radio"
      :id="value"
      class="rectangleRadioInput"
      :name="name"
      :value="value"
      :v-model="name"
    />
    <label :for="value" class="rectangleRadioLabel" @click="returnData">
      {{ title }}
    </label>
  </div>
</template>

<script>
import { onMounted } from "vue";
export default {
  emits: ["updateData"],
  props: ["name", "value", "title", "checked"],
  setup(props) {
    const formData = JSON.parse(localStorage.getItem("formData"));
    let radioChecked = false;
    if (props.checked == props.value) {
      radioChecked = true;
    } else {
      radioChecked = false;
    }
    return {
      formData,
      radioChecked,
    };
  },
  methods: {
    returnData() {
      this.$emit("updateData", this.value);
    },
  },
};
</script>

<style>
</style>