<template>
  <div class="">
    <div class="flex justify-between">
      <div style="width: 25%" class="m-auto">
        <img class="h-56 m-auto" src="../image/header/registernobg-01.png" />
      </div>
      <div class="m-auto text-center w-[50%] space-y-2">
        <h1 class="text-3xl font-bold text-[#FF2A5B]">
          {{ $t("Register_your_child") }}
        </h1>
        <h2 class="text-[#6D9AA0] text-lg">
          {{
            $t("From_here_you_can_register_your_child_with_us_to_be_monitored")
          }}
        </h2>
        <h3 class="text-[#6D9AA0] text-lg">
          {{
            $t("The_extent_to_which_his_mental_and_physical_skill_developed")
          }}
        </h3>
      </div>

      <div style="width: 25%" class="relative my-auto">
        <v-icon
          @click="goback"
          style="right: 50%"
          class="bg-[#135C65] text-white p-6 absolute rounded-full"
          start
          icon="mdi-arrow-left"
        ></v-icon>
      </div>
    </div>

    <div
      style="margin-bottom: 2%"
      class="m-auto w-[95%] lg:w-[45%] shadow-xl p-[2%] rounded-xl relative"
    >
      <!-- Alert -->
      <p
        v-if="show_alert"
        class="text-center text-xl font-bold tracking-wide"
        style="color: green"
      >
        {{ alert_text }}
      </p>
      <!-- End Alert -->

      <form class="space-y-6">
        <div class="flex flex-col gap-4">
          <!--  Child Name -->
          <div>
            <div
              class="flex flex-col"
              style="border-bottom: 2px solid rgb(194, 188, 188)"
            >
              <label class="text-base font-bold">{{ $t("Full_Name") }}</label>
              <input
                type="text"
                id="name"
                v-model="child.name"
                class="border-b focus:ring-0"
              />
            </div>
            <div
              v-if="errors != null"
              class="text-red-600 font-semibold text-sm rounded-md"
            >
              <p v-for="error in errors['name']">
                <span v-for="err in error">{{ err }} </span>
              </p>
            </div>
          </div>
          <!-- End Child Name -->

          <!-- Birth Data -->
          <div
            class="flex flex-col md:flex-row md:items-center md:justify-between md:gap-4"
          >
            <div class="flex-1">
              <div class="flex flex-col">
                <label class="text-base font-bold">{{
                  $t("date_of_birth")
                }}</label>
                <div class="flex justify-center items-center" id="calender">
                  <Calendar
                    style="width: 100%; padding: "
                    showButtonBar
                    v-model="child.birth_date"
                    dateFormat="dd/mm/yy"
                    :maxDate="maxDate"
                  />
                </div>
              </div>
              <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['birth_date']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
            </div>

            <div class="flex-1">
              <div
                class="flex flex-col"
                style="border-bottom: 2px solid rgb(194, 188, 188)"
              >
                <label class="text-base font-bold">{{
                  $t("place_of_birth")
                }}</label>
                <input
                  type="text"
                  id="birth_place"
                  v-model="child.birth_place"
                  class="border-b focus:ring-0"
                />
              </div>
              <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['birth_place']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
            </div>
          </div>
          <!-- End Birth Data -->

          <!-- Child Lang And Address -->
          <div
            class="flex flex-col md:flex-row md:items-center md:justify-between md:gap-4"
          >
            
            <div  style="border-bottom: 2px solid rgb(194, 188, 188)"  class="card w-[50%]  justify-content-center">
                <label class="text-base font-bold">{{
                  $t("primary_language")
                }}</label>
                 
              
                <select  class="w-full" name="drinks" id="cars" v-model="child.lang">
                  <option value="" disabled selected hidden>{{ $t('primary_language') }}</option>
                  <option v-for="l in lan" >{{ l.lang }}</option>
                </select>
             </div>

            <div class="flex-1">
              <div
                class="flex flex-col"
                style="border-bottom: 2px solid rgb(194, 188, 188)"
              >
                <label class="text-base font-bold">{{ $t("address") }}</label>
                <input
                  type="text"
                  id="address"
                  v-model="child.address"
                  class="border-b focus:ring-0"
                />
              </div>
              <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['address']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
            </div>
          </div>
          <!-- End Child Lang And Nationalty -->

          <!-- Child Nationalty and National ID -->
          <div
            class="flex flex-col md:flex-row md:items-center md:justify-between md:gap-4"
          >
            <div class="flex-1">
              <!-- <div
                class="flex flex-col"
                style="border-bottom: 2px solid rgb(194, 188, 188)"
              >
                <label class="text-base font-bold">{{
                  $t("Nationality")
                }}</label>
                <input
                  type="text"
                  id="nationalty"
                  v-model="child.nationalty"
                  class="border-b focus:ring-0"
                />
              </div> -->
              <div    class="card  justify-content-center">
                <label class="text-base font-bold">{{
                  $t("Nationality")
                }}</label>
                 
                <select style="border-bottom: 2px solid rgb(194, 188, 188)" class="w-full" name="drinks" id="cars" v-model="child.nationalty">
                  <option value="" disabled selected hidden>{{ $t('Nationality_choose') }}</option>
                  <option v-for="city in cities"  >{{ city.nationality }}</option>

                </select>
                <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['nationalty']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
             </div>
              <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['nationalty']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
            </div>

            <div class="flex-1">
              <div
                class="flex flex-col"
                style="border-bottom: 2px solid rgb(194, 188, 188)"
              >
                <label class="text-base font-bold">{{
                  $t("national_id")
                }}</label>
                <input
                  type="text"
                  id="national_id"
                  v-model="child.national_id"
                  class="border-b focus:ring-0"
                />
              </div>
              <div
                v-if="errors != null"
                class="text-red-600 font-semibold text-sm rounded-md"
              >
                <p v-for="error in errors['national_id']">
                  <span v-for="err in error">{{ err }} </span>
                </p>
              </div>
            </div>
          </div>
          
          
          <div class="card w-[49%]">
            <h3 class="text-base font-bold text-right ">
              {{ $t("Type") }}
            </h3>
                 <Dropdown id="pv_id_2" v-model="child.gender" :options="arr()" optionLabel="name" :placeholder='$t("selectgender")'  class="w-full  md:w-14rem focus:ring-0" />
             </div>
        </div>
        <button
          style="padding: 2%"
          class="w-full rounded-3xl bg-[#148A98] text-white text-xl"
          @click.prevent="addChild"
        >
          {{ $t("Register_now") }}
        </button>
      </form>
    </div>
  </div>
