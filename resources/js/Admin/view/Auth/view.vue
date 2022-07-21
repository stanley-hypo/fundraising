<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="mx-auto py-6 px-4 sm:px-6">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">職員資料</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="even:bg-white odd:bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">名稱</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> {{user?.name??""}}</dd>
                        </div>
                        <div class="even:bg-white odd:bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">電郵</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> {{user?.email??""}}</dd>
                        </div>
                        <div class="even:bg-white odd:bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">職級</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> {{user?.currentrole?.name??""}}</dd>
                        </div>

                    </dl>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Header from "../../components/Layouts/Header.vue";
import AdminAuthService from "../../service/AdminAuthService";

export default {
    components:{
        Header,
    },
    data() {
        return {
            myHeader: {
                title: '檢視職員',
                navBar: [
                    {
                        title: "職員列表",
                        url: "/admin/user",
                    },
                    {
                        title: "檢視職員"
                    }
                ],
            },
            user: null,
        }
    },
    async created() {
        const response = await AdminAuthService.getuser({
            id:this.$route.params.id,
        });
        if(response?.success){
            this.user = response.result;

            this.myHeader.routerLink = [
                {
                    color: 'warning',
                    icon: "edit",
                    text: "修改",
                    to: "/admin/user_edit/"+this.user?.id
                },
            ]

            if(this.$store.getters['auth/isAdmin']){
                this.myHeader.routerLink.push({
                    color: 'info',
                    icon: "password",
                    text: "更新密碼",
                    to: "/admin/user/updatepwd/"+this.user?.id
                })
            }


        }else{
            await this.$router.push('/admin/user');
        }
    },
    mounted() {
    },
    methods:{
    },
}
</script>
