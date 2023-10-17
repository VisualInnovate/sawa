<template>
  <section
    class="dark:bg-gray-900 bl bg-[url('../image/header/112.png')] bg-no-repeat bg-cover bg-center backdrop-blur-sm bg-white/40"
  >
    <div style="opacity: 10%" class="bg-black h-full w-full absolute"></div>
    <div class="h-full p-6" style="backdrop-filter: blur(2px)">
      <div
        class="flex flex-col items-center justify-between px-6 mx-auto md:col-span-10 lg:py-0"
      >
        <div class="text-center m-2">
          <h1 class="text-4xl py-5 font-bold">{{ $t("sign_in") }}</h1>
          <p class="text-3xl">
            {{
              $t(
                "You_can_now_create_your_own_account_with_us_to_follow_up_your_requests_directly"
              )
            }}
          </p>
        </div>

        <form
          @submit.prevent="parentStore.login(parent)"
          style="
            backdrop-filter: blur(10px);
            background-color: rgb(247, 243, 243);
            opacity: 95%;
            margin-top: 10%;
            margin-bottom: 10%;
          "
          class="space-y-4 rounded-3xl shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700 animate__animated animate__bounceInRight"
        >
          <div class="w-full p-2 md:space-y-4 sm:p-8">
            <div class="space-y-6 text-center rounded-2xl p-4 bg-none">
              <div class="flex flex-col">
                <input
                  style="border-bottom: 2px solid black"
                  v-model="parent.email"
                  type="email"
                  id="child_name"
                  :placeholder="$t('email')"
                  class="min-w-full text-xl bg-white/10 focus:ring-0 text-center"
                />
                <p
                  v-if="parentStore.errors && parentStore.errors['email']"
                  class="text-red-500 text-sm"
                >
                  {{ parentStore.errors["email"] }}
                </p>
              </div>
              <div class="flex flex-col">
                <input
                  style="border-bottom: 2px solid black"
                  v-model="parent.password"
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

              <button
                class="w-[90%] text-xl font-bold p-2 lg:m-0 rounded-3xl bg-[#23D1E6]"
                @click="vaild"
                type="submit"
              >
                {{ $t("sign_in") }}
              </button>
              <p class="text-xl">
                {{ $t("If_you_do_not_have_an_account") }}
                <router-link
                  :to="{ name: 'SingUp' }"
                  class="px-2 text-[#649297]"
                >
                  {{ $t("Create_an_account") }}
                </router-link>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
<script>
import { useParentStore } from "../../../stores/ParentStore";

export default {
  props: ["alert"],
  data() {
    return {
      parentStore: useParentStore(),
      parent: {
        email: "",
        password: "",
      },
    };
  },
};
</script>
