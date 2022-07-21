<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="q-pa-md">
            <q-form method="post" @submit.prevent="onSubmit" autocomplete="off">
                <q-card class="my-card">
                    <q-card-section>
                        <q-card-section>
                            <div class="flex flex-wrap justify-between gap-2">
                                <div class="text-h6">職員資料</div>
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
                                    label="姓名"
                                    :rules="[val => !!val ||  val?.length > 2 || '必填項目',]"
                                >
                                </q-input>
                                <q-input
                                    v-model.trim="user.email"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="電郵"
                                    type="email"
                                    :rules="[val => !!val || '必填項目',]"
                                >
                                </q-input>

                                <q-select
                                    label="職級"
                                    v-model="user.role"
                                    filled outlined
                                    :options="roles"
                                    lazy-rules
                                    :rules="[val => !!val || '必填項目',]"
                                >
                                </q-select>
                                <q-checkbox :true-value="1" :false-value="0" v-model="user.active" label="生效"></q-checkbox>
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
    components:{
        Header,
    },
    data() {
        return {
            myHeader: {
                title: '修改職員',
                navBar: [
                    {
                        title: "職員列表",
                        url: "/admin/user",
                    },
                    {
                        title: "檢視職員",
                        url: "/admin/user_view/"+this.$route.params.id,
                    },
                    {
                        title: "修改職員"
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
    methods:{
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
