<template>
  <div>
    <!-- ... existing code ... -->

    <v-form @submit.prevent="createRoom">
      <!-- ... existing code ... -->

      <div class="name-input">
        <label for="title"> {{ $t("room") }} </label>
        <v-text-field v-model="title" hide-details></v-text-field>

        <label for="selectedValue"> {{ $t("typesessaion") }}</label>
        <select v-model="selectedValue" class="custom-select">
        <option v-for="option in doctors" :key="option.value" :value="option.value">
          {{ option.name }}
        </option>
        </select>

        <label for="doctors"> {{ $t("roomdoctor") }} </label>
        <select v-model="doctors" class="custom-select">
          <option
            v-for="doctor in doctors"
            :key="doctor.value"
            :value="doctor.value"
          >
            {{ doctor.label }}
          </option>
        </select>

        <label for="roomType"> {{ $t("typeroom") }} </label>
        <select v-model="roomType" class="custom-select">
          <option value="1">{{ $t("typeroom1") }}</option>
          <option value="2">{{ $t("typeroom2") }}</option>
        </select>
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

      title: "",
      selectedValue: "",
      doctors: [],
      roomType: "",
    };
  },
  methods: {
    // ... existing methods ...

    getAllDoctore() {
      axios
        .get("/api/doctors")
        .then((res) => {
          // Assuming the response is an array of doctors with 'id' and 'name' properties
          this.doctors = res.data.map(doctor => ({
            value: doctor.id,
            label: doctor.name,
          }));
        })
        .catch((error) => {
          console.error("Error retrieving doctors:", error);
        });
    },


    createRoom() {
      const roomData = {
        title: this.title,
        capacity: 10,
        roomtype: this.roomType,
        // Add other room properties
      };

      axios
        .post("/api/store_room", roomData)
        .then((res) => {
          console.log("Room created successfully:", res.data);
          // You might want to update your component state or perform other actions here
        })
        .catch((error) => {
          console.error("Error creating room:", error);
          // You might want to show an error message or perform other error-handling actions
        });
    },
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
  padding:1cm;
}

.name-input {
  width: 606px;
}
.name-input input {
  width: 606px;
  border: none;
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
  width: 500px;/* Set the width to 606px */
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
/* Add any other custom styles here */
</style>
