<template>
  <div class="px-4 relative">
    <div>
      <v-alert
        class="fixed z-10"
        color="success"
        icon="$success"
        title="Booked Successfully"
        :text="alert_text"
        v-if="show_alert"
        >
    </v-alert>

    </div>
    <div class="md:grid flex flex-col gap-5 sm:grid-cols-6">
      <div class="p-0 m-auto">
        <img class="m-auto" src="../image/header/calendar-01nobg-01.png" />
      </div>
      <div class="col-span-4 text-center m-auto">
        <p class="flex items-center text-3xl">

          <div class="flex items-center">
            <p class=" text-[#FF3765]">
                {{ event_day(event) }}
              </p>
              <p class="px-2  text-[#FF3765]">
                {{ event_hour(event) }}
              </p>
          </div>
          <svg
            fill="#135C65"
            width="35px"
            height="40px"
            viewBox="0 0 1024.00 1024.00"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
              id="SVGRepo_tracerCarrier"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke="#CCCCCC"
              stroke-width="18.432"
            ></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M266.815 537.708c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.775 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zM266.815 679.347c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.775 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zM266.815 820.988c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.775 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zm182.77 0c0 22.62-18.34 40.96-40.96 40.96s-40.96-18.34-40.96-40.96 18.34-40.96 40.96-40.96 40.96 18.34 40.96 40.96zM228.18 81.918v153.6c0 11.311 9.169 20.48 20.48 20.48s20.48-9.169 20.48-20.48v-153.6c0-11.311-9.169-20.48-20.48-20.48s-20.48 9.169-20.48 20.48zm528.09 0v153.6c0 11.311 9.169 20.48 20.48 20.48s20.48-9.169 20.48-20.48v-153.6c0-11.311-9.169-20.48-20.48-20.48s-20.48 9.169-20.48 20.48z"
              ></path>
              <path
                d="M890.877 137.517c33.931 0 61.44 27.509 61.44 61.44v703.375c0 33.931-27.509 61.44-61.44 61.44h-757.76c-33.931 0-61.44-27.509-61.44-61.44V198.957c0-33.931 27.509-61.44 61.44-61.44h757.76zm-757.76 40.96c-11.309 0-20.48 9.171-20.48 20.48v703.375c0 11.309 9.171 20.48 20.48 20.48h757.76c11.309 0 20.48-9.171 20.48-20.48V198.957c0-11.309-9.171-20.48-20.48-20.48h-757.76z"
              ></path>
              <path
                d="M575.03 338.288c0-33.93-27.51-61.44-61.44-61.44s-61.44 27.51-61.44 61.44c0 33.93 27.51 61.44 61.44 61.44s61.44-27.51 61.44-61.44zm40.96 0c0 56.551-45.849 102.4-102.4 102.4s-102.4-45.849-102.4-102.4c0-56.551 45.849-102.4 102.4-102.4s102.4 45.849 102.4 102.4z"
              ></path>
            </g>
          </svg>
        </p>
      </div>
     
    </div>
    <div class="m-auto p-8 rounded-2xl max-w-2xl text-center">
      <div class="my-4">
        <h2 class="text-right font-bold text-xl">{{ $t("Book_an_appointment_with_the_specialist") }}</h2>
        <p class="text-right text-[#29CCFF] text-xl">{{ $t("Please_fill_in_the_information") }}</p>
      </div>
      <form class="py-4 min-w-full space-y-4 p-2" @submit.prevent="bookTime">
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("اسم الطفل")
          }}</label>
         <select name="" id="" v-model="booking.child_id" class="py-2">
          <option v-for="child in childs" :value="child.id" class="py-4">{{ child.name }}</option>
        </select>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("اسم ولي امر  مقدم الطلب")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.requester_name"
            class="focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['requester_name']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("درجه قرابته للطفل ")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.relative_degree"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['relative_degree']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>

        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("رقم هاتف ولي الامر")
          }}</label>
          <input
            type="tel"
            id="child_name"
            v-model="booking.requester_phone"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['requester_phone']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("رقم هاتف اضافي")
          }}</label>
          <input
            type="tel"
            id="child_name"
            v-model="booking.addtional_phone"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['addtional_phone']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("مالك الرقم الاضافي")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.addtional_phone_owner"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['addtional_phone_owner']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("درجه قرابته بالطفل")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.addtional_phone_degree"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['addtional_phone_degree']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("مصدر التحويل")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.conversion_type"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['conversion_type']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <label class="text-base font-bold text-right pl-2">{{
            $t("الطبيب الخاص بالطفل")
          }}</label>
          <input
            type="text"
            id="child_name"
            v-model="booking.child_doctor"
            class="border-b focus:ring-0 text-center"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['child_doctor']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>

        <p class="p-4 font-bold text-base text-right">اجب عن الاسئله الاتيه</p>
        <div class="w-full">
          <h3 class="py-2 text-lg">نرجو تحديد نوع المشكله</h3>
          <Dropdown
            v-model="booking.child_problem"
            :options="problem_type"
            optionLabel="name"
            optionValue="name"
            placeholder="نرجو تحديد نوع المشكله"
            class="w-full text-left"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['child_problem']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div
          class="flex flex-col"
          style="border-bottom: 2px solid rgb(194, 188, 188)"
        >
          <input
            type="tel"
            id="child_name"
            placeholder="التسخيص ان وجد"
            class="border-b focus:ring-0 text-center"
            v-model="booking.child_problems_notes"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['child_problems_notes']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div class="w-full">
          <h3 class="py-2">هل يستخدم الطفل اي معينات حركيه / سمعيه/ بصريه</h3>
          <Dropdown
            v-model="booking.child_aids"
            :options="approve"
            optionLabel="name"
            optionValue="id"
            placeholder="هل يستخدم الطفل اي معينات حركيه / سمعيه/ بصريه"
            class="w-full text-left"
          />
          <div
            class="text-red-600 font-semibold text-sm rounded-md"
            v-if="errors != null"
          >
            <p v-for="error in errors['child_aids']">
              <span v-for="err in error">{{ err }} </span>
            </p>
          </div>
          <div v-if="booking.child_aids" class="flex flex-col border-b py-4">
            <p class="text-right text-lg">اضف ملاحظات</p>
            <Textarea
              class="w-full"
              v-model="booking.child_aids_notes"
              rows="5"
              cols="30"
            />
          </div>
          <div
            v-if="errors != null"
            class="text-red-600 font-semibold text-sm rounded-md"
          >
            <p v-for="error in errors['child_aids_notes']">
              <span v-for="err in error">{{ err }} </span>
            </p>
          </div>
        </div>
        <div class="space-y-4">
          <p class="text-right text-lg">
            :المشاكل الرئيسيه لدي الطفل حاليا من وجهه نظر الاهل
          </p>
          <Textarea
            class="w-full"
            v-model="booking.child_parents_problems"
            rows="5"
            cols="30"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['child_parents_problems']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div class="space-y-4">
          <p class="text-right text-lg">
            :ما هي اولويه الاهل في البرامج التاهليه للتعامل مع الطفل
          </p>
          <Textarea
            class="w-full"
            v-model="booking.parents_priorities"
            rows="5"
            cols="30"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['parents_priorities']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div>
          <input
            class="border-0 border-b text-xl text-center focus:ring-0"
            type="text"
            v-model="booking.doctor_code"
            placeholder="ادخل كود استشاري تريده"
          />
        </div>
        <div
          v-if="errors != null"
          class="text-red-600 font-semibold text-sm rounded-md"
        >
          <p v-for="error in errors['doctor_code']">
            <span v-for="err in error">{{ err }} </span>
          </p>
        </div>
        <div class="text-right m-auto w-full space-x-4">
          <span class="m-auto text-xl">انا اوافق علي كافه الشروط والاحكام</span>
          <input style="border: 2px solid black" type="checkbox" />
        </div>
        <button
          type="submit"
          class="w-full p-2 text-2xl text-white bg-[#148A98] rounded-2xl"
        >
          احجز الان
        </button>
      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Dropdown from "primevue/dropdown";
