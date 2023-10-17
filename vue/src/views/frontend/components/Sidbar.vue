<template>
  <div
    class="bg-[#135C65] z-10 text-cyan-100 md:w-80 w-72 max-h-full py-[2%] px-2 absolute inset-y-0 left-0 md:relative md:-translate-x-0 transform -translate-x-full transition duration-200 ease-in-out"
    :class="{ 'fixed translate-x-0 ': sole }"
  >
    <div
      v-if="parentStore.parentAuth"
      class="space-y-2 py-4 border-b-2 border-white border-solid"
    >
      <div class="sid">
        <img
          class="rounded-full w-[100px] h-[100px] object-cover m-auto"
          :src="parentStore.parent.image ?? '/src/assets/img/Ellipse2.png'"
        />
      </div>
      <p class="text-white text-center ">
        {{ parentStore.user.fname }} {{ parentStore.user.lname }}
      </p>
      <p class="sid text-center text-white">{{ parentStore.user.email }}</p>
    </div>
    <div class="space-y-4 py-6">
      <div class="sid ">
        <router-link class="flex justify-between p-4" :to="{ name: 'New' }">
          <div class="flex items-end text-">
            <svg
              id="af363570e9b2b9df3a3ac855b6fdaee0"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                id="Path_216"
                data-name="Path 216"
                d="M0,0H24V24H0Z"
                fill="none"
              />
              <path
                id="Path_217"
                data-name="Path 217"
                d="M18,16V11c0-3.07-1.64-5.64-4.5-6.32V4a1.507,1.507,0,0,0-1.51-1.5A1.49,1.49,0,0,0,10.5,4v.68C7.63,5.36,6,7.92,6,11v5L4.7,17.29A1,1,0,0,0,5.4,19H18.57a1,1,0,0,0,.71-1.71Zm-6.01,6a2.006,2.006,0,0,0,2-2h-4A2,2,0,0,0,11.99,22ZM6.77,4.73A.985.985,0,0,0,6.8,3.3a1,1,0,0,0-1.39-.02A10.424,10.424,0,0,0,2.14,9.34a1.011,1.011,0,0,0,1,1.16,1,1,0,0,0,.98-.83A8.44,8.44,0,0,1,6.77,4.73ZM18.6,3.28a1.012,1.012,0,0,0-1.4.02.982.982,0,0,0,.03,1.42,8.5,8.5,0,0,1,2.65,4.94.982.982,0,0,0,.98.83,1,1,0,0,0,.99-1.16A10.488,10.488,0,0,0,18.6,3.28Z"
                fill="#fff"
              />
            </svg>
            <p  class="text-white hover:text-[red] px-2 text-xl m-auto" >
              {{ $t("latest_developments") }}
            </p>
          </div>
          <div class="my-auto">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="15"
              height="15"
              viewBox="0 0 15 15"
            >
              <circle
                id="Ellipse_34"
                data-name="Ellipse 34"
                cx="7.5"
                cy="7.5"
                r="7.5"
                fill="white"
              />
            </svg>
          </div>
        </router-link>
      </div>
      <div  class="sid ">
        <router-link class="flex justify-between p-4" :to="{ name: 'Booking' }">
          <div class="flex space-x-2">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 20 20"
            >
              <path
                id="Path_215"
                data-name="Path 215"
                d="M2,19a2.946,2.946,0,0,0,3,3H19a2.946,2.946,0,0,0,3-3V11H2ZM19,4H17V3a1,1,0,0,0-2,0V4H9V3A.945.945,0,0,0,8,2,.945.945,0,0,0,7,3V4H5A2.946,2.946,0,0,0,2,7V9H22V7A2.946,2.946,0,0,0,19,4Z"
                transform="translate(-2 -2)"
                fill="#fff"
              />
            </svg>
            <p class="text-white px-2 text-xl">{{ $t("bookings") }}</p>
          </div>
          <div class="my-auto">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="15"
              height="15"
              viewBox="0 0 15 15"
            >
              <circle
                id="Ellipse_34"
                data-name="Ellipse 34"
                cx="7.5"
                cy="7.5"
                r="7.5"
                fill="white"
              />
            </svg>
          </div>
        </router-link>
      </div>
      <div  class="sid">
        <router-link
          class="flex justify-between p-4"
          :to="{ name: 'Following' }"
        >
          <div class="flex">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="22.609"
              height="20"
              viewBox="0 0 22.609 20"
            >
              <path
                id="arrow-undo"
                d="M25.118,25.066a.87.87,0,0,1-.686-.334,12.265,12.265,0,0,0-3.985-3.642,13.27,13.27,0,0,0-5.765-1.23V24.2a.87.87,0,0,1-1.467.629L3.648,15.694a.87.87,0,0,1,0-1.258L13.215,5.3a.87.87,0,0,1,1.467.629V10.3c4.03.186,7.032,1.68,8.933,4.45,1.575,2.294,2.372,5.472,2.372,9.446A.87.87,0,0,1,25.118,25.066Z"
                transform="translate(-3.379 -5.066)"
                fill="#fff"
              />
            </svg>
            <p :style="dynamicStyles" class="text-white text-xl px-2">{{ $t("follow_the_child") }}</p>
          </div>
          <div class="my-auto">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="15"
              height="15"
              viewBox="0 0 15 15"
            >
              <circle
                id="Ellipse_34"
                data-name="Ellipse 34"
                cx="7.5"
                cy="7.5"
                r="7.5"
                fill="white"
              />
            </svg>
          </div>
        </router-link>
      </div>
      <div class="sid">
        <router-link class="flex justify-between p-4" :to="{ name: 'Edit' }">
          <div style="color: red;" class="flex">
            <svg
              class="m-auto"
              id="license-solid"
              xmlns="http://www.w3.org/2000/svg"
              width="22.125"
              height="19.47"
              viewBox="0 0 22.125 19.47"
            >
              <path
                id="Path_218"
                data-name="Path 218"
                d="M13.754,22.594H3.383A1.383,1.383,0,0,1,2,21.211V7.383A1.383,1.383,0,0,1,3.383,6H22.742a1.383,1.383,0,0,1,1.383,1.383v7.17A5.766,5.766,0,0,0,14.8,21.322l-.643.788Zm-8.3-12.445v1.106H17.211V10.148Zm0,3.872h7.605V12.914H5.457Zm0,4.84h6.914V17.754H5.457Z"
                transform="translate(-2 -6)"
                fill="#fff"
              />
              <path
                id="Path_219"
                data-name="Path 219"
                d="M29.9,21.619a4.4,4.4,0,1,0-7.446,3.174l-1.341,1.639.622,2.5,2.531-3.084a4.328,4.328,0,0,0,2.454,0l2.531,3.084.622-2.5-1.341-1.639A4.384,4.384,0,0,0,29.9,21.619Zm-7.426,0a3.018,3.018,0,1,0,.007,0Z"
                transform="translate(-7.891 -9.457)"
                fill="#fff"
              />
            </svg>
            <p class=" text-white  hover:text-[red] text-xl m-auto px-2">
              {{ $t("evaluation_result") }}
            </p>
            
          </div>
          <div class="my-auto">
            <svg
              class="m-auto"
              xmlns="http://www.w3.org/2000/svg"
              width="15"
              height="15"
              viewBox="0 0 15 15"
            >
              <circle
                id="Ellipse_34"
                data-name="Ellipse 34"
                cx="7.5"
                cy="7.5"
                r="7.5"
                fill="white"
              />
            </svg>
          </div>
        </router-link>
      </div>

      <div class="w-full" style="border: 1px solid"></div>
      <div class="bottom-0">
        <button
          @click="parentStore.logout"
          class="w-full py-2 flex items-center justify-between px-8 my-2 text-xl rounded-2xl bg-[#EB486D] hover:bg-[#E4234F]"
        >
          <p class="block">{{ $t("sign_out") }}</p>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="19.126"
            height="24.751"
            viewBox="0 0 19.126 24.751"
          >
            <path
              id="Path_222"
              data-name="Path 222"
              d="M11.25,18a1.125,1.125,0,0,1,1.125-1.125H22.5V9.563c0-2.25-2.376-3.938-4.5-3.938H7.313A3.942,3.942,0,0,0,3.375,9.563V26.438a3.942,3.942,0,0,0,3.938,3.938h11.25A3.942,3.942,0,0,0,22.5,26.438V19.125H12.375A1.125,1.125,0,0,1,11.25,18Z"
              transform="translate(-3.375 -5.625)"
              fill="#981231"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { useParentStore } from "@/stores/ParentStore.js";

export default {
  props: {
    sole: true,
    name:""
  },
  data() {
    return {
      isBold: true,
      isItalic: true,
      parentStore: useParentStore(),
    };
  },
  watch: {
    name() {
     
    },
  },
 
  
};
</script>
<style scoped>
.sid:hover  {
  scale: 1.03;
  transition: .1s;
}
.sid p:hover{
  color:#EB486D !important
}

.router-link-active p {
  color:#EB486D  !important;
}


</style>
