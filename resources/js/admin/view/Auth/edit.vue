<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="q-pa-md">
            <q-form method="post" @submit.prevent="onSubmit" autocomplete="off">
                <q-card class="my-card">
                    <q-card-section>
                        <q-card-section>
                            <div class="flex flex-wrap justify-between gap-2">
                                <div class="text-h6">User Information</div>
                                <q-btn label="Submit" type="submit" text-right color="primary" size="md"  />
                            </div>
                        </q-card-section>

                        <q-card-section>
                            <div class="grid grid-cols-2 gap-2">
                                <q-input
                                    v-model.trim="user.name"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="Name"
                                    :rules="[val => !!val ||  val?.length > 2 || 'Field must be filled',]"
                                >
                                </q-input>
                                <q-input
                                    v-model.trim="user.email"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="Email"
                                    type="email"
                                    :rules="[val => !!val || 'Field must be filled',]"
                                >
                                </q-input>

                                <q-select
                                    label="Role"
                                    v-model="user.role"
                                    filled outlined
                                    :options="roles"
                                    lazy-rules
                                    :rules="[val => !!val || 'Field must be filled',]"
                                >
                                </q-select>
                                <q-checkbox size="xl" :true-value="1" :false-value="0" v-model="user.active" label="Active"></q-checkbox>
                            </div>
                        </q-card-section>

                        <q-card-section>
                            <div class="flex flex-wrap justify-end gap-2">
                                <q-btn label="Submit" type="submit" text-right color="primary" size="md"  />
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
import AdminAuthService from "../../service/AdminAuthService";
import {NotifyService} from '../../service/Service'

export default {
    components: {
        Header,
    },
    data() {
        return {
            myHeader: {
                title: 'Edit User',
                navBar: [
                    {
                        title: "User List",
                        url: "/admin/user",
                    },
                    {
                        title: "View User",
                        url: "/admin/user_view/"+this.$route.params.id,
                    },
                    {
                        title: "Edit User"
                    }
                ],
            },
            user: {
                name: '',
                email: '',
                role: '',
                permissions: [],
                active: false,
            },
            roles: [],
            permissions: null,
            permissionsByRole: [],
            defaultPermissions: [],
        }
    },
    watch: {
    },

    created() {
        //get role
        // ********
        // Use .then 不用用 sync / await
        // ********
        AdminAuthService.roleList().then(response=>{
            this.roles = response.result.roles;
            this.permissions = response.result.permissions;
            this.permissionsByRole = response.result.permissionsByRole;
        })
        //get user
        AdminAuthService.getuser({
            id:this.$route.params.id,
        }).then(response=>{
            this.user = response.result
            // ********
            //must check before assign
            // ********
            if(this.user.currentrole){
                this.user.role = {
                    label: this.user.currentrole.name,
                    value: this.user.currentrole.id
                };
            }
        })
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
            AdminAuthService.update({
                id: this.user.id,
                name: this.user.name,
                email: this.user.email,
                role: this.user.role,
                active: this.user.active,

            }).then((response)=>{
                if(response.success){
                    NotifyService.commitNotify( { color: 'positive', message: response.message??'Updated', icon: 'check', position: '' });
                    this.$router.replace('/admin/user')
                }
            });
        }
    },
}
</script>
