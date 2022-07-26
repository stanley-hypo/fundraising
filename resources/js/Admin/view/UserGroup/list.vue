<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="mx-auto py-6 px-4 sm:px-6">
            <q-table
                :rows="tableData"
                :columns="columns"
                row-key="id"
            >
                <template v-slot:body-cell-id="props">
                    <q-td :props="props">
                        <div class="q-gutter-sm">
                            <q-btn :to="'/admin/usergroup/edit/'+props.row.value" padding="5px 5px" color="info" icon="edit" />
                        </div>
                    </q-td>
                </template>
            </q-table>
        </div>
    </main>
</template>

<script>
import Header from "../../components/Layouts/Header.vue";
import AdminAuthService from "../../service/AdminAuthService";

export default {
    components: {
        Header,
    },
    data() {
        return {
            myHeader: {
                title: 'Role List',
                navBar: [
                    {
                        title: "Home",
                        url: "/admin"
                    },
                    {
                        title: "Role List",
                    }
                ],
            },
            tableData: [],
            columns: [
                {
                    name: 'id',
                    label: '',
                    align: 'left',
                    field: 'id',
                    sortable: false,
                },
                { name: 'label', align: 'center', label: 'Name', field: 'label', sortable: true },
            ],
        }
    },
    mounted() {
        AdminAuthService.roleList().then((response)=>{
            // console.log(response)
            this.tableData = response.result.roles
        })
    },
    methods: {

    }
}
</script>
