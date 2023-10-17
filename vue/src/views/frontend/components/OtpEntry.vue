<template>
  <section
    class="bg-gray-50 relative dark:bg-gray-900 bl bg-[url('../image/header/112.png')] bg-no-repeat bg-cover bg-center"
  >
    <div style="opacity: 10%" class="bg-black h-full w-full absolute"></div>

    <div
      class="bg-white/30 p-6"
      style="backdrop-filter: blur(1px)"
    >
     
      <div
        class="flex flex-col items-center z-40 justify-center col-span-8 w-full mx-auto lg:py-0"
      >
        <div class="mb-4 text-center">
          <h1 class="text-4xl py-2 font-bold">{{ $t("Create_an_account") }}</h1>
          <p class="text-2xl">
            {{
              $t(
                "You_can_now_create_your_own_account_with_us_to_follow_up_your_requests_directly"
              )
            }}
          </p>
        </div>

        <div
          style="
            backdrop-filter: blur(10px);
            margin-top: 6%;

            margin-bottom: 6%;
            background-color: rgb(247, 243, 243);
            opacity: 95%;
          "
          class="shadow-md relative rounded-3xl lg z-30 dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700 animate__animated animate__bounceInRight"
        >
          <div class="w-full space-y-6 p-8">
            <form
              @submit.prevent="validateOTP"
              style="padding: 2%"
              class="w-full text-center relative rounded-2xl bg-none"
            >
              <div>
                <p style="padding: 2%" class="text-xl font-bold">
                  {{ $t("Enter_the_activation_code") }}
                </p>
              </div>
              <div style="padding: 4%" class="flex m-auto text-xl">
                <p class="m-auto text-[#135C65]">
                  <span class="px-4">{{ parentStore.user.phone }}</span>
                </p>
              </div>
              <div
                style="border-bottom: 1px solid black; padding-bottom: 3%"
                class="flex space-x-3"
              >
                <v-otp-input
                  ref="otpInput"
                  v-model:value="bindModal"
                  input-classes="otp-input"
                  separator="-"
                  :num-inputs="6"
                  :should-auto-focus="true"
                  input-type="letter-numeric"
                  :conditionalClass="[
                    'one',
                    'two',
                    'three',
                    'four',
                    'five',
                    'six',
                  ]"
                  :placeholder="['*', '*', '*', '*', '*', '*']"
                  @on-change="handleOnChange"
                  @on-complete="handleOnComplete"
                />
                <div class="m-auto">
                  <svg
                    @click="clearInput()"
                    class="cursor-pointer"
                    xmlns="http://www.w3.org/2000/svg"
                    width="23.121"
                    height="23.121"
                    viewBox="0 0 23.121 23.121"
                  >
                    <g
                      id="Group_503"
                      data-name="Group 503"
                      transform="translate(-715.439 -442.439)"
                    >
                      <line
                        id="Line_24"
                        data-name="Line 24"
                        x1="21"
                        y2="21"
                        transform="translate(716.5 443.5)"
                        fill="none"
                        stroke="#ff3765"
                        stroke-width="3"
                      />
                      <line
                        id="Line_25"
                        data-name="Line 25"
                        x2="21"
                        y2="21"
                        transform="translate(716.5 443.5)"
                        fill="none"
                        stroke="#ff3765"
                        stroke-width="3"
                      />
                    </g>
                  </svg>
                </div>
              </div>
              <div style="padding-top: 3%; padding-bottom: 3%" @click="sendOTP">
                <a class="underline text-lg cursor-pointer">{{
                  $t("Resend_the_code")
                }}</a>
              </div>
              <button
                style="padding: 3%"
                class="my-[2%] w-full m-auto text-xl rounded-3xl font-bold bg-[#23D1E6]"
              >
                {{ $t("submit") }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup lang="ts">
import axios from "axios";
import { ref } from "vue";
import VOtpInput from "vue3-otp-input";
import { useParentStore } from "../../../stores/ParentStore";
import { useRouter } from "vue-router";

const otpInput = ref<InstanceType<typeof VOtpInput> | null>(null);
const bindModal = ref("");
const parentStore = useParentStore();
const router = useRouter();

const handleOnComplete = (value: string) => {
  console.log("OTP completed: ", value);
};

const handleOnChange = (value: string) => {
  console.log("OTP changed: ", value);
};

const clearInput = () => {
  otpInput.value?.clearInput();
};

const fillInput = (value: string) => {
  console.log(value);
  otpInput.value?.fillInput(value);
};

const sendOTP = () => {
  axios
    .post("/api/parent/send-otp")
    .then((res) => {
      console.log(res);
    })
    .catch((err) => {
      console.log(err);
    });
};

const validateOTP = () => {
  router.push({ name: "home" });

  axios
    .post("/api/parent/validate-otp", {
      otp: otpInput.value?.value,
    })
    .then((res) => {
      console.log(res);
      parentStore.user.phone_verified_at = res.data.phone_verified_at;
      router.push({ name: "home" });
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>
<style>
.otp-input {
  width: 40px;
  height: 40px;
  padding: 5px;
  margin: 0 10px;
  font-size: 20px;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.3);
  text-align: center;
}

/* Background colour of an input field with value */
.otp-input.is-complete {
  background-color: rgb(226, 219, 219);
}

.otp-input::-webkit-inner-spin-button,
.otp-input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input::placeholder {
  font-size: 15px;
  text-align: center;
  font-weight: 600;
}
</style>
