<template>
    <q-header elevated class="text-white" color="primary" height-hint="61.59">
        <q-toolbar class="q-py-sm q-px-md">
            <q-btn flat round dense icon="menu" class="q-mr-sm" color="white" @click="toggleLeftDrawer" />

            <div v-if="$q.screen.gt.sm" class="q-ml-xs q-gutter-md text-body2 text-weight-bold row items-center no-wrap">
                <router-link to="/admin/" class="text-white">
                    首頁
                </router-link>

            </div>

            <q-space />

            <div class="q-pl-sm q-gutter-sm row items-center no-wrap">
                <q-btn dense flat no-wrap>
                    <q-icon
                        name="account_circle"
                    />
                    <q-icon name="arrow_drop_down" size="16px" />

                    <q-menu  auto-close>
                        <q-list  style="min-width: 250px">
                            <q-item>
                                <q-item-section>
                                    <div>Signed in as <strong>{{$store.state.auth?.user?.name}}</strong></div>
                                </q-item-section>
                            </q-item>
                            <q-separator />
                            <q-item clickable>
                                <q-item-section>Settings</q-item-section>
                            </q-item>
                            <q-item @click="logout" clickable>
                                <q-item-section>Sign out</q-item-section>
                            </q-item>
                        </q-list>
                    </q-menu>
                </q-btn>
            </div>
        </q-toolbar>
    </q-header>

    <q-drawer
        :mini="miniState"
        @mouseover="miniState = false"
        @mouseout="miniState = true"
        v-model="leftDrawerOpen"
        show-if-above
        bordered
        class="bg-grey-2"
        :width="240"
    >
        <q-scroll-area class="fit">

            <q-list padding class="rounded-borders">
                <q-item to="/admin/" clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="dashboard" />
                    </q-item-section>
                    <q-item-section>首頁</q-item-section>
                </q-item>

                <q-expansion-item
                    icon="person"
                    :content-inset-level="0.5"
                    label="捐款">
                    <q-list  padding  separator>
                        <q-item to="/admin/member/index" clickable v-ripple>
                            <q-item-section>每月捐款</q-item-section>
                        </q-item>

                    </q-list>
                </q-expansion-item>

                <q-item to="/admin/user"
                        v-if="can('setting')"
                        clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="manage_accounts" />
                    </q-item-section>
                    <q-item-section>職員</q-item-section>
                </q-item>

                <q-expansion-item
                    v-if="$store.getters['auth/isAdmin']"
                    icon="settings"
                    :content-inset-level="0.5"
                    label="設定">

                    <q-list padding separator>

                        <q-item to="/admin/usergroup" clickable v-ripple v-if="$store.getters['auth/isAdmin']">
                            <q-item-section>權限組別</q-item-section>
                        </q-item>

                    </q-list>
                </q-expansion-item>


            </q-list>


        </q-scroll-area>
    </q-drawer>
</template>

<script>
import AdminAuthService from "../../service/AdminAuthService";

export default {
    data(){
        return{
            miniState: false,
            leftDrawerOpen: false,
        }
    },
    created () {
        this.leftDrawerOpen = false
    },
    methods:{
        toggleLeftDrawer () {
            this.leftDrawerOpen = !this.leftDrawerOpen
        },
        async logout() {
            try {
                const response = await AdminAuthService.logout();
                await this.$store.dispatch('auth/logout');
                await this.$router.replace('/admin/login');
            } catch (error) {
                await this.$store.dispatch('auth/logout');
                await this.$router.replace({ path: '/admin/login' })
            }
        },
    }
}
</script>
