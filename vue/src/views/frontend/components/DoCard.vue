<template>
  <div
    style="
      background: linear-gradient(to right, #ff8b6a, #ff566f);
      padding-bottom: 2%;
      padding-top: 2%;
    "
    class="p-6 bg-center bg-cover m-auto relative"
  >
    <img
      src="../image/sec1/m.png"
      class="absolute inset-0 w-full h-full object-cover"
    />
    <!--        -->
    <div style="padding-bottom: 2%" class="text-center">
      <h1 class="text-4xl font-bold text-white tracking-wide">
        {{ $t("Sawa_Academy_team") }}
      </h1>
      <p class="text-2xl text-white tracking-wide pt-4">
        {{ $t("We_have_a_group_of_highly_experienced_therapists") }}
      </p>
    </div>

    <swiper
      @slideChange="onSlideChange"
      :modules="modules"
      :scrollbar="{ draggable: true }"
      :autoplay="{
        delay: 2000,
        disableOnInteraction: false,
      }"
      :breakpoints="{
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 10,
        },
      }"
    >
      <SwiperSlide v-for="doctor in doctors">
        <div class="text-center bg-teal-100 rounded-3xl m-2">
          <!-- Doctor -->
          <div class="bg-white rounded-3xl">
            <img
              style="width: 210px; height: 310px"
              class="m-auto px-5 object-cover w-[100%] h-[100%]"
              :src="doctor.image"
            />
          </div>
          <p class="text-center pt-2 opacity-80">{{ doctor.name }}</p>
          <p class="text-center text-teal-400 pb-4 p-1">
            {{ doctor.title }}
          </p>
        </div>
        <!-- Doctor -->
      </SwiperSlide>
    </swiper>
  </div>
</template>

<script setup>
import axios from "axios";
import { computed, onMounted, ref, watch } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Pagination, Navigation, Autoplay } from "swiper/modules";

const modules = [Pagination, Navigation, Autoplay];

const doctors = ref([]);
onMounted(() => {
  getDoctors();
});
const getDoctors = () => {
  axios
    .get("/api/doctors")
    .then((res) => {
      doctors.value = res.data.doctors;
      console.log(doctors.value);
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>
