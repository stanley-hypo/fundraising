<template>
  <Header :myHeader="myHeader"></Header>
  <main>
    <div class="q-pa-md">
      <q-form method="post" @submit.prevent="onSubmit" autocomplete="off">
        <q-card class="my-card">
          <q-card-section>
            <q-card-section>
              <div class="flex flex-wrap justify-between gap-2">
                <div class="text-h6">Monthly Donation Detail</div>
                <q-btn
                  label="Submit"
                  type="submit"
                  text-right
                  color="primary"
                  size="md"
                />
              </div>
            </q-card-section>
            <q-card-section>
              <div class="grid grid-cols-2 gap-2">
                <q-input
                  v-model.trim="subscription.name"
                  lazy-rules
                  filled
                  outlined
                  label="Name"
                  :rules="[
                    (val) => !!val || val?.length > 2 || 'Field must be filled',
                  ]"
                >
                </q-input>
                <q-select
                  label="Title"
                  v-model="subscription.title"
                  filled
                  outlined
                  :options="titles"
                  lazy-rules
                  :rules="[(val) => !!val || 'Field must be filled']"
                />
                <q-select
                  label="Type"
                  v-model="subscription.type"
                  filled
                  outlined
                  :options="types"
                  lazy-rules
                  :rules="[(val) => !!val || 'Field must be filled']"
                />
                <q-input
                  v-model.trim="subscription.amount"
                  lazy-rules
                  filled
                  outlined
                  label="amount"
                  :rules="[
                    (val) => !!val || val?.length > 2 || 'Field must be filled',
                  ]"
                />
                <q-input
                  v-model.trim="subscription.contact_number"
                  lazy-rules
                  filled
                  outlined
                  label="Contact Number"
                  :rules="[
                    (val) => !!val || val?.length > 2 || 'Field must be filled',
                  ]"
                />
                <q-input
                  v-model.trim="subscription.email"
                  lazy-rules
                  filled
                  outlined
                  label="Email"
                  type="email"
                  :rules="[(val) => !!val || 'Field must be filled']"
                >
                </q-input>
                <q-input
                  v-model.trim="subscription.address"
                  lazy-rules
                  filled
                  outlined
                  label="Address"
                />
                <q-select
                  label="Area"
                  v-model="subscription.area"
                  filled
                  outlined
                  :options="areas"
                  lazy-rules
                />
                <q-select
                  label="District"
                  v-model="subscription.district"
                  filled
                  outlined
                  :options="districts"
                  lazy-rules
                />
                <q-select
                  label="Payment Method"
                  v-model="subscription.payment_method"
                  filled
                  outlined
                  :options="payment_methods"
                  lazy-rules
                />
                <q-checkbox
                  size="xl"
                  :true-value="1"
                  :false-value="0"
                  v-model="subscription.receipt"
                  label="Receipt"
                ></q-checkbox>
                <q-checkbox
                  size="xl"
                  :true-value="1"
                  :false-value="0"
                  v-model="subscription.interested"
                  label="Interested"
                ></q-checkbox>
              </div>
            </q-card-section>

            <q-card-section>
              <div class="flex flex-wrap justify-end gap-2">
                <q-btn
                  label="Submit"
                  type="submit"
                  text-right
                  color="primary"
                  size="md"
                />
              </div>
            </q-card-section>
          </q-card-section>
        </q-card>
      </q-form>
    </div>
  </main>
</template>

<script>
import Header from "../../components/Layouts/Header.vue";
import DonationService from "../../service/DonationService";
import { NotifyService } from "../../service/Service";

export default {
  components: {
    Header,
  },
  data() {
    return {
      myHeader: {
        title: "Edit Donation",
        navBar: [
          {
            title: "Monthly Donation",
            url: "/admin/donation/monthly_donation",
          },
          {
            title: "Donation Detail",
            url:
              "/admin/donation/monthly_donation/view/" + this.$route.params.id,
          },
          {
            title: "Edit Donation",
          },
        ],
      },
      subscription: {
        name: "",
        title: "",
        type: "",
        amount: "",
        contact_number: "",
        email: "",
        address: "",
        area: "",
        district: "",
        payment_method: "",
        receipt: "",
        interested: "",
      },
      titles: ["Mr", "Miss", "Ms", "Mrs", "Dr", "Prof"],
      types: ["oneOffDonation", "monthlyDonation"],
      areas: ["WONG NAI CHUNG GAP", "Miss", "Ms", "Mrs", "Dr", "Prof"],
      districts: ["HONG_KONG", "KOWLOON", "NEW TERRITORIES", "LANTAU"],
      payment_methods: ["fku", "payme"],
    };
  },
  watch: {},

  created() {
    //get role
    // ********
    // AdminAuthService.roleList().then((response) => {
    //   console.log(response);
    //   this.roles = response.result.roles;
    //   this.permissions = response.result.permissions;
    //   this.permissionsByRole = response.result.permissionsByRole;
    // });
    // Use .then 不用用 sync / await
    // ********
    //get subscription
    DonationService.getMonthlyDetail({
      id: this.$route.params.id,
    }).then((response) => {
      this.subscription = response.result;
      // ********
      //must check before assign
      // ********
    });
  },

  methods: {
    // roleOnChange(role){
    //     let self = this;
    //     this.user.role = role;
    //     this.defaultPermissions = [];
    //
    //     this.permissionsByRole[role].forEach(function (value){
    //         self.defaultPermissions.push(String(value['id']));
    //     });
    // },

    onSubmit() {
      DonationService.updateMonthlyDetail({
        id: this.subscription.id,
        name: this.subscription.name,
        title: this.subscription.title,
        type: this.subscription.type,
        amount: this.subscription.amount,
        contact_number: this.subscription.contact_number,
        email: this.subscription.email,
        address: this.subscription.address,
        area: this.subscription.area,
        district: this.subscription.district,
        payment_method: this.subscription.payment_method,
        receipt: this.subscription.receipt,
        interested: this.subscription.interested,
      }).then((response) => {
        if (response.success) {
          NotifyService.commitNotify({
            color: "positive",
            message: response.message ?? "Updated",
            icon: "check",
            position: "",
          });
          this.$router.replace("/admin/donation/monthly_donation");
        }
      });
    },
  },
};
</script>
