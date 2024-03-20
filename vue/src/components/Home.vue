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
        <v-btn id="theme-switcher" :prepend-icon="theme.global.name.value === 'light'
            ? 'mdi-weather-sunny'
            : 'mdi-weather-night'
          " @click="toggleTheme">
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
          <v-list-group prepend-icon="mdi-shield-account" value="Admin">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('Adminstration')"></v-list-item>
            </template>

            <!--            here  your v- item list -->
            <v-list-item  :title="$t('users')" value="users"
              :to="{ name: 'Users' }"></v-list-item>
            <!-- <v-list-item
              prepend-icon="mdi-security"
              :title="$t('permissions')"
              value="permissions"
              :to="{ name: 'Permissions' }"
            ></v-list-item> -->
            
            <v-list-item  :title="$t('permissions')" value="permissions"
              :to="{ name: 'permissions' }"></v-list-item>

            <!-- <v-list-item  :title="$t('permissions')" value="roles"
              :to="{ name: 'permissions' }"></v-list-item> -->
            <v-list-item  :title="$t('roles')" value="roles"
              :to="{ name: 'Roles' }"></v-list-item>
            <v-list-item  :title="$t('manage_user_roles')" value="roles-users"
              :to="{ name: 'RolesUsers' }"></v-list-item>
          </v-list-group>

          <v-list-group prepend-icon="mdi-human-male-boy" value="Children">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('parents')"></v-list-item>
            </template>

            <v-list-item  :title="$t('parents')" value="parents"
              :to="{ name: 'Parents' }"></v-list-item>

            <v-list-item  :title="$t('children')" value="children"
              :to="{ name: 'Children' }"></v-list-item>
          </v-list-group>

          <v-list-group prepend-icon="mdi-help-box-multiple-outline" value="Evaluation">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('evaluations')"></v-list-item>
            </template>

            <v-list-item  :title="$t('headers')" value="Categories"
              :to="{ name: 'Headers' }"></v-list-item>
            <v-list-item  :title="$t('side_profile')" value="SideProfiles"
              :to="{ name: 'SideProfiles' }"></v-list-item>
          </v-list-group>
          <!-- edit Last -->
          <v-list-group prepend-icon="mdi-doctor">
            <template #activator="{ props }" value="Evaluation">
              <v-list-item v-bind="props">
                <v-list-item-title class="mb-2">
                  {{ $t("Therapeutic") }}
                </v-list-item-title>
              </v-list-item>
            </template>
           
            <v-list-item  :title="$t('addTherapeutic')" value="Categories"
              :to="{ name: 'AllTherapeutic' }"></v-list-item>

             
            
          </v-list-group>
          
          <v-list-group prepend-icon="mdi-bed">
            <template #activator="{ props }" value="Evaluation">
              <v-list-item v-bind="props" :title="$t('room')"></v-list-item>
            </template>
            
            <v-list-item :title="$t('room')" value="SideProfiles" :to="{ name: 'Rooms' }"></v-list-item>
           
              
          </v-list-group>

          <v-list-group prepend-icon=" mdi-calendar" value="Calender">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('consulting')"></v-list-item>
            </template>
            <v-list-item  :title="$t('calender')" value="calender"
              :to="{ name: 'Calender' }"></v-list-item>
            <v-list-item  :title="$t('bookings')" value="bookings"
              :to="{ name: 'ShowBooking' }"></v-list-item>
          </v-list-group>
          <v-list-group prepend-icon="mdi-wrench"  value="Settings">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('Settings')"></v-list-item>
            </template>
            <v-list-item :title="$t('Pages')" value="Pages"
              :to="{ name: 'pages' }"></v-list-item>
            <v-list-item  :title="$t('Settings')" value="Settings"
              :to="{ name: 'settings' }"></v-list-item>
          </v-list-group>

         <!-- student_programe -->
          <!-- <v-list-group value="student_programe">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('student_programe')"></v-list-item>
            </template>
            <v-list-item prepend-icon="mdi-message-question-outline" :title="$t('Pages')" value="Pages"
              :to="{ name: 'pages' }"></v-list-item>
            <v-list-item prepend-icon="mdi-message-question-outline" :title="$t('Settings')" value="Settings"
              :to="{ name: 'settings' }"></v-list-item>
          </v-list-group> -->




          <!-- edits -->
          <v-list-group prepend-icon="mdi-apps" value="">
            <template #activator="{ props }">
              <v-list-item v-bind="props" :title="$t('inputs')"></v-list-item>
            </template>
            <v-list-item  :title="$t('skills')" value="skills"
              :to="{ name: 'skills' }"></v-list-item>


               
            <v-list-item  value="Pages" :to="{ name: 'ProgramType' }"
              class="mb-2 py-2"><v-list-item-title class="mb-2" style="padding: 10px">
                {{ $t("ProgramType") }}
              </v-list-item-title>
            </v-list-item>

            <v-list-item :to="{ name: 'SystemProgram' }" class="">
              <v-list-item-title class="mb-2" style="padding: 10px">
                {{ $t("SystemProgram") }}
              </v-list-item-title>
            </v-list-item>

            <v-list-item  value="Settings" :to="{ name: 'SessionType' }" class="">
              <v-list-item-title class="mb-2" style="padding: 10px">
                {{ $t("SessionType") }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item  value="Settings" :to="{ name: 'TypeTreatment' }" class="">
              <v-list-item-title class="mb-2" style="padding: 10px">
                {{ $t("Typetreatment") }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item  value="Settings" :to="{ name: 'AppointmentType' }"
              class="mb-2">
              <v-list-item-title class="mb-2" style="padding: 10px">
                {{ $t("AppointmentType") }}
              </v-list-item-title>
            </v-list-item>
            
          </v-list-group>
          
        </v-list>

            <v-list-group style="text-align: center !important; width: 100% !important;" value="Settings">
              <template #activator="{ props }">
                <div class="flex justify-between w-full px-4">
                  <a  href="https://attendance.new.sawa.academy/" target=”_blank” >{{ $t('fingerPrint') }}</a>
                  <p><svg fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 210 256" enable-background="new 0 0 210 256" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M174.55,144.5L174.55,144.5c-1.4-4-5-6.5-9.2-6.5H159V23c0-11.708-9.292-21-21-21H25C12.57,2,2,12.57,2,25v183 c0,11.9,10.95,22,22.75,22l114.213,0c1.207,0,2.27,0.984,2.18,2.188c-0.095,1.266-1.153,1.812-2.393,1.812h-45.5L128,254h80 L174.55,144.5z M82.05,220.2c-3.199,0-5.599-2.399-5.6-5.598c-0.001-3.045,2.557-5.602,5.602-5.602 c3.199,0.001,5.598,2.401,5.598,5.6C87.55,217.8,85.25,220.2,82.05,220.2z M144,138h-19.65c-5.3,0-9.8,4.7-9.8,10l0,0 c0,5.3,4.5,10,9.8,10h19.8v42H18V31h126V138z M122.309,87.625v31.221c0,4.652-4.445,9.097-9.097,9.097H85.92 c-5.686,0-10.286-0.724-15.61-2.584c-1.654-0.569-6.513-2.584-6.513-2.584v-36.39l21.451-25.225l1.964-11.217h3.877 c4.342,0,7.34,3.463,7.34,7.753v2.429c0,5.531-0.31,11.113-0.982,16.592l-0.207,1.809h15.972 C117.864,78.527,122.309,82.972,122.309,87.625z M39.089,126.65h19.487V82.456H39.089V126.65z"></path> </g></svg></p>
                </div>
              </template>
            </v-list-group>
        
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
