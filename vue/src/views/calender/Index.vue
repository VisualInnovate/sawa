<script>
import FullCalendar from "@fullcalendar/vue3";
import TimeGridplugin from "@fullcalendar/timegrid";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import axios from "axios";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import { ref } from "vue";

import 'primeicons/primeicons.css';

import moment from "moment";
import arLocale from "@fullcalendar/core/locales/ar";
// import enLocale from "@fullcalendar/core/locales";
import Calendar from "primevue/calendar";
import InputText from "primevue/inputtext";
import { tr } from "date-fns/locale";
import { useAppLangStore } from "../../stores/AppLangStore";

export default {
  components: {
    FullCalendar,
    Dialog,
    Button,
    Calendar,
    InputText,
  },
  data() {
    return {
      langStore: useAppLangStore(),
      visible: false,
      create_visible: false,
      event_id: null,
      creat_event: ref(false),
      updat_event: ref(false),
      event_title: "",
      start_event: "",
      end_event: "",
      loading: false,
      modal_text: "",
      time_start: "",
      time_end: "",
     

      opts: {
        plugins: [dayGridPlugin, interactionPlugin, TimeGridplugin, listPlugin],
        initialView: "dayGridMonth",
        footerToolbar: true,
        valid: false,
        buttonIcons: false,
        locale: null,
        validRange: {
          start: new Date(), // Set your minimum date here
          
        },
        selectable: true,
        droppable: false,
        editable: true,
        selectHelper: true,
        validRange: {
          start: new Date(),
        },
        headerToolbar: {
         
          center: "prev next today",

          left: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        eventsTimeFormat: {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit",
        },
        eventDrop: function (event) {
          console.log(event.event.id);
          axios
            .post(`/api/calender/${event.event.id}/update`, {
              start: event.event.start,
              end: event.event.end,
            })
            .then((res) => {
              console.log(res.data.k);
            });
        },
        eventDrop: function (event) {
          axios
            .post(`/api/calender/${event.event.id}/update`, {
              title: event.event.title,
              start: moment(event.event.start).format("00:00:00 YYYY-MM-d"),
              end: moment(event.event.end).format("00:00:00 YYYY-MM-d"),
            })
            .then((res) => {
              console.log(res.data.k);
            });
        },

        eventClick: function (event) {
          this.event_id = event.event.id;
          this.event_title = event.event.title;
          this.modal_text = this.$t("update_event");
          this.creat_event = false;
          this.updat_event = true;
          this.visible = true;
          this.start_event = moment(event.event.start).format("YYYY-MM-DD");
          this.end_event = moment(event.event.end).format("YYYY-MM-DD");
          console.log(this.start_event);
        }.bind(this),

        select: function (event) {
          console.log(event);
          this.event_title = "";
          this.modal_text = this.$t("create_event");
          this.creat_event = true;
          this.updat_event = false;
          this.visible = true;

          console.log(event);
          this.start_event = moment(event.start).format("YYYY-MM-DD");
          this.end_event = moment(event.end).format("YYYY-MM-DD");
          console.log(event.backgroundColor);
        }.bind(this),
      },
    };
  },
  
  
  methods: {
    loo(){
      if (localStorage.appLang == "en"){
      console.log ("ascasc")
    }
    else{
     this.opts.locale = arLocale
   
    }
    },
    goBack() {
      this.$router.go(-1);
    },
    deletevent(event) {
      console.log(event);

      axios
        .delete(`/api/calender/${this.event_id}/delete`, {})
        .then((res) => {});
      this.update();
      setTimeout(() => {
        (this.visible = false),
          (this.event_title = null),
          (this.loading = false);
      }, 700);
    },

    updateevent() {
      axios
        .post(`/api/calender/${this.event_id}/update`, {
          title: this.event_title,
          start: moment(this.start_event).format(" YYYY-MM-d"),
          end: moment(this.end_event).format(" YYYY-MM-d"),
        })
        .then((res) => {});
      this.update();
      setTimeout(() => {
        (this.visible = false),
          (this.event_title = null),
          (this.event_id = null),
          (this.loading = false);
      }, 700);
    },
    async createvent() {
      this.loading = true;
      axios
        .post("/api/calender/create", {
          title: this.event_title,
          start: this.start_event,
          end: this.end_event,
          time_start: this.time_start,
          time_end: this.time_end,
        })
        .then((res) => {
          if (res.status != 200) {
            this.valid = true;
          }
        });
      await this.update();
      setTimeout(() => {
        (this.visible = false),
          (this.event_title = null),
          (this.start_event = null),
          (this.end_event = null),
          (this.create_visible = false),
          (this.loading = false);
      }, 700);
    },
    update() {
      axios.get("/api/calender").then((res) => {
        console.log(res);
        this.opts.events = res.data.calender;
      });
    },
    refreshEvents() {
      this.$refs.calendar.$emit("refetch-events");
    },
  },

  mounted() {
    if (localStorage.appLang == "en") {
      console.log("ascasc");
    } else {
      this.opts.locale = arLocale;
    }
    console.log(localStorage.appLang);
    this.update();
    console.log(this.opts);
  },

  watch: {
    "langStore.appLang"(newLang) {
      if (newLang == "en") {
        this.opts.locale = "";
      } else {
        this.opts.locale = arLocale;
      }
      this.update();
    },
  },
};
</script>
<template>
  <div>
    <div class="mb-5 text-white">
      <v-btn
        height="45"
        class="mx-5 text-white"
        color="#135c65"
        @click="goBack"
      >
        <v-icon start icon="mdi-arrow-left"></v-icon>
        {{ $t("back") }}
      </v-btn>
    </div>
    <FullCalendar
      :options="opts"
     
      @change="refreshEvents()"
      ref="fullCalendar"
    />
    <div class="card flex justify-content-center">
      <Dialog
        v-model:visible="visible"
        id="modal"
        modal
        :header="modal_text"
        :style="{ width: '60vw' }"
      >
        <form>
          <div>
            <div>
              <label for="time_start">{{ $t("from") }}</label>
              <input
                type="time"
                name="time_start"
                id="time_start"
                v-model="time_start"
                style="border-radius: 5px"
              />
            </div>
            <div>
              <label for="time_end">{{ $t("to") }}</label>
              <input
                type="time"
                name="time_end"
                id="time_end"
                v-model="time_end"
                style="border-radius: 5px"
              />
            </div>
            <Button
              style="background-color: rgb(4, 171, 4); border: 0"
              label="Create "
              v-if="creat_event"
              :loading="loading"
              @click="createvent"
            />
            <Button
              style="
                background-color: #6241f1;
                margin-left: 10px;
                margin-right: 10px;
                border: 0;
              "
              label="update "
              v-if="updat_event"
              :loading="loading"
              @click="updateevent"
            />
            <Button
              style="background-color: #b00020; border: 0"
              label="Delet "
              v-if="updat_event"
              :loading="loading"
              @click="deletevent"
            />
          </div>
        </form>
      </Dialog>
    </div>
  </div>
</template>
<style scoped>
input {
  width: 100%;
  font-size: 20px;
  text-align: center;
  margin-top: 20px;
  margin-bottom: 20px;
  padding: 8px;
  border: 2px solid rgb(130, 130, 168);
}
p {
  color: red;
  width: 100%;
  font-size: 20px;
  text-align: center;
  margin-top: 5px;
  margin-bottom: 5px;
}
body{
  font-family: "" !important;
  
}
</style>
