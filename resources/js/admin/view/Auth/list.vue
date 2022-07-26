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
                    <q-input borderless dense debounce="300" v-model="tableFiler" placeholder="Search">
                        <template v-slot:append>
                            <q-icon name="search" />
                        </template>
                    </q-input>
                </template>
                <template v-slot:body-cell-id="props">
                    <q-td :props="props">
                        <div class="q-gutter-sm">
                            <q-btn :to="'/admin/user_view/'+props.row.id" padding="5px 5px" color="primary" icon="visibility" />
                            <q-btn :to="'/admin/user_edit/'+props.row.id" padding="5px 5px" color="info" icon="edit" />
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
                title: 'User List',
                navBar: [
                    {
                        title: "User List",
                    }
                ],
                routerLink: [
                    {
                        color: 'primary',
                        icon: "add",
                        text: "Add",
                        to: "/admin/user_add"
                    },
                ]
            },
            tableFiler: '',
            tableData: [],
            columns: [
                {
                    name: 'id',
                    label: '',
                    align: 'left',
                    field: 'id',
                    sortable: false,
                },
                { name: 'name', align: 'center', label: 'Name', field: 'name', sortable: true },
                { name: 'email',  align: 'center',label: 'Email', field: 'email', sortable: true },
            ],
        }
    },
    mounted() {
        this.GetData();
    },
    methods:{
        GetData(){
            axios.post('/adminapi/list_user').then(response => {
                this.tableData = response.data.result;
            });
        }
    }
}
</script>
