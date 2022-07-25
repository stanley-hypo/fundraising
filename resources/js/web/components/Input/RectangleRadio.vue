<template>
  <div>
    <input
      type="radio"
      :id="value"
      class="rectangleRadioInput"
      :name="name"
      :value="value"
      v-model="donationType"
      checked
    />
    <label :for="value" class="rectangleRadioLabel" @click="fk()"
      >{{ title }}
    </label>
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