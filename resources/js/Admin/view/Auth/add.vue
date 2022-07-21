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

                                <q-input
                                    v-model.trim="user.password"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="密碼"
                                    type="password"
                                    :rules="[
                                        val => val.length > 5 || '必填項目',

                                        ]"
                                >
                                </q-input>

                                <q-input
                                    v-model.trim="user.password_confirm"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="確定密碼"
                                    type="password"
                                    :rules="[
                                        val => val.length > 5 || '必填項目',
                                        val => user.password_confirm === user.password || '必須與密碼相同',
                                        ]"
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
                title: '新增職員',
                navBar: [
                    {
                        title: "職員列表",
                        url: "/admin/user",
                    },
                    {
                        title: "新增職員"
                    }
                ],
            },
            user: {
                name: '',
                email: '',
                password:'',
                password_confirm:'',

                role: '',
                permissions: [],

                active: 1,
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



    },
    methods:{


        onSubmit() {


            const role = [
                this.user.role.value
            ]
            AdminAuthService.register({
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                password_confirm: this.user.password_confirm,
                role: this.user.role,
                active: this.user.active,

            }).then((response)=>{
                if(response.success){
                    NotifyService.commitNotify( { color: 'positive', message: response.message??'Updated', icon: 'check', position: '' });
                    this.$router.replace('/admin/user')
                }else{
                    NotifyService.commitNotify( { color: 'negative', message: response.message??'Error', icon: 'dangerous', position: '' });
                }
            });
        }
    },
}
</script>
