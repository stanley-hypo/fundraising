<template>
  <div class="rectangleRadioContainer">
    <input
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
export default {
  emits: ["updateData"],
  props: ["name", "value", "title"],
  methods: {
    returnData() {
      this.$emit("updateData", this.value);
    },
  },
};
</script>

<style>
</style>