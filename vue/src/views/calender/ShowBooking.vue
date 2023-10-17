<template>
  <div class="mt-6">
    <h1 class="border-b text-3xl w-full md:w-1/2 uppercase text-green-800 py-4">
      {{ $t("bookings") }}
    </h1>

    <div
      v-for="booking in bookings"
      class="px-3 py-2 mt-2 mb-12 rounded-lg shadow-sm cursor-pointer item flex justify-between bg-gray-50"
    >
      <div class="relative flex flex-col items-center mx-4">
        <p class="text-sm">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
            @click="openModal(booking.id)"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
            />
          </svg>
        </p>
        <RouterLink
          class="absolute bottom-0 text-center"
          :to="{ name: 'BookingDetails', params: { id: booking.id } }"
        >
          <svg
            class="mx-auto"
            width="35px"
            height="35px"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            fill="#000000"
          >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
              id="SVGRepo_tracerCarrier"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
              <path
                fill="none"
                stroke="#148A98"
                stroke-width="2"
                d="M9,4 L4,9 L9,14 M18,19 L18,9 L5,9"
                transform="matrix(1 0 0 -1 0 23)"
              ></path>
            </g>
          </svg>
          <p class="text-xs text-[#148A98]">متابعة التفاصيل</p>
        </RouterLink>
      </div>
      <div class="flex flex-col text-right">
        <p class="font-bold" style="color: #00897b">
          {{ booking.child_name }}
        </p>
        <p class="text-base py-1">{{ booking.child_age }} : العمر</p>
        <p class="text-base py-1">{{ booking.requester_phone }} : رقم الهاتف</p>
        <p class="text-base py-1">{{ booking.event_date }} : موعد الاستشاره</p>
      </div>
    </div>
  </div>

  <div>
    <v-row justify="center">
      <v-dialog v-model="show_result_modal" persistent width="1024">
        <v-card>
          <v-card-title>
            <span class="text-h5">Booking Result</span>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <label for="result">Result</label>
                <textarea
                  name="result"
                  id="result"
                  v-model="booking_result"
                  style="width: 100%; border: 2px solid gray"
                  class="focus:ring-gray-400"
                  rows="5"
                ></textarea>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="show_result_modal = false"
            >
              Close
            </v-btn>
            <v-btn color="blue-darken-1" variant="text" @click="addNote()">
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      bookings: [],
      booking_result: "",
      booking_id: null,
      show_result_modal: false,
    };
  },
  methods: {
    getBookings() {
      axios
        .get("/api/calender/bookings")
        .then((res) => {
          this.bookings = res.data.bookings;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    openModal(booking_id) {
      this.show_result_modal = true;
      this.booking_id = booking_id;
    },
    addNote() {
      axios
        .patch(`/api/calender/bookings/${this.booking_id}`, {
          booking_result: this.booking_result,
        })
        .then((res) => {
          this.show_result_modal = false;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.getBookings();
  },
};
</script>
<style scoped>
.item:hover {
  background-color: #e6f8f6;
  transition: all linear 300ms;
}
</style>
