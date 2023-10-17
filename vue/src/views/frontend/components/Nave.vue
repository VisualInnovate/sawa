<template>
  <nav class="bg-white p-2">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Your logo or brand content goes here -->

      <!-- Your navigation links go here -->
      <div class="hidden md:flex md:items-center space-x-4">
        <div class="flex space-x-2" v-if="parentStore.parentAuth">
          <div>
            <div class="relative">
              <button
                @click="show = !show"
                class="flex items-center p-2 text-indigo-100 bg-[] rounded-md"
              >
              <img src="../image/Ellipse2.png" v-if="parentStore.parent.image == null">
                <img
                  class="rounded-full w-[60px] h-[60px] object-cover"
                  v-if="parentStore.parent.image != null"
                  :src="
                    parentStore.parent.image 
                  "
                />
                <svg
                  onclick="rate()"
                  class="w-8 h-8"
                  viewBox="0 0 24 24"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g
                    id="SVGRepo_tracerCarrier"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  ></g>
                  <g id="SVGRepo_iconCarrier">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z"
                      fill="#000000"
                    ></path>
                  </g>
                </svg>
              </button>

              <div
                v-show="show"
                class="absolute right-0 py-2 mt-2 bg-[#0D4047] rounded-md shadow-xl w-52 z-10 animate__animated animate__backInDown p-2"
              >
                <router-link
                  :to="{ name: 'Profile' }"
                  class="block px-4 py-2 text-sm text-indigo-100 hover:bg-indigo-400 hover:text-indigo-100 border-b-2"
                >
                  <div class="flex justify-between">
                    <p class="text-lg">{{ $t("Profile_personly") }}</p>
                    <svg
                      class="w-6 h-6 text-[yellow]"
                      fill="yellow"
                      viewBox="0 0 32 32"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      stroke="yellow"
                    >
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      ></g>
                      <g id="SVGRepo_iconCarrier">
                        <title>user</title>
                        <path
                          d="M4 28q0 0.832 0.576 1.44t1.44 0.576h20q0.8 0 1.408-0.576t0.576-1.44q0-1.44-0.672-2.912t-1.76-2.624-2.496-2.144-2.88-1.504q1.76-1.088 2.784-2.912t1.024-3.904v-1.984q0-3.328-2.336-5.664t-5.664-2.336-5.664 2.336-2.336 5.664v1.984q0 2.112 1.024 3.904t2.784 2.912q-1.504 0.544-2.88 1.504t-2.496 2.144-1.76 2.624-0.672 2.912z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                </router-link>
                <div
                  class="block px-4 py-2 text-sm text-indigo-100 hover:bg-indigo-400 hover:text-indigo-100 cursor-pointer"
                >
                  <div class="flex justify-between" @click="parentStore.logout">
                    <p class="text-xl">{{ $t("sign_out") }}</p>
                    <svg
                      fill="#FF2A5B"
                      class="w-6 h-6"
                      viewBox="0 0 512 512"
                      xmlns="http://www.w3.org/2000/svg"
                      stroke="#FF2A5B"
                    >
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g
                        id="SVGRepo_tracerCarrier"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      ></g>
                      <g id="SVGRepo_iconCarrier">
                        <title>ionicons-v5-i</title>
                        <path
                          d="M335.69,272h-161V240h161V92a12,12,0,0,0-12-12h-280a12,12,0,0,0-12,12V420a12,12,0,0,0,12,12h280a12,12,0,0,0,12-12Z"
                        ></path>
                        <polygon
                          points="419.06 272 355.06 336 377.69 358.63 480.31 256 377.69 153.37 355.06 176 419.06 240 335.69 240 335.69 272 419.06 272"
                        ></polygon>
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <locale-select id="local-switcher"></locale-select>
        <li
          style="font-size: 130%"
          class="block font-bold mr-6 m-auto cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
        >
          <router-link :to="{ name: 'home' }"> {{ $t("home") }}</router-link>
        </li>
        <li
          style="font-size: 130%"
          class="block font-bold mr-6 m-auto cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
        >
          <router-link :to="{ name: 'about' }">{{
            $t("about_us")
          }}</router-link>
        </li>
        <li
          style="font-size: 130%"
          class="block font-bold mr-6 m-auto cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
        >
          <router-link :to="{ name: 'contactus' }">
            {{ $t("connect_us") }}</router-link
          >
        </li>
        <li
          style="font-size: 130%"
          class="block font-bold mr-6 m-auto cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
        >
          <router-link :to="{ name: 'home' }">
            {{ $t("special_education") }}</router-link
          >
        </li>

        <li
          style="font-size: 130%"
          class="block font-bold text-2xl mr-6 m-auto cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
        ></li>
      </div>

      <!-- Mobile menu toggle button -->
      <div class="md:hidden flex items-center">
        <button @click="toggleMenu" class="text-black focus:outline-none">
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
      <div class="flex space-x-4">
        <div>
          <router-link to="/web"
            ><img class="cursor-pointer" src="../image/header/Group22.png"
          /></router-link>
        </div>
      </div>
    </div>
    <!-- Mobile menu -->
    <div v-if="isMobileMenuOpen" class="md:hidden fix bg-[#ffffff] p-4">
      <li
        class="block text-2xl font-bold text-center cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
      >
        <router-link to="/"> الرئيسيه </router-link>
      </li>
      <li
        class="block text-2xl font-bold cursor-pointer text-center md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
      >
        <router-link :to="{ name: 'about' }"> ماذا عنا</router-link>
      </li>
      <li
        class="block text-2xl font-bold cursor-pointer text-center md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
      >
        <router-link to="/more"> تواصل معنا</router-link>
      </li>
      <li
        class="block text-2xl font-bold text-center cursor-pointer md-:p-0 text-[#125B64] hover:border-b-2 border-[#FF5C82]"
      >
        <router-link to="/ReAction">التربيه الخاصه</router-link>
      </li>
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
      show: false,
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
