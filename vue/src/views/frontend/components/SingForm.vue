<template>
  <section
    class="bg-gray-50 relative dark:bg-gray-900 bl bg-[url('../image/header/112.png')] bg-no-repeat bg-cover bg-center"
  >
    <div style="opacity: 10%" class="bg-black h-full w-full absolute"></div>
    <div class="bg-white/30 p-6" style="backdrop-filter: blur(1px)">
      <div
        class="flex flex-col items-center z-40 justify-center col-span-8 w-full mx-auto lg:py-0"
      >
        <div class="mb-4 text-center">
          <h1 class="text-4xl py-2 font-bold">{{ $t("sign_in") }}</h1>
          <p class="text-2xl">
            {{
              $t(
                "You_can_now_create_your_own_account_with_us_to_follow_up_your_requests_directly"
              )
            }}
          </p>
        </div>
        <div v-show="parentStore.showErrors" class="my-4">
          <p
            v-show="!parentStore.errors"
            class="bg-red-200 text-red-700 px-3 py-2 rounded-lg"
          >
            {{ parentStore.errorMessage }}
          </p>
        </div>
        <div
          style="
            backdrop-filter: blur(10px);
            background-color: rgb(247, 243, 243);
            opacity: 95%;
            margin-top: 5%;
            margin-bottom: 2%;
          "
          class="shadow-md animate__animated animate__bounceInRight rounded-3xl z-30 dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700"
        >
          <div class="w-full md:space-y-6 p-8">
            <form
              class="w-full space-y-6 text-center rounded-2xl bg-none"
              @submit.prevent="parentStore.register(parent)"
            >
              <div class="grid grid-cols-2 gap-5">
                <div class="flex flex-col">
                  <input
                    v-model="parent.fname"
                    style="border-bottom: 2px solid black"
                    type="text"
                    id="child_name"
                    :placeholder="$t('first_name')"
                    class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                  />
                  <p
                    v-if="parentStore.errors && parentStore.errors['fname']"
                    class="text-red-500 text-sm"
                  >
                    {{ parentStore.errors["fname"][0] }}
                  </p>
                </div>
                <div class="flex flex-col">
                  <input
                    v-model="parent.lname"
                    style="border-bottom: 2px solid black"
                    type="text"
                    id="child_name"
                    :placeholder="$t('family_name')"
                    class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                  />
                  <p
                    v-if="parentStore.errors && parentStore.errors['lname']"
                    class="text-red-500 text-sm"
                  >
                    {{ parentStore.errors["lname"][0] }}
                  </p>
                </div>
              </div>
              <div class="flex flex-col">
                <input
                  v-model="parent.phone"
                  style="border-bottom: 2px solid black"
                  type="tel"
                  id="child_name"
                  :placeholder="$t('Mobile_number')"
                  class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                />
                <p
                  v-if="parentStore.errors && parentStore.errors['phone']"
                  class="text-red-500 text-sm"
                >
                  {{ parentStore.errors["phone"][0] }}
                </p>
              </div>
              <div class="flex flex-col">
                <input
                  v-model="parent.email"
                  style="border-bottom: 2px solid black"
                  type="email"
                  id="child_name"
                  :placeholder="$t('email')"
                  class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                />
                <p
                  v-if="parentStore.errors && parentStore.errors['email']"
                  class="text-red-500 text-sm"
                >
                  {{ parentStore.errors["email"][0] }}
                </p>
              </div>
              <div class="flex flex-col">
                <input
                  v-model="parent.password"
                  style="border-bottom: 2px solid black"
                  type="password"
                  id="child_name"
                  :placeholder="$t('password')"
                  class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                />
                <p
                  v-if="parentStore.errors && parentStore.errors['password']"
                  class="text-red-500 text-sm"
                >
                  {{ parentStore.errors["password"][0] }}
                </p>
              </div>
              <div class="flex flex-col">
                <input
                  style="border-bottom: 2px solid black"
                  v-model="parent.password_confirmation"
                  type="password"
                  id="child_name"
                  :placeholder="$t('password_confirmation')"
                  class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                />
              </div>
              <div>
                <button
                  type="submit"
                  class="mb-5 rounded-xl w-full p-2 text-xl text-white bg-[#23D1E6]"
                >
                  {{ $t("Create_an_account") }}
                </button>
                <!-- </router-link> -->
              </div>
              <p>
                {{ $t("If_you_have_an_account") }}
                <router-link
                  :to="{ name: 'parentLogin' }"
                  class="px-2 text-lg text-[#649297]"
                  >{{ $t("sign_in") }}
                </router-link>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import { useParentStore } from "../../../stores/ParentStore";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import InlineMessage from "primevue/inlinemessage";

export default {
  components: { Button, InputText, InlineMessage },
  data() {
    return {
      alert: {},
      alert_text: null,
      alert: {},
      parentStore: useParentStore(),
      parent: {
        fname: null,
        lname: null,
        phone: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
    };
  },
};
</script>