</template>
<script>
import Dropdown from 'primevue/dropdown';
import axios from "axios";
import moment from "moment";
import Calendar from "primevue/calendar";
import Textarea from "primevue/textarea";
import { useParentStore } from "../../../stores/ParentStore";
import Message from "primevue/message";
export default {
  components: { Calendar, Textarea, Message ,Dropdown },
  data() {
    return {
      show: false,
      lan:[],
      selectedCity: null,
            cities: {},
            type:[ ],
      maxDate: new Date(),
      parentStore: useParentStore(),
      errors: [],
      alert_text: "",
      show_alert: false,
      child: {
        parent_id: "",
        name: "",
        
        birth_date: "",
        birth_place: "",
        lang: "",
        gender: "",
        nationalty: "",
        national_id: "",
        address: "",
      },
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  methods: {
    arr (){
      return this.type =[
            { name:this.$t('male') , value:'0' },
                { name:this.$t('female') , value:'1' },
              
               
            ]
    },
   
    goback() {
      this.$router.go(-1);
    },
    addChild() {
      this.errors = null;
      this.show_alert = false;
      this.alert_text = null;
      this.child.parent_id = this.parentStore.user.id;
      this.child.birth_date = moment(this.child.birth_date).format(
        "YYYY-MM-DD"
      );
      this.child.gender=this.child.gender.value
      console.log(this.child.gender)
      axios
        .post("/api/parent/child/create", this.child)
        .then((res) => {
         
          console.log("feweqf")
          this.errors = null;
          this.show_alert = true;
          this.alert_text = this.$t("child_added");
          
           
            
      
          Object.keys(this.child).forEach((key) => {
            this.child[key] = null;
          });
          this.$router.push({name:"Following"});
     
          console.log(res);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          console.log(err);
        });
    },

    getCountries() {
      axios
        .get("/api/countries")
        .then((res) => {
          console.log(res.data.countries)
          this.cities = res.data.countries
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getLangs() {
      axios
        .get("/api/languages")
        .then((res) => {
          this.lan=res.data.langs
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  mounted() {
    this.getCountries();
    this.getLangs();
  },
};
</script>
<style>
/* Target the placeholder pseudo-element and set opacity */
input::placeholder {
  opacity: 0.5;
}

#calender input {
  
  border: none;
  border-bottom: 2px solid rgb(194, 188, 188);
  text-align: center;
  font-family: "Cairo", sans-serif;
  font-size: 20px;
}
#pv_id_3  {
  border: none;
  border-bottom: 2px solid #818080;
  text-align: center;
  font-family: "Cairo", sans-serif;
  font-size: 20px;
  border-radius: 0;
}
#pv_id_2 {
  
  border: none;
  border-bottom: 2px solid rgb(194, 188, 188);
  text-align: center;
  font-family: "Cairo", sans-serif;
  font-size: 20px;
  border-radius: 0;
}
#pv_id_2:focus {
  border: none;

}

input::placeholder {
  opacity: 50%;
  color: black;
}
</style>
