<template>
  <div class="relative flex min-h-screen">
    <div class="flex-1">
      <div class="bg-white shadow p-2 text-right">
        <button @click="showsider = !showsider">الحجوزات</button>
      </div>
      <div class="p-2 flex flex-wrap text-cyan-700">
        <a
          class="flex flex-col m-2 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row max-w-sm hover:bg-gray-100"
        >
          <img
            class="object-cover rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
            src="../image/Rectangle 63.png"
            alt=""
          />
          <div class="flex flex-col justify-between p-4 leading-normal">
            <p class="p-2 border-b-2 border-black border-solid text-[#148A98]">
              اخصائي تربيه طفوله
            </p>
            <p class="p-2 text-[#FF3765]">اليوم : الاحد</p>
            <p class="px-2 pb-2 text-[#FF3765]">الساعه :10 م</p>
            <button class="w-full p-2 rounded-2xl bg-[#48A700]">
              اتصل الان
            </button>
          </div>
        </a>
        <a
          class="flex flex-col m-2 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-sm hover:bg-gray-100"
        >
          <img
            class="object-cover rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
            src="../image/Rectangle 63.png"
            alt=""
          />
          <div class="flex flex-col justify-between p-4 leading-normal">
            <p class="p-2 border-b-2 border-black border-solid text-[#148A98]">
              اخصائي تربيه طفوله
            </p>
            <p class="p-2 text-[#FF3765]">اليوم : الاحد</p>
            <p class="px-2 pb-2 text-[#FF3765]">الساعه :10 م</p>
            <button class="w-full p-2 rounded-2xl bg-[#48A700]">
              اتصل الان
            </button>
          </div>
        </a>
        <a
          class="flex flex-col m-auto items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-sm hover:bg-gray-100"
        >
          <div class="flex flex-col justify-between p-4 leading-normal">
            <p class="text-right">د / عبدالله احمد</p>
            <p class="p-2 border-b-2 border-black border-solid text-[#148A98]">
              اخصائي تربيه طفوله
            </p>
            <p class="p-2 text-[#FF3765] text-right">اليوم : الاحد</p>
            <p class="px-2 pb-2 text-[#FF3765] text-right">الساعه :10 م</p>
            <button class="w-full p-2 rounded-2xl bg-[#48A700] text-white">
              اتصل الان
            </button>
          </div>
          <img
            class="object-cover rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
            src="../image/Rectangle 63.png"
            alt=""
          />
        </a>
      </div>
    </div>
    <div
      class="bg-[#135C65] text-cyan-100 md:w-80 w-72 py-8 space-y-6 px-2 absolute inset-y-0 left-0 md:relative md:-translate-x-0 transform -translate-x-full transition duration-200 ease-in-out"
      :class="{ 'fixed translate-x-0 ': showsider }"
    >
      <div class="space-y-2 py-4 border-b-2 border-white border-solid">
        <div><img class="m-auto" src="../image/Ellipse 2.png" /></div>
        <p class="text-white text-center">عبدالله محمد عبدالمنعم</p>
        <p class="text-center text-white">mohamedemad@gmail.com</p>
      </div>
      <div class="flex justify-between p-4">
        <div>
          <font-awesome-icon
            class="text text-white hover:text-red-600"
            icon="fa-solid fa-circle"
          ></font-awesome-icon>
        </div>
        <div class="flex">
          <p class="text-white text-xl">اخر المستجدات</p>
          <font-awesome-icon
            class="pl-2 text-sm text-white m-auto"
            icon="fa-solid fa-bell"
          ></font-awesome-icon>
        </div>
      </div>
      <div class="flex justify-between p-4">
        <div>
          <font-awesome-icon
            class="text text-white hover:text-red-600"
            icon="fa-solid fa-circle"
          ></font-awesome-icon>
        </div>
        <div class="flex">
          <p class="text-white text-xl">الحجوزات</p>
          <font-awesome-icon
            class="pl-2 text-sm text-white m-auto"
            icon="fa-solid fa-bell"
          ></font-awesome-icon>
        </div>
      </div>
      <div class="flex justify-between p-4">
        <div>
          <font-awesome-icon
            class="text text-white hover:text-red-600"
            icon="fa-solid fa-circle"
          ></font-awesome-icon>
        </div>
        <div class="flex">
          <p class="text-white text-xl">متابعة الطفل</p>
          <font-awesome-icon
            class="pl-2 text-sm text-white m-auto"
            icon="fa-solid fa-bell"
          ></font-awesome-icon>
        </div>
      </div>
      <div
        class="flex justify-between p-4 border-b-2 border-white border-solid"
      >
        <div>
          <font-awesome-icon
            class="text text-white hover:text-red-600"
            icon="fa-solid fa-circle"
          ></font-awesome-icon>
        </div>
        <div class="flex">
          <p class="text-white text-xl">نتيجة التقيم</p>
          <font-awesome-icon
            class="pl-2 text-sm text-white m-auto"
            icon="fa-solid fa-bell"
          ></font-awesome-icon>
        </div>
      </div>
      <button
        class="w-full py-2 text-xl text-white rounded-2xl bg-[#23D1E6] hover:bg-[#0B8897]"
      >
        تعديل الملف الشخصي
      </button>
      <button
        class="w-full py-2 text-xl rounded-2xl bg-[#EB486D] hover:bg-[#E4234F]"
      >
        تسجيل الخروج
      </button>
    </div>
  </div>
</template>
<script>
import { ref } from "vue";
export default {
  setup() {
    const showsider = ref(false);
    return {
      showsider,
    };
  },
};
</script>
