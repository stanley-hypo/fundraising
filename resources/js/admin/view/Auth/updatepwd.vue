<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="q-pa-md">
            <q-form method="post" @submit.prevent="onSubmit" autocomplete="off">
                <q-card class="my-card">
                    <q-card-section>
                        <q-card-section>
                            <div class="flex flex-wrap justify-between gap-2">
                                <div class="text-h6">New Password</div>
                            </div>
                        </q-card-section>

                        <q-card-section>
                            <div class="grid grid-cols-2 gap-2">
                                <q-input
                                    v-model.trim="user.password"
                                    lazy-rules
                                    filled
                                    outlined
                                    label="New Password"
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
                                    label="Confirm New Password"
                                    type="password"
                                    :rules="[
                                        val => val.length > 5 || '必填項目',
                                        val => user.password_confirm === user.password || '必須與密碼相同',
                                        ]"
                                >
                                </q-input>
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
import {NotifyService} from "../../service/Service";

export default {
    components:{
        Header,
    },
    data() {
        return {
            myHeader: {
                title: 'Update Password',
                navBar: [
                    {
                        title: "User View",
                        url: "/admin/user_view/"+this.$route.params.id,
                    },
                    {
                        title: "Update Password"
                    }
                ],
            },
            user: {
                password:'',
                password_confirm:'',
            },
        }
    },
    methods:{
        onSubmit() {

            AdminAuthService.updatepwd({
                id: this.$route.params.id,
                password: this.user.password,
                password_confirm: this.user.password_confirm,

            }).then((response)=>{
                if(response.success){
                    NotifyService.commitNotify( { color: 'positive', message: response.message??'Updated', icon: 'check', position: '' });
                    this.$router.replace('/admin/user_view/'+this.$route.params.id)
                }
            });
        }
    }
}
</script>