import Textarea from "primevue/textarea";
import { useParentStore } from "../../../stores/ParentStore";
import moment from "moment";
export default {
  props: ["event_id"],
  components: {
    Dropdown,
    Textarea,
  },
  data() {
    return {
      parentStore: useParentStore(),
      selectedFruit: null,
      fruits: [
        { id: 0, name: "انثي" },
        { id: 1, name: "ذكر" },
      ],
      problem_type: [
        { name: "حركيه" },
        { name: "سمعيه" },
        { name: "بصريه" },
        { name: "عقليه/نمائيه" },
        { name: "توحد" },
        { name: "اخر" },
      ],
      approve: [
        { id: 1, name: "نعم" },
        { id: 0, name: "لا" },
      ],
      errors: [],
      childs: [],
      event: {},
      alert_text:'',
show_alert:false,
      booking: {
        event_id: "",
        user_id: "",
        child_id: "",
        requester_name: "",
        requester_phone: "",
        relative_degree: "",
        addtional_phone: "",
        addtional_phone_owner: "",
        addtional_phone_degree: "",
        conversion_type: "",
        child_doctor: "",
        child_problem: "",
        child_problems_notes: "",
        child_aids: "",
        child_aids_notes: "",
        child_parents_problems: "",
        parents_priorities: "",
        doctor_code: "",
      },
    };
  },
  methods: {
    async bookTime() {
      this.errors = null;
      this.booking.user_id = this.parentStore.user.id;
      this.booking.event_id = this.event_id;
      this.alert_text = null;
      this.show_alert = false;
      console.log(this.booking);
      await axios
        .post("/api/calender/store-booking", this.booking)
        .then((res) => {
          this.alert_text=this.$t("your_booking_was_successfully_submitted")
          this.show_alert = true;
          this.errors = null;
          Object.keys(this.booking).forEach((key) => {
            this.booking[key] = null;
          });
          console.log(res);
         setTimeout(()=>{
          this.show_alert = false;
          this.$router.push({name:'Booking'})
         }, 3000);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          console.log(this.errors);
          console.log(err);
        });
    },
    async getEvent() {
      await axios
        .get(`/api/calender/booking/${this.event_id}`)
        .then((res) => {
          this.event = res.data.calender.start;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
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
    event_day(event_day) {
      
      let day = moment(event_day).format("dddd");

    
      
      return `${day}`;
    },
    event_hour(event_hour) {
      let hour = moment(event_hour).format("hh:mm: A");
      return `${hour}`;
    },
  },
 

  mounted( ) {
   
    this.getEvent();
    this.getChilds();
    console.log(this.event_id);
  },
};
</script>