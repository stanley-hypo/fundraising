<template>
    <Header :myHeader="myHeader"></Header>
    <main>
        <div class="q-pa-md">
            <q-form method="post" @submit.prevent="onSubmit" autocomplete="off">
                <q-card>
                    <q-card-section>
                        <div class="gap-2 grid grid-cols-1">
                            <q-input
                                v-model.trim="setting.app_name"
                                lazy-rules
                                filled
                                outlined
                                label="Application Name"
                                :rules="[val => !!val ||  val?.length > 2 || 'Field must be filled',]"
                            ></q-input>

                            <div class="flex">

                                <div class="flex-grow">
                                    <q-file accept=".jpg, image/*" :max-total-size="1024*1024" label="App Icon" hint="File Size < 1MB" @rejected="onFileRejected" outlined v-model="setting.icon" >
                                        <template v-slot:prepend>
                                            <q-avatar>
                                                <q-icon name="image" />
                                            </q-avatar>
                                        </template>
                                    </q-file>
                                </div>
                                <div class="w-40 px-2">
                                    <q-img
                                        placeholder-src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWBAMAAADOL2zRAAAAG1BMVEXMzMyWlpaqqqq3t7fFxcW+vr6xsbGjo6OcnJyLKnDGAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABAElEQVRoge3SMW+DMBiE4YsxJqMJtHOTITPeOsLQnaodGImEUMZEkZhRUqn92f0MaTubtfeMh/QGHANEREREREREREREtIJJ0xbH299kp8l8FaGtLdTQ19HjofxZlJ0m1+eBKZcikd9PWtXC5DoDotRO04B9YOvFIXmXLy2jEbiqE6Df7DTleA5socLqvEFVxtJyrpZFWz/pHM2CVte0lS8g2eDe6prOyqPglhzROL+Xye4tmT4WvRcQ2/m81p+/rdguOi8Hc5L/8Qk4vhZzy08DduGt9eVQyP2qoTM1zi0/uf4hvBWf5c77e69Gf798y08L7j0RERERERERERH9P99ZpSVRivB/rgAAAABJRU5ErkJggg=="
                                        :src="previcon"
                                        spinner-color="white"
                                        style="width: 100%; max-height:100px;"
                                    >
                                        <template v-slot:error>
                                            <div class="absolute-full flex flex-center bg-gery text-white">
                                                Cannot load image
                                            </div>
                                        </template>
                                    </q-img>
                                </div>
                            </div>

                            <div class="flex flex-wrap justify-end gap-2">
                                <q-btn label="Submit" type="submit" :loading="submitting" text-right color="primary" size="md" />
                            </div>
                        </div>

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
import {useQuasar} from "quasar";

export default {
    components: {
        Header,
    },
    data() {
        return {
            submitting: false,
            previcon: '',
            setting:{
                'icon': '',
                'app_name': '',
            },
            myHeader: {
                title: '系統設定',
                navBar: [
                    {
                        title: "系統設定",
                    }
                ],
            },
        };
    },
    setup() {
        const Qu = useQuasar()
        return {
            Qu,
            showloading(){
                Qu.loading.show()
            },
            hideloading(){
                Qu.loading.hide()
            }
        }
    },
    mounted() {
        this.getSetting()
    },
    methods: {
        onFileRejected (rejectedEntries) {
            this.Qu.dialog({
                title: 'Warning',
                message: '檔案不正確 / 檔案太大'
            })
        },
        onSubmit(){
            this.submitting = true
            this.showloading()
            let data = new FormData();
            data.append('app_name', this.setting.app_name);
            data.append('icon', this.setting.icon);
            AdminAuthService.updateSetting(data)
                .then(response=>{
                    NotifyService.commitNotify( { color: 'positive', message: response.message??'Success', icon: 'check', position: '' });
                    this.getSetting()
                })
                .finally(()=>{
                    this.hideloading()
                    this.submitting = false
                });

        },
        getSetting(){
            AdminAuthService.getSetting()
                .then(response=>{
                    this.previcon = response.setting.icon
                    this.setting = response.setting
                })
        }
    },
};
</script>
