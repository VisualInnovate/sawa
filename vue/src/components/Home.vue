<script setup>
import LocaleSelect from "./LocaleSelect.vue";
import { useAppLangStore } from "../stores/AppLangStore";
import { ref, watch, computed, onMounted } from "vue";
import { useAuthStore } from "../stores/Auth";
import UserProfileMenu from "./UserProfileMenu.vue";
import { useTheme } from "vuetify";
import sawaLogo from "../assets/img/sawa_logo.svg";

const theme = useTheme();
const drawer = ref(true);
const group = ref(null);
const authStore = useAuthStore();
const appLangStore = useAppLangStore();

// methods
// const onClick = () => {
//     theme.value = theme.value === "light" ? "dark" : "light";
// };
const toggleTheme = () =>
  (theme.global.name.value = theme.global.current.value.dark
    ? "light"
    : "dark");
const isRtl = computed({
  get() {
    return appLangStore.isRtl;
  },
  set(val) {
    appLangStore.isRtl = val;
  },
});
watch(group, (newGroupValue) => {
  drawer.value = false;
});
onMounted(async () => {
  await authStore.getUser();
});
</script>
<style lang="scss">
//@use '../settings.scss';
#local-switcher {
  width: 30px;
  height: 60px;
  border-radius: 50%;
  background-color: #a9ab7f;
  color: #ffffff;
  display: flex;
  margin: 0 15px;
  justify-content: center;

  i {
    margin: 0 !important;
  }
}

#theme-switcher {
  width: 50px;
  height: 61px;
  border-radius: 50%;
  background-color: #135c65;
  color: #ffffff;
  display: flex;
  justify-content: center;

  .v-btn__prepend {
    margin: 0;
  }
}
.setting {
  width: 50px;
  height: 61px;
  border-radius: 50%;
  background-color: #135c65;
  color: #ffffff;
  display: flex;
  justify-content: center;
}

#navbar {
  padding-top: 46px;
  background-color: #135c65 !important;
  color: #ffffff !important;
  height: calc(100% - 119.81px) !important;
  //width: 19% !important;
}

.v-list-group__items .v-list-item {
  padding-right: 20px !important;
  padding-left: 20px !important;
}

.v-list-item {
  margin: 0 0 19px 0 !important;

  .v-list-item-title {
    font-size: 17px !important;
    line-height: 110% !important;
  }

  .v-list-item__prepend {
    text-align: center !important;
    justify-content: center;
  }
}

#footer {
  width: 100% !important;
  left: 0 !important;
  background: url("../assets/img/Mask Group 1.png"), #a9ab7f;
  color: #ffffff;
  height: 55px;
}
</style>
<template>
  <v-locale-provider :rtl="isRtl">
    <v-app>
      <!-- v-system-bar -->

      <!-- v-app-bar -->
      <v-app-bar prominent>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

        <v-toolbar-title class="">
          <v-img class="" max-width="100" :src="sawaLogo"></v-img>
        </v-toolbar-title>

        <v-spacer></v-spacer>
        <!-- locale switcher -->
        <LocaleSelect id="local-switcher" />

        <!-- theme switcher -->
        <v-btn
          id="theme-switcher"
          :prepend-icon="
            theme.global.name.value === 'light'
              ? 'mdi-weather-sunny'
              : 'mdi-weather-night'
          "
          @click="toggleTheme"
        >
        </v-btn>
        <template class="setting" v-if="authStore.authenticated">
          <UserProfileMenu />
        </template>
        <template class="setting" v-else>
          <v-btn :to="{ name: 'Register' }">Register</v-btn>
          <v-btn :to="{ name: 'Login' }">Login</v-btn>
        </template>
      </v-app-bar>

      <!-- sidebar menu -->
      <v-navigation-drawer id="navbar" v-model="drawer">
        <v-list density="compact" nav>
          <v-list-group value="Admin">
            <template #activator="{ props }">
              <v-list-item
                v-bind="props"
                :title="$t('Adminstration')"
              ></v-list-item>
            </template>

            <!--            here  your v- item list -->
            <v-list-item
              prepend-icon="mdi-account-multiple"
              :title="$t('users')"
              value="users"
              :to="{ name: 'Users' }"
            ></v-list-item>
            <!-- <v-list-item
              prepend-icon="mdi-security"
              :title="$t('permissions')"
              value="permissions"
              :to="{ name: 'Permissions' }"
            ></v-list-item> -->
            <v-list-item
              prepend-icon="mdi-shield-account"
              :title="$t('roles')"
              value="roles"
              :to="{ name: 'Roles' }"
            ></v-list-item>
            <v-list-item
              prepend-icon="mdi-shield-account"
              :title="$t('manage_user_roles')"
              value="roles-users"
              :to="{ name: 'RolesUsers' }"
            ></v-list-item>
          </v-list-group>

          <v-list-group value="Children">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('parents')"></v-list-item>
            </template>

            <v-list-item
              prepend-icon="mdi-human-male-boy"
              :title="$t('parents')"
              value="parents"
              :to="{ name: 'Parents' }"
            ></v-list-item>

            <v-list-item
              prepend-icon="mdi-human-male-boy"
              :title="$t('children')"
              value="children"
              :to="{ name: 'Children' }"
            ></v-list-item>
          </v-list-group>

          <v-list-group value="Evaluation">
            <template #activator="{ props }">
              <v-list-item
                v-bind="props"
                :title="$t('evaluations')"
              ></v-list-item>
            </template>

            <v-list-item
              prepend-icon="mdi-message-question-outline"
              :title="$t('headers')"
              value="Categories"
              :to="{ name: 'Headers' }"
            ></v-list-item>
            <v-list-item
              prepend-icon="mdi-help-box-multiple-outline"
              :title="$t('side_profile')"
              value="SideProfiles"
              :to="{ name: 'SideProfiles' }"
            ></v-list-item>
          </v-list-group>

          <v-list-group value="Calender">
            <template #activator="{ props }">
              <v-list-item
                v-bind="props"
                :title="$t('consulting')"
              ></v-list-item>
            </template>
            <v-list-item
              prepend-icon="mdi-message-question-outline"
              :title="$t('calender')"
              value="calender"
              :to="{ name: 'Calender' }"
            ></v-list-item>
            <v-list-item
              prepend-icon="mdi-message-question-outline"
              :title="$t('bookings')"
              value="bookings"
              :to="{ name: 'ShowBooking' }"
            ></v-list-item>
          </v-list-group>
          <v-list-group value="Settings">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('Settings')"></v-list-item>
            </template>
            <v-list-item
              prepend-icon="mdi-message-question-outline"
              :title="$t('Pages')"
              value="Pages"
              :to="{ name: 'pages' }"
            ></v-list-item>
            <v-list-item
              prepend-icon="mdi-message-question-outline"
              :title="$t('Settings')"
              value="Settings"
              :to="{ name: 'settings' }"
            ></v-list-item>
          </v-list-group>
        </v-list>
      </v-navigation-drawer>

      <!-- this is main content for the application -->
      <v-main>
        <v-container>
          <RouterView />
        </v-container>
      </v-main>
      <!-- footer -->
      <v-footer app id="footer" class="justify-center" border>
        all right reserved for SAWA Academy
      </v-footer>
    </v-app>
  </v-locale-provider>
</template>
