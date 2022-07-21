<template>
    <div class="relative flex flex-col justify-center min-h-screen overflow-hidden px-4 sm:px-6 lg:px-8" v-if="!$store.getters['auth/isLogin']">
        <div class="w-full p-6 m-auto bg-white border-t border-blue-600 rounded shadow-lg shadow-blue-800/50 lg:max-w-md">
            <h1 class="text-3xl font-semibold text-center text-blue-700">Company Name <br />XXXXXX</h1>
            <q-form @submit="login" class="mt-6" >
                <div>
                    <q-input
                        label="用戶名稱"
                        v-model="loginuser.email"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || '請輸入用戶名稱']"
                    />

                </div>
                <div class="mt-4">
                    <div>
                        <q-input
                            type="password"
                            label="密碼"
                            v-model="loginuser.password"
                            lazy-rules
                            :rules="[ val => val && val.length > 6 || '請輸入用戶密碼']"
                        />
                    </div>
                    <a href="#" class="text-xs text-gray-600 hover:underline">Forget Password?</a>
                    <div class="mt-6">
                        <q-btn label="登入" type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"/>
                    </div>
                </div>
            </q-form>
        </div>
    </div>

</template>

<script>
import AdminAuthService from "../../service/AdminAuthService";

export default {
    props:[],
    name: 'Login',
    data() {
        return {
            loginuser: {
                email: '',
                password: '',
            }
        };
    },
    created() {
        if(this.$store.getters['auth/isLogin']){
            //stanley must use this
            window.location.href = this.$route.query.redirect??'/admin';
        }
        // console.log(import.meta.env.VITE_APP_URL)
        // console.log(this.$store.getters['auth/isLogin'])

        // this.$store.state.user.token = "HIHI"
        // console.log(this.$store.state.user)
    },
    components: {

    },
    methods:{
        async login() {
            try {
                const credentials = this.loginuser;
                const response = await AdminAuthService.login(credentials);
                await this.$store.commit(
                    'auth/updateAdminUser',
                    response.user
                )
                await this.$store.commit(
                    'auth/updateAdminToken',
                    response.access_token
                )
                //stanley must use this
                window.location.href = this.$route.query.redirect??'/admin';
            } catch (error) {
                console.log(error.response.data.msg);
            }
        },
    }
}
</script>
