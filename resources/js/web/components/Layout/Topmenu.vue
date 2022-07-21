<template>
    <q-header elevated class="bg-white">
      <q-toolbar class="bg-white">
          <q-toolbar-title>
              <router-link to="/" class="text-white text-bold" style="text-decoration: none;" >
              <q-img  src="../images/logo_Ymca.png"
                     style="width:270px;"
              ></q-img>
              </router-link>
          </q-toolbar-title>
          <div class="gt-sm">
              <q-btn
                  outline
                  label="Donation"
                  class="q-ma-md text-red-400"
                  to="/"
              ></q-btn>
          </div>
          <div class="lt-md">
              <q-btn
                  flat
                  dense
                  round
                  @click="leftDrawerOpen =!leftDrawerOpen"
                  icon="menu"
                  aria-label="Menu"
                  class="text-red-400"
                  ></q-btn>
          </div>
      </q-toolbar>
    </q-header>
    <q-drawer
        v-if="!$q.screen.gt.xs"
        v-model="leftDrawerOpen"
        :width="300"
        :breakpoint="1023"
        overlay
        show-if-above
        bordered
        content-class="bg-grey-3"
    >
        <q-scroll-area class="fit">
            <q-list padding class="rounded-borders text-primary">
                <q-list>
                    <q-item-label header> <router-link to="/" class="text-white text-bold" style="text-decoration: none;" >
                        <q-img  src="images/logo_Ymca.png"
                                style="width:270px;"
                        ></q-img>
                    </router-link></q-item-label>
                    <q-item
                        clickable
                        tag="a"
                        v-ripple
                        href="/aqua">
                        <q-item-section avatar>
                            <q-item-label >所有課程</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item
                        clickable
                        tag="a"
                        v-ripple
                        href="/aqua">
                        <q-item-section avatar>
                            <q-item-label > 課程部門</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item
                        clickable
                        tag="a"
                        v-ripple
                        href="/aqua">
                        <q-item-section avatar>
                            <q-item-label >暫定位置</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item
                        clickable
                        tag="a"
                        v-ripple
                        href="/aqua">
                        <q-item-section avatar>
                            <q-item-label >港青會員</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>
<script>
    export default{
        name: 'MyLayout',
        data(){
            return{
                leftDrawerOpen: false
            }
        }
    }
</script>
