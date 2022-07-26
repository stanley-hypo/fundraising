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
    <label :for="value" class="rectangleRadioLabel">{{ title }} </label>
  </div>
</template>

<script>
export default {
  props: ["name", "value", "title"],
  methods: {},
};
</script>

<style>
</style>