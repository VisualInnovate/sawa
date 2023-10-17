<template>
  <div class="">
    <div
      class="flex justify-between border-b-2 p-2 border-x-cyan-950 border-solid"
    >
      <div class="text-right m-auto visible md:invisible" @click="toggle()">
        <svg
          fill="#000000"
          width="54px"
          height="54px"
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
        <p class="w-full font-bold text-center text-2xl text-[#6EB7BF]">
          {{ $t("Profile_personly") }}
        </p>
      </div>
    </div>

    <div class="relative max-w-full max-h-screen flex">
      <sidbar :sole="showsider" />
      <div class="flex-1 overflow-scroll">
        <div class="flex justify-between shadow p-4">
          <div class="bg-white text-3xl text-[#6EB7BF] font-bold">
            {{ $t("bookings") }}
          </div>
          <div
            style="background-color: #135c65"
            class="p-2 bg-[#135c65] rounded-lg text-center"
          >
            <v-icon left color="white">mdi-plus</v-icon>
            <router-link
              :to="{ name: 'BookingTime' }"
              class="text-white rounded-lg"
            >
              {{ $t("Add_new_booking") }}
            </router-link>
          </div>
        </div>
        <div class="p-2 grid gap-5 grid-cols-2 md:grid-cols-3 text-cyan-700">
          <a
            v-for="booking in bookings"
            class="flex flex-col items-center bg-white border-gray-200 rounded-xl shadow-md md:flex-row max-w-sm hover:bg-gray-100"
          >
          <img v-if="booking.user_image == null" src="../image/Rectangle63.png">
            <img
              width="250"
              class="rounded-xl"
              v-if="booking.user_image != null"
              :src="booking.user_image"
              alt=""
            />
            <div class="flex flex-col justify-between p-4 leading-normal">
              <p class="p-2 w-full text-center text-lg text-[#148A98]">
                {{ booking.user_name }}
              </p>
              <p
                class="p-2 w-full text-center border-b text-sm border-black border-solid text-[#148A98]"
              >
                {{ booking.user_title }}
              </p>
              <p class="p-2 text-[#FF3765]">
                {{ event_day(booking.event_date) }}
              </p>
              <p class="px-2 pb-2 text-[#FF3765]">
                {{ event_hour(booking.event_date) }}
              </p>
              <p
                class="px-2 py-2 text-white rounded-lg font-medium text-center"
                :class="{
                  'bg-green-700': booking.accepted,
                  'bg-yellow-400': booking.accepted == 0,
                }"
              >
                {{ bookingStatusText(booking) }}
              </p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Map from "../components/Map.vue";
import According from "../components/According.vue";
import Sidbar from "../components/Sidbar.vue";
import axios from "axios";
import moment from "moment";

export default {
  components: { Map, According, Sidbar },
  data() {
    return {
      showsider: false,
      bookings: [],
    };
  },
  methods: {
    toggle() {
      this.showsider = !this.showsider;
    },
    getAppointments() {
      axios
        .get("/api/calender/appointments")
        .then((res) => {
          this.bookings = res.data.bookings;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    event_day(event_day) {
      let day = moment(event_day).format("dddd");
      return `${day}`;
    },
    event_hour(event_hour) {
      let hour = moment(event_hour).format("hh:mm: A");
      return `${hour}`;
    },
    bookingStatusText(booking) {
      if (booking.accepted == 1) {
        return this.$t("Accepted");
      } else if (booking.accepted == 0) {
        return this.$t("Pending");
      } else {
        return this.$t("Rejected");
      }
    },
  },
  mounted() {
    this.getAppointments();
  },
  computed: {},
};
</script>
