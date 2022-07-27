<template>
  <h1>Hello</h1>
  <button @click="back">Go Back</button>
</template>

<script>
export default {
  methods: {
    back() {
      this.$router.go(-1);
    },
  },
};
</script>

<style>
</style>