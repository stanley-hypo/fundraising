<template>
  <Header :myHeader="myHeader"></Header>
  <main>
    <div class="mx-auto py-6 px-4 sm:px-6">
      <q-table
        :rows="tableData"
        :columns="columns"
        :filter="tableFiler"
        row-key="id"
      >
        <template v-slot:top-right>
          <q-input
            borderless
            dense
            debounce="300"
            v-model="tableFiler"
            placeholder="Search"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>
        <template v-slot:body-cell-id="props">
          <q-td :props="props">
            <div class="q-gutter-sm">
              <q-btn
                :to="{
                  name: 'Monthly Donation View',
                  params: { id: props.row.id },
                }"
                padding="5px 5px"
                color="primary"
                icon="visibility"
              />
              <q-btn
                :to="{
                  name: 'Monthly Donation Edit',
                  params: { id: props.row.id },
                }"
                padding="5px 5px"
                color="info"
                icon="edit"
              />
            </div>
          </q-td>
        </template>
      </q-table>
    </div>
  </main>
</template>

<script>
import Header from "../../components/Layouts/Header.vue";

export default {
  components: {
    Header,
  },
  data() {
    return {
      myHeader: {
        title: "Monthly Donation",
        navBar: [
          {
            title: "Monthly Donation",
          },
        ],
      },
      tableFiler: "",
      tableData: [],
      columns: [
        {
          name: "id",
          label: "",
          align: "left",
          field: "id",
          sortable: false,
        },
        {
          name: "name",
          align: "center",
          label: "Name",
          field: "name",
          sortable: true,
        },
        {
          name: "title",
          align: "center",
          label: "Title",
          field: "title",
          sortable: true,
        },
        {
          name: "type",
          align: "center",
          label: "Type",
          field: "type",
          sortable: true,
        },
        {
          name: "amount",
          align: "center",
          label: "Amount",
          field: "amount",
          sortable: true,
        },
        {
          name: "contact_number",
          align: "center",
          label: "Contact Number",
          field: "contact_number",
          sortable: true,
        },
        {
          name: "email",
          align: "center",
          label: "Email",
          field: "email",
          sortable: true,
        },
        {
          name: "address",
          align: "center",
          label: "Address",
          field: "address",
          sortable: true,
        },
        {
          name: "area",
          align: "center",
          label: "Area",
          field: "area",
          sortable: true,
        },
        {
          name: "district",
          align: "center",
          label: "District",
          field: "district",
          sortable: true,
        },
        {
          name: "payment_method",
          align: "center",
          label: "Payment Method",
          field: "payment_method",
          sortable: true,
        },
        {
          name: "receipt",
          align: "center",
          label: "Receipt",
          field: "receipt",
          sortable: true,
        },
        {
          name: "interested",
          align: "center",
          label: "Interested",
          field: "interested",
          sortable: true,
        },
      ],
    };
  },
  mounted() {
    this.GetData();
  },
  methods: {
    GetData() {
      axios.post("/adminapi/list_user").then((response) => {
        this.tableData = response.data.result;
      });
    },
  },
};
</script>
