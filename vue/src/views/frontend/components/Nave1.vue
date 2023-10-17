
<template>
  <nav class="bg-[#135C65] p-4">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Your logo or brand content goes here -->
      <div class="flex mx-2">
        <div>
          <p style="font-size: 100%" class="text-white text-base">
            <v-icon
              end
              icon="mdi-map-marker"
              class="text-[#FFCF24] h-full"
            ></v-icon>
            {{ $t("Amman_Rabieh_Maysaloon_Street") }}
          </p>
        </div>
        <div class="mx-2">
          <p style="font-size: 100%" class="text-white text-base">
            <v-icon
              end
              icon="mdi-phone"
              class="text-[#FFCF24] h-full rotate-180"
            ></v-icon>
            {{ $t("contact") }}
          </p>
        </div>
      </div>

      <!-- Your navigation links go here -->
      <div class="hidden lg:block space-x-4" v-if="!parentStore.parentAuth">
        <div class="flex flex-col md:flex-row m-auto ">
          
          
          <div>
            <v-btn
              :to="{ name: 'parentLogin' }"
              class="bg-[#FFCF24] text-white text-base"
            >
            {{ $t("sign_in") }}
            </v-btn>
          </div>
          <div class="mx-2">
            <div class="bg-none shadow-0 text-[#FFCF24] text-base">
              <v-btn :to="{ name: 'SingUp' }" class="text-base">
                {{ $t("Create_an_account") }}
              </v-btn>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile menu toggle button -->
      <div class="lg:hidden flex items-center">
        <button @click="toggleMenu" class="text-white focus:outline-none">
          <svg
            class="h-6 w-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"
            ></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile menu -->
    <div v-if="isMobileMenuOpen" class="lg:hidden fix bg-[#135C65] p-4">
      <div
        class="flex flex-col w-full lg:flex-row m-auto space-y-4"
        v-if="!parentStore.parentAuth"
      >
        <div
          class="m-auto bg-[#0D4047] w-full rounded-lg"
          style="display: flex; align-items: center"
        >
          <v-icon
            end
            @click="show"
            :icon="show_Password"
            class="text-2xl text-white w-[20%] bg-[#0D4047] h-full"
          ></v-icon>
          <input
            class="text-center focus:ring-0 text-white rounded-lg w-full bg-[#0D4047]"
            :type="pass_type"
            placeholder="كلمه المرور"
          />
        </div>
        <div
          class="m-auto bg-[#0D4047] w-full rounded-lg"
          style="display: flex; align-items: center"
        >
          <v-icon
            end
            icon="mdi-account"
            class="text-2xl text-white px-2 w-[20%] bg-[#0D4047] h-full"
          ></v-icon>
          <input
            class="focus:ring-0 text-center text-white rounded-lg w-full bg-[#0D4047]"
            type="text"
            placeholder="اسم المستخدم"
          />
        </div>
        <div class="">
          <v-btn
            to="/register"
            class="bg-[#FFCF24] m-auto w-full text-white text-base"
          >
            تسجيل الدخول
          </v-btn>
        </div>
        <div>
          <v-btn class="bg-none w-full shadow-0 text-[#FFCF24] text-base">
            انشاء حساب
          </v-btn>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { useParentStore } from "../../../stores/ParentStore";
import LocaleSelect from "../../../components/LocaleSelect.vue";

export default {
  data() {
    return {
      isMobileMenuOpen: false,
      show_Password: "mdi-eye-off",
      pass_type: "password",
      parentStore: useParentStore(),
    };
  },
  methods: {
    toggleMenu() {
      this.isMobileMenuOpen = !this.isMobileMenuOpen;
    },
  },
  components: {
    LocaleSelect,
  },
};
</script>

<style>
/* No custom styling required since we're using Tailwind CSS classes */
</style>
