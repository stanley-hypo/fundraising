<template>
  <Header :myHeader="myHeader"></Header>
  <main>
    <div class="mx-auto py-6 px-4 sm:px-6">
      <q-table
        :loading="loading"
        :rows="tableData"
        :columns="columns"
        :filter="tableFiler"
        :pagination="initialPagination"
        row-key="id"
      >
        <template v-slot:loading>
          <q-inner-loading showing color="primary" />
        </template>
        <template v-slot:top-left>
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
        <template v-slot:top-right>
          <q-btn
            color="primary"
            icon-right="archive"
            label="Export to csv"
            no-caps
            @click="exportTable"
          />
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
import { exportFile, useQuasar } from "quasar";
import Header from "../../components/Layouts/Header.vue";
import DonationService from "../../service/DonationService.js";

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
      loading: false,
      initialPagination: {
        sortBy: "desc",
        descending: false,
        // rowsNumber: xx if getting data from a server
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
    this.onRequest();
  },
  methods: {
    onRequest(props) {
      this.loading = true;
      this.fetchFromServer();
    },
    fetchFromServer() {
      DonationService.showMonthly()
        .then((response) => {
          this.tableData = response.result;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    wrapCsvValue(val, formatFn, row) {
      let formatted = formatFn !== void 0 ? formatFn(val, row) : val;

      formatted =
        formatted === void 0 || formatted === null ? "" : String(formatted);

      formatted = formatted.split('"').join('""');
      /**
       * Excel accepts \n and \r in strings, but some other CSV parsers do not
       * Uncomment the next two lines to escape new lines
       */
      // .split('\n').join('\\n')
      // .split('\r').join('\\r')

      return `"${formatted}"`;
    },

    exportTable() {
      // naive encoding to csv format
      const content = [this.columns.map((col) => this.wrapCsvValue(col.label))]
        .concat(
          this.tableData.map((row) =>
            this.columns
              .map((col) =>
                this.wrapCsvValue(
                  typeof col.field === "function"
                    ? col.field(row)
                    : row[col.field === void 0 ? col.name : col.field],
                  col.format,
                  row
                )
              )
              .join(",")
          )
        )
        .join("\r\n");

      const status = exportFile("table-export.csv", content, "text/csv");

      if (status !== true) {
        $q.notify({
          message: "Browser denied file download...",
          color: "negative",
          icon: "warning",
        });
      }
    },
  },
};
</script>
