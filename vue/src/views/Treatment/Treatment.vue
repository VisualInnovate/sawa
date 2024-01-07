<template>
  <v-card>
    <div>
      <!-- ... existing code ... -->
      <v-dialog v-model="isSuccessModalOpen" max-width="400px">
        <v-card>
          <v-card-title>{{ $t("Success!") }}</v-card-title>
          <v-card-text>
            {{ $t("Data seeded successfully!") }}
          </v-card-text>
          <v-card-actions>
            <v-btn @click="closeSuccessModal" color="success">
              {{ $t("OK") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-form @submit.prevent="seedData">
        <!-- ... existing code ... -->
        <div class="name-input">
          <label for="title"> {{ $t("ProgramName") }} </label>
          <v-text-field v-model="formData.title" hide-details></v-text-field>
          <label for="title"> {{ $t("price") }} </label>
          <v-text-field v-model="formData.price" hide-details></v-text-field>

          <label for="selectedValue"> {{ $t("typesessaion") }}</label>
          <div class="select-container">
            <select v-model="formData.session_type_id" class="custom-select">
              <option
                v-for="(session, index) in sessionTypes"
                :kay="index"
                :value="session.id"
              >
                {{ session.title }}
              </option>
            </select>
          </div>

          <label for="doctors"> {{ $t("ProgramType") }} </label>
          <select
            id="selectOption"
            v-model="formData.program_type_id"
            class="custom-select"
            @change="handleChange"
          >
            <option
              v-for="(Program, index) in programtypes"
              :key="index"
              :value="Program.id"
            >
              {{ Program.title }}
            </option>
          </select>
          <label for="doctors"> {{ $t("SystemProgram") }} </label>
          <select v-model="formData.program_system_id" class="custom-select">
            <option
              v-for="(system, index) in programsystems"
              :kay="index"
              :value="system.id"
            >
              {{ system.title }}
            </option>
          </select>
          <label for="doctors"> {{ $t("AppointmentType") }} </label>
          <select v-model="formData.appointment_type_id" class="custom-select">
            <option
              v-for="(appointmentType, index) in appointmentTypes"
              :kay="index"
              :value="appointmentType.id"
            >
              {{ appointmentType.title }}
            </option>
          </select>

          <label for="doctors"> {{ $t("Typetreatment") }} </label>
          <select v-model="formData.treatment_type_id" class="custom-select">
            <option
              v-for="(treatType, index) in treatmentTypes"
              :kay="index"
              :value="treatType.id"
            >
              {{ treatType.title }}
            </option>
          </select>

          <label for="doctors"> {{ $t("roomdoctor") }} </label>
          <select v-model="formData.user_id" class="custom-select">
            <option
              v-for="(doctor, index) in doctors"
              :kay="index"
              :value="doctor.id"
            >
              {{ doctor.id }}
            </option>
          </select>
          <label for="doctors"> {{ $t("room") }} </label>
          <select v-model="formData.room_id" class="custom-select">
            <option
              v-for="(room, index) in rooms"
              :kay="index"
              :value="room.id"
            >
              {{ room.title }}
            </option>
          </select>
        </div>

        <v-btn
          type="submit"
          class="mt-2 seed"
          style="width: 606px; padding: 10px"
        >
          {{ $t("submit") }}
        </v-btn>
      </v-form>

      <!-- ... existing code ... -->
    </div>
  </v-card>
</template>

<script>
import axios from "axios";
export default {
  components: {},
  data() {
    return {
      // ... existing data properties ...
      isSuccessModalOpen: false,
      title: "",
      selectedValue: "",
      doctors: [],
      programtypes: [],
      programsystems: [],
      treatmentTypes: [],
      assessment: [],
      appointmentTypes: [],
      sessionTypes: [],

      rooms: [],
      roomType: "",
      formData: {
        title: "",
        program_type_id: "",
        program_system_id: "",
        treatment_type_id: "",
        appointment_type_id: "",
        session_type_id: "",
        assessment_type_id: "",
        user_id: "",
        room_id: "",
        price: "",
      },
    };
  },
  methods: {
    // ... existing methods ...
    getAllDoctor() {
      axios
        .get("api/all/doctors")
        .then((response) => {
          this.doctors = response.data.doctors;
          console.log(this.doctors);
        })
        .catch((error) => {
          console.error("Error retrieving doctors:", error);
        });
    },
    getProgramType() {
      axios
        .get("api/programtypes")
        .then((response) => {
          this.programtypes = response.data.programtype;
          console.log(this.programtypes);
        })
        .catch((error) => {
          console.error("Error retrieving program types:", error);
        });
    },
    getProgramSystem() {
      axios
        .get("api/program-system")
        .then((response) => {
          this.programsystems = response.data.programsystems;
          console.log(this.programsystem);
        })
        .catch((error) => {
          console.error("Error retrieving doctors:", error);
        });
    },
    getTypesesstion() {
      axios
        .get("api/session-types")
        .then((response) => {
          this.sessionTypes = response.data.sessionTypes;
          console.log(this.sessionTypes);
        })
        .catch((error) => {
          console.error("Error retrieving doctors:", error);
        });
    },
    getAssessment() {
      axios
        .get("api/assessment-types")
        .then((response) => {
          this.assessment = response.data.assessment;
          console.log(this.assessment);
        })
        .catch((error) => {
          console.error("Error retrieving assessment:", error);
        });
    },
    getAppointmentTypes() {
      axios
        .get("api/appointmenttypes")
        .then((response) => {
          this.appointmentTypes = response.data.appointmentTypes;
          console.log(this.appointmentTypes);
        })
        .catch((error) => {
          console.error("Error retrieving Appointment Types:", error);
        });
    },
    getTreatmentTypes() {
      axios
        .get("api/treatment-types")
        .then((response) => {
          this.treatmentTypes = response.data.treatmentTypes;
          console.log(this.treatmentTypes);
        })
        .catch((error) => {
          console.error("Error retrieving Appointment Types:", error);
        });
    },

    seedData() {
      // Perform any necessary validation before seeding
      const dataToSeed = {
        title: this.formData.title,
        price: this.formData.price,
        program_type_id: this.formData.program_type_id,
        program_system_id: this.formData.program_system_id,
        treatment_type_id: this.formData.treatment_type_id,
        appointment_type_id: this.formData.appointment_type_id,
        session_type_id: this.formData.session_type_id,
        user_id: this.formData.user_id,
        room_id: this.formData.room_id,
      };

      // Make an API request to seed the data
      axios
        .post("/api/treatments", dataToSeed)
        .then((res) => {
          console.log("Data seeded successfully:", res.data);
          this.isSuccessModalOpen = true;
          // Optionally, you can update your component state or perform other actions here
        })
        .catch((error) => {
          console.error("Error seeding data:", error);
          // Optionally, show an error message or perform other error-handling actions
        });
    },
    getParents() {
      axios.get("/api/getrome_data").then((res) => {
        this.rooms = res.data.parents;
        console.log(res.data.parents);
      });
    },
    closeSuccessModal() {
      this.isSuccessModalOpen = false;
    },
  },
  mounted() {
    this.getAppointmentTypes();
    this.getProgramType();
    this.getProgramSystem();
    this.getAssessment();
    this.getParents();
    this.getAllDoctor();
    this.getTreatmentTypes();
    this.getTypesesstion();
  },
};
</script>

<style scoped>
/* Add custom styles for the name input field */
.name-input {
  width: 100%;
  position: relative;
  background-color: #f8f8f8;
  padding: 10px;
  margin: 25px;
  border-radius: 10px;
}

.name-input {
  width: 606px;
}
.name-input input {
  width: 606px;
  border: none;
  padding: 10px;
  margin: 25px;
  background-color: #f8f8f8;
  border-bottom: 1px solid #135c65; /* Border color for bottom line */
}
.name-input label {
  display: block; /* Ensures the label takes the full width of the container */
  text-align: center;
  font-size: 20px;
  color: #0b0c0c; /* Text color for label */
  border-bottom: 1px solid #333; /* Border style and color */
}
.seed {
  background-color: #135c65;
  display: block;
  color: white;

  width: 606px;
  width: 500px; /* Set the width to 606px */
}
.custom-select {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  background-color: #f8f8f8;
  color: #333;
  appearance: none; /* Remove default arrow in some browsers */
  -webkit-appearance: none; /* Remove default arrow in Chrome and Safari */
  cursor: pointer;
  transition: border-color 0.3s, box-shadow 0.3s;
}

.custom-select:hover {
  border-color: #666;
}

.custom-select:focus {
  outline: none;
  border-color: #135c65;
  box-shadow: 0 0 8px rgba(19, 92, 101, 0.5);
}
#selectOption {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 606px; /* Adjust the width as needed */
  cursor: pointer;
  appearance: none;
  background: url('data:image/svg+xml;utf8,<svg fill="%23444" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z" /><path d="M0 0h24v24H0z" fill="none"/></svg>')
    no-repeat right 10px center/15px auto;
}

#selectOption:focus {
  outline: none;
  border-color: #135c65;
  box-shadow: 0 0 8px rgba(19, 92, 101, 0.5);
}
#selectOption option {
  text-align: center;
  font-size: 20px;
  color: #0b0c0c;
}
#selectOption option:last-child {
  text-align: center;
  font-size: 20px;
  color: #0b0c0c;
}
#selectOption option:hover {
  text-align: center;
  font-size: 20px;
  color: #0b0c0c;
}
/* Add any other custom styles here */
</style>
