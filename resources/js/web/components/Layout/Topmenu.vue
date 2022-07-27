<template>
  <q-header elevated class="bg-white px-24">
    <q-toolbar>
      <q-toolbar-title>
        <router-link
          to="/"
          class="text-white text-bold"
          style="text-decoration: none"
        >
          <q-btn flat color="primary">
            <q-img src="/assets/images/logo.png" style="width: 80px"></q-img>
          </q-btn>
        </router-link>
      </q-toolbar-title>

      <div class="flex justify-center text-black self-start mt-4">
        <span class="mx-2">
          <a
            class="
              text-md text-blue-600
              hover:text-blue-700
              transition
              duration-300
              ease-in-out
            "
            href="javascript:void(0)"
            v-if="$i18n.locale != 'en'"
            v-on:click="setLocate('en')"
            >ENG</a
          >
          <span class="text-black" v-else>ENG</span>
        </span>
        <span class="mx-2">
          <a
            class="
              text-md text-blue-600
              hover:text-blue-700
              transition
              duration-300
              ease-in-out
            "
            href="javascript:void(0)"
            v-if="$i18n.locale != 'hk'"
            v-on:click="setLocate('hk')"
            >繁體</a
          >
          <span class="text-black" v-else>繁體</span>
        </span>
      </div>
    </q-toolbar>
  </q-header>
</template>
<script>
export default {
  name: "MyLayout",
  data() {
    return {
      leftDrawerOpen: false,
    };
  },
  methods: {
    setLocate(lang) {
      this.$store.commit("auth/updateLocale", lang);
      this.$router.go();
    },
  },
  computed: {
    localLabel() {
      console.log(this.$i18n.locale);
      if (this.$i18n.locale == "hk") {
        return "中";
      } else {
        return "ENG";
      }
    },
  },
};
</script>
