<template>
  <div class="switcher">
    <Map />
    <section
      class="bg-gray-50 dark:bg-gray-900 bl bg-no-repeat bg-cover backdrop-blur-sm bg-white/30 my-4"
    >
      <div class="backdrop-blur-sm bg-white/30 p-6">
        <div class="mx-auto lg:py-0">
          <div class="mb-4 text-center">
            <h1 class="text-3xl py-2 font-bold text-[#FF2A5B] pb-3">
              {{ $t("Book_an_appointment") }}
            </h1>
            <p class="text-xl text-[#6D9AA0]">
              {{ $t("Consult_doctors_for_your_child_condition") }}
            </p>
            <p class="text-xl text-[#6D9AA0]">
              {{
                $t(
                  "And_communicate_correctly_to_give_you_the_appropriate_diagnosis"
                )
              }}
            </p>
          </div>
        </div>
      </div>
      <div class="px-[5%] py-[1%]">
        <p class="pb-4 text-3xl font-bold">
          {{ $t("Book_an_appointment_with_the_specialist") }}
        </p>
        <p class="text-[#3AD0FF] text-xl">
          {{ $t("You_can_choose_the_appropriate") }}
        </p>
      </div>
      <div class="p-[5%]">
        <v-table class="border-2 border-[#967a80]">
          <thead>
            <tr class="bg-[#135C65] border-b-2 border-[#474042]">
              <th
                class="text-white w-52 text-center"
                v-for="(event, key) in tableEvent"
              >
                {{ key }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="events.events" v-for="i in events.max">
              <td
                class="w-60"
                style="position: relative; padding: 0 0.3rem"
                v-if="events.max"
                v-for="j in Object.keys(events.events).length"
              >
                <diV
                  v-if="Object.values(tableEvent)[j - 1][i - 1]"
                  class="rounded-full border-2 border-gray-500 w-full py-2"
                >
                  <p
                    class="m-auto w-full text-center item hover:hidden lg:hover:block text-sm text-gray-700 font-medium"
                    v-if="events.events"
                  >
                    {{ Object.values(tableEvent)[j - 1][i - 1]?.day }}
                    \
                    {{ Object.values(tableEvent)[j - 1][i - 1]?.start_time }}
                  </p>
                  <button
                    style="position: absolute"
                    @click="submit(Object.values(tableEvent)[j - 1][i - 1]?.id)"
                    class="top-[30%] left-0 text-sm trans pr-2 bg-gray-200 font-medium rounded-full px-2"
                  >
                    احجز الان
                  </button>
                </diV>
                <div v-else class="rounded-full w-full">
                  <p
                    class="m-auto rounded-full py-4 bg-gray-300 w-full text-center item hover:hidden lg:hover:block text-sm"
                  ></p>
                </div>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
    </section>
    <About />
  </div>
</template>
<script>
import axios from "axios";

import Map from "../components/Map.vue";

import About from "../components/About.vue";
import Sidbar from "@/views/frontend/components/Sidbar.vue";
import Knob from "primevue/knob";
import FileUpload from "primevue/fileupload";
import moment from "moment";
export default {
  data() {
    return {
      events: [],
      tableEvent: {},
      max: 0,
      itemsPerPage: 5,
      desserts: [1, 2, 3],
      headers: [
        {
          title: "الجمعه",
          align: "start",
          sortable: false,
          key: "name",
        },
        { title: this.$t("الخميس"), key: "calories" },
        { title: this.$t("الاربعاء"), key: "fat" },
        { title: this.$t("الثلاثاء"), key: "calories" },
        { title: this.$t("الاثنين"), key: "carbs" },
        { title: this.$t("الاحد"), key: "protein" },
        { title: this.$t("السبت"), key: "iron" },
      ],
    };
  },
  components: { Map, About },

  methods: {
    getEvents() {
      axios
        .get("/api/calender/events")
        .then((res) => {
          this.events = res.data.events;

          this.max = res.data.max;
          Object.keys(res.data.events.events).forEach((elem) => {
            if (!this.events.events.Saturday) this.events.events.Saturday = [];
            this.tableEvent.Saturday = this.events.events.Saturday;

            if (!this.events.events.Sunday) this.events.events.Sunday = [];
            this.tableEvent.Sunday = this.events.events.Sunday;

            if (!this.events.events.Monday) this.events.events.Monday = [];
            this.tableEvent.Monday = this.events.events.Monday;

            if (!this.events.events.Tuesday) this.events.events.Tuesday = [];
            this.tableEvent.Tuesday = this.events.events.Tuesday;

            if (!this.events.events.Wednesday)
              this.events.events.Wednesday = [];
            this.tableEvent.Wednesday = this.events.events.Wednesday;

            if (!this.events.events.Thursday) this.events.events.Thursday = [];
            this.tableEvent.Thursday = this.events.events.Thursday;

            if (!this.events.events.Friday) this.events.events.Friday = [];
            this.tableEvent.Friday = this.events.events.Friday;
          });
          console.log(this.tableEvent);
        })

        .catch((err) => {
          console.log(err);
        });
    },
    submit(id) {
      this.$router.push({ name: "more", params: { event_id: id } });
      console.log(id);
    },
  },

  mounted() {
    this.getEvents();
  },
};
</script>
<style scoped>
td {
  overflow: hidden;
}

.time {
  border: 1px solid rgb(149, 133, 133);
  border-radius: 30%;
}

.trans {
  color: red;
  transform: translateX(-100%);
  transition: all linear 200ms;
}

td:hover button {
  transform: translateX(20%);
}
</style>
