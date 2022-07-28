<template>
  <Header :myHeader="myHeader"></Header>
  <main>
    <div class="q-pa-md">
      <q-card class="my-card">
        <q-card-section>
          <div class="flex flex-wrap justify-between gap-2">
            <div class="text-h6">Edit Role</div>
            <q-btn
              label="Submit"
              type="submit"
              text-right
              color="primary"
              size="md"
            />
          </div>
        </q-card-section>

        <q-table
          :title="role?.name + ' Permission'"
          :rows="permissionslists"
          :columns="permission_cols"
          row-key="id"
          selection="multiple"
          v-model:selected="selectedpermission"
          rows-per-page-options="0"
        />
        <q-card-section>
          <div class="flex flex-wrap justify-end gap-2">
            <q-btn
              label="Submit"
              type="button"
              @click="onSubmit"
              text-right
              color="primary"
              size="md"
            />
          </div>
        </q-card-section>
      </q-card>
    </div>
  </main>
</template>
<script>
import Header from "../../components/Layouts/Header.vue";
import AdminAuthService from "../../service/AdminAuthService";
import { NotifyService } from "../../service/Service";
import { useQuasar } from "quasar";
export default {
  components: {
    Header,
  },
  data() {
    return {
      myHeader: {
        title: "Edit Role List",
        navBar: [
          {
            title: "Role List",
            url: "/admin/usergroup",
          },
          {
            title: "Edit Role",
          },
        ],
      },
      selectedpermission: [],
      role: {},
      permissionslists: [],
      permission_cols: [
        {
          name: "description",
          label: "Permission Name",
          align: "center",
          field: "description",
          sortable: true,
        },
      ],
    };
  },
  setup() {
    const $q = useQuasar();
    return {
      showLoading() {
        $q.loading.show();
      },
      hideLoading() {
        $q.loading.hide();
      },
    };
  },
  mounted() {
    if (!this.$route.params.id) {
      this.$router.push("/admin");
    }
    //init
    this.permissionslists = [];
    this.selectedpermission = [];
    this.role = {};
    AdminAuthService.getRoleDetail({
      id: this.$route.params.id,
    }).then((response) => {
      this.role = response.result.role;
      this.permissionslists = response.result.permissions;
      const existing_pr = response.result.rolePermissions;
      for (let item of existing_pr) {
        const finded = this.permissionslists.filter(
          (x) => x.id == item.permission_id
        )[0];
        this.selectedpermission.push(finded);
      }
    });
  },
  methods: {
    onSubmit() {
      // formData.append('permissions')
      this.showLoading();
      let permissions = [];
      for (let item of this.selectedpermission) {
        permissions.push(item.id);
      }
      AdminAuthService.updateRole({
        id: this.role.id,
        permissions: permissions,
      })
        .then((response) => {
          NotifyService.commitNotify({
            color: "positive",
            message: "Updated Successfully",
            icon: "check",
            position: "",
          });
          this.$router.replace("/admin/usergroup");
        })
        .finally(() => {
          this.hideLoading();
        });
    },
  },
};
</script>