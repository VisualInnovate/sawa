<template>
  <div>
    <!-- ... existing code ... -->

    <v-form @submit.prevent="createRoom">
      <!-- ... existing code ... -->

      <div class="name-input">
        <label for="title"> {{ $t("room") }} </label>
        <v-text-field v-model="formData.title" hide-details></v-text-field>

        <label for="selectedValue"> {{ $t("typesessaion") }}</label>
        <select v-model="session" class="custom-select">
          <option v-for="(option, index) in sessionTypes" :key="index.value" :value="option.value">
            {{ option.title }}
          </option>
        </select>
        <label for="doctors"> {{ $t("Typetreatment") }} </label>
        <select v-model="formData.treatment_id" class="custom-select">
          <option v-for="(treatType, index) in treatmentTypes" :kay="index" :value="treatType.id">
            {{ treatType.title }}
          </option>
        </select>
        <label for="doctors"> {{ $t("roomdoctor") }} </label>
        <select v-model="formData.user_id" class="custom-select">
          <option v-for="(doctor, index) in doctors" :kay="index" :value="doctor.id">
            {{ doctor.title }}
          </option>
        </select>

        <label for="roomType"> {{ $t("typeroom") }} </label>
        <select v-model="formData.room_type_id" class="custom-select">
          <option value="1">{{ $t("typeroom1") }}</option>
          <option value="2">{{ $t("typeroom2") }}</option>
        </select>

        <div class="input-container">
          <label for="roomType" class="input-label">{{ $t("typeroom") }}</label>
          <input type="number" id="roomType" v-model="formData.capacity" class="number-input" />
        </div>
      </div>
      <v-btn type="submit" class="mt-2 seed" style="width: 606px;">
        {{ $t("submit") }}
      </v-btn>
    </v-form>

    <!-- ... existing code ... -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      // ... existing data properties ...


      selectedValue: "",
      sessionTypes: [],
      treatmentTypes: [],
      doctors: [],
      roomType: "",
      formData: {
        title: "",
        capacity: "",
        room_type_id: "",
        session: "",
        user_id: "",
        treatment_id: ""

      }
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
    createRoom() {
      const DataSend = {
        title: this.formData.title,
        user_id: this.formData.user_id,
        capacity: this.formData.capacity,
        session: this.formData.session,
        room_type_id: this.formData.room_type_id,
        treatment_id: this.formData.treatment_id,

      };
      axios
        .post("/api/store_room", DataSend)
        .then((responseData) => {
          
          console.log("this add data is sussec:", responseData);
          this.$router.push({ name: 'Rooms' });
        })
        .catch((error) => {
          console.error("Error seeding data:", error);
          // Optionally, show an error message or perform other error-handling actions
        });
    }

  },
  mounted() {
    this.getTypesesstion();
    this.getAllDoctor();
    this.getTreatmentTypes();
  },
  // ... existing code ...
};
</script>

<style scoped>
/* Add custom styles for the name input field */
.name-input {
  width: 100%;
  position: relative;
  background-color: #f8f8f8;
  padding: 1cm;
}

.name-input {
  width: 606px;
}

.name-input input {
  width: 606px;
  border: none;
  border-bottom: 1px solid #135c65;
  /* Border color for bottom line */
}

.name-input label {
  display: block;
  /* Ensures the label takes the full width of the container */
  text-align: center;
  font-size: 20px;
  color: #0b0c0c;
  /* Text color for label */
  border-bottom: 1px solid #333;
  /* Border style and color */
}

.seed {
  background-color: #135c65;
  display: block;
  color: white;

  width: 606px;
  width: 500px;
  /* Set the width to 606px */
}

.custom-select {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  background-color: #f8f8f8;
  color: #333;
  appearance: none;
  /* Remove default arrow in some browsers */
  -webkit-appearance: none;
  /* Remove default arrow in Chrome and Safari */
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

.number-input {
  width: 500px;
}

/* Add any other custom styles here */
</style>
