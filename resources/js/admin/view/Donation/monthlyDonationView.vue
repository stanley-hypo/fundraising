<template>
  <Header :myHeader="myHeader"></Header>
  <main>
    <div class="mx-auto py-6 px-4 sm:px-6">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            User Information
          </h3>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Name</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.name ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Title</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.title ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Type</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.type ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Amount</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.amount ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Contact Number</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.contact_number ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Email</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.email ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Address</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.address ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Area</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.area ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">District</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.district ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.payment_method ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Receipt</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.receipt ?? "" }}
              </dd>
            </div>
            <div
              class="
                even:bg-white
                odd:bg-gray-50
                px-4
                py-5
                sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
              "
            >
              <dt class="text-sm font-medium text-gray-500">Interested</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ subscription?.interested ?? "" }}
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import Header from "../../components/Layouts/Header.vue";
import DonationService from "../../service/DonationService";

export default {
  components: {
    Header,
  },

  data() {
    return {
      myHeader: {
        title: "Donation Detail",
        navBar: [
          {
            title: "Monthly Donation",
            url: "/admin/donation/monthly_donation",
          },
          {
            title: "Donation Detail",
          },
        ],
      },
      subscription: null,
    };
  },

  async created() {
    const response = await DonationService.getMonthlyDetail({
      id: this.$route.params.id,
    });
    if (response?.success) {
      this.subscription = response.result;

      this.myHeader.routerLink = [
        {
          color: "info",
          icon: "edit",
          text: "Edit",
          to: "/admin/user_edit/" + this.user?.id,
        },
      ];

      if (this.$store.getters["auth/isAdmin"]) {
        this.myHeader.routerLink.push({
          color: "warning",
          icon: "password",
          text: "Update Password",
          to: "/admin/user/updatepwd/" + this.user?.id,
        });
      }
    } else {
      await this.$router.push("/admin/subscription");
    }
  },

  mounted() {},

  methods: {},
};
</script>
Z