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
    <sidbar :sole="showsider" :name="routername" />
    <div class="flex-1">
     <div class="flex justify-between bg-white py-2  px-1 w-full text-[#6EB7BF] shadow ">
      <div
        class="bg-white text-3xl py-2 text-[#6EB7BF] font-bold"
      >
        {{ $t("evaluation_result") }}
      </div>
      <div class=" my-auto text-center  ">
        <router-link
          :to="{ name: 'ReAction' }"
          style="background-color: #135c65"
          class="text-white py-2 px-3 rounded-lg"
        >
          اضافه طفل جديد
        </router-link>
      </div>
     </div>

      <div class="overflow-auto" style="height: 70vh">
        <according
          v-for="child in childs"
          class="text-xs block"
          :name="child.name"
          :id="child.id"
          :age="child.age"
          :report_date="child.report_date"
          :report_text="child.report_text"
        >
        </according>
      </div>
     
    </div>
  </div>
  <About />
</template>
<script>
import Map from "../components/Map.vue";
import According from "../components/According.vue";
import Sidbar from "../components/Sidbar.vue";
import About from "../components/About.vue";
import { useParentStore } from "../../../stores/ParentStore";
import axios from "axios";
export default {
  components: { Map, According, Sidbar, About },
  data() {
    return {
      showsider: false,
      routername:"",
      childs: [],
      parentStore: useParentStore(),
      errors: [],
    };
  },
  methods: {
    toggle() {
      this.showsider = !this.showsider;
    },
    async getChilds() {
      await axios
        .get("/api/parent/child/all")
        .then((res) => {
          this.childs = res.data.childs;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },

    // async getLatestReport(id) {
    //   this.report_date = null;
    //   this.report_text = null;
    //   await axios
    //     .post("/api/calender/booking/child/report", {
    //       child_id: id,
    //     })
    //     .then((res) => {
    //       this.report_text = res.data.report.booking_result;
    //       this.report_date = res.data.report.report_date;
    //       console.log(res);
    //     })
    //     .catch((err) => {
    //       console.log(err);
    //     });
    // },
  },
  watch: {
    '$route.name': function() {
      // React to route name changes here
      this.routername = $route.name
      console.log(this.routername)
    },
  },

  mounted() {
    this.getChilds();
  },
};
</script>
