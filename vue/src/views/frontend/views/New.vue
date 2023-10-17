<template>
  <Map />

  <div
    class="flex justify-between border-b-2 p-2 border-x-cyan-950 border-solid"
  >
    <div
      class="col-span-1 text-right m-auto visible md:invisible"
      @click="toggle()"
    >
      <svg
        fill="#000000"
        width="44px"
        height="44px"
        viewBox="0 0 16 16"
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
            d="M.5 7.42h15v1.25H.5zm0 3.6h15v1.25H.5zm0-7.29h15v1.25H.5z"
          ></path>
        </g>
      </svg>
    </div>

    <div class="m-auto w-full">
      <p class="w-full p-2 font-bold text-center text-2xl text-[#6EB7BF]">
        {{ $t("Profile_personly") }}
      </p>
    </div>
  </div>
  <div class="relative max-w-full max-h-screen flex">
    <sidbar :sole="showsider" />
    <div class="flex-1 py-9 my-6">
      <div
        class="top-0 bg-white absolute text-2xl w-full text-[#6EB7BF] p-2  shadow mb-6"
      >
        <p class="bg-white text-3xl py-2 text-[#6EB7BF] font-bold">{{ $t("The_latest_developments") }}</p>
      </div>
      <div class="overflow-auto" style="height: 67vh">
        <NewAcorrding
          class="mx-4"
          date="15 مايو"
          v-for="notification in notifications"
          :notification="notification"
        />
      </div>
    </div>
  </div>
  <About />
</template>
<script>
import Map from "../components/Map.vue";
import NewAcorrding from "../components/NewAcorrding.vue";
import Sidbar from "../components/Sidbar.vue";
import About from "../components/About.vue";
import axios from "axios";
export default {
  components: { Map, NewAcorrding, Sidbar, About },
  data() {
    return {
      showsider: false,
      notifications: [],
    };
  },
  methods: {
    toggle() {
      this.showsider = !this.showsider;
    },
    getNotifications() {
      axios
        .get("/api/parent/notification")
        .then((res) => {
          this.notifications = res.data.notifications;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.getNotifications();
  },
};
</script>
