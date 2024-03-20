<template>
    <div>
      <div>
        <p class="text-xl p-4 text-[#135C65] cursor-pointer font-bold" @click="Therapeutic()">{{ $t("addTherapeutic") }}</p>
      </div>
      <div v-if="loading" class="loader"></div>
      <!-- Your existing content goes here -->
    </div>
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
        <v-form class="py-[2%]" ref="myForm" @submit.prevent="seedData">
          <!-- ... existing code ... -->
          <div class="name-input">
            <div class="py-4">      
            <InputText style="margin: auto ; text-align: center;background-color:#e7e7e7; border: none; border-bottom: 2px solid black; " v-model="formData.title"  :placeholder='$t("ProgramName")'  class="w-full "  type="text"   />
          </div>
          <div class="py-4">      
            <InputText style="margin: auto ; text-align: center;background-color:#e7e7e7; border: none; border-bottom: 2px solid black; " v-model="formData.price"  :placeholder='$t("price")'  class="w-full "  type="number"   />
          </div>   
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.session_type_id"  option-value="id" :options="sessionTypes" optionLabel="title" :placeholder='$t("typesessaion")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.program_type_id"  option-value="id" :options="programtypes" optionLabel="title" :placeholder='$t("ProgramType")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.program_system_id"  option-value="id" :options="programsystems" optionLabel="title" :placeholder='$t("SystemProgram")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.appointment_type_id"  option-value="id" :options="appointmentTypes" optionLabel="title" :placeholder='$t("AppointmentType")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.treatment_type_id"  option-value="id" :options="treatmentTypes" optionLabel="title" :placeholder='$t("Typetreatment")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
        
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.user_id"  option-value="id" :options="doctors" optionLabel="title" :placeholder='$t("roomdoctor")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
          <div class="card py-4 flex justify-content-center">
             <Dropdown  id="pv_id_1" style="direction: ltr !important;" v-model="formData.room_id"  option-value="id" :options="rooms" optionLabel="title" :placeholder='$t("room")' class="w-full [&>div>div>span]:bg-black md:w-14rem " />
          </div>
        
          </div>
            <div style="height: 5px ; background-color: rgb(94, 80, 80);width: 5%; margin: auto; border-radius: 10%;" class="my-2"></div>
          <v-btn @click="updateData()" class="mt-2 seed" >
            {{ $t("submit") }}
          </v-btn>
        </v-form>
  
        <!-- ... existing code ... -->
      </div>
    </v-card>
  </template>
  
<script>
import axios from "axios";
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
export default {
    components: {Dropdown,InputText},
    data() {
    return {
      // ... existing data properties ...
      isSuccessModalOpen: false,
      appLang: localStorage.getItem('appLang'), // Get the language from local storage
      title: "",
      selectedValue: "",
      doctors: [],
      loading: false,
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
      errors: {},
      isSubmitting: false,

      // Add other validation rules for the title field
    };

  },

    methods: {
        getallTreateant() {
            axios
                .get("api/allInputData")
                .then((dataOfresponse) => {
                    this.appionment = dataOfresponse.data.appionment;
                    this.treatmenttype = dataOfresponse.data.treatmenttype;
                    this.session = dataOfresponse.data.session;
                    this.programtype = dataOfresponse.data.programtype;
                    this.programsystemt = dataOfresponse.data.programsystemt;
                    this.rooms = dataOfresponse.data.rooms;
                })
                .catch((error) => {
                    console.error("Error retrieving doctors:", error);
                });
        },
        getAllDoctor() {
            axios
                .get("api/all/doctors")
                .then((response) => {
                    this.doctors = response.data.doctors;
                    //console.log(this.doctors);
                })
                .catch((error) => {
                    console.error("Error retrieving doctors:", error);
                });
        },
        getAllRoom() {
            axios.get(`api/getrome_data`).then((response) => {
                this.rooms = response.data.rooms;
                console.log(this.rooms);
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
        updateData() {
            axios
                .put(`/api/treatments/${this.$route.params.id}`, this.formData)
                .then((response) => {
                    // Handle successful response
                    console.log("Data updated:", response.data);
                    this.isSuccessModalOpen = true;

                    // Redirect to the 'all-treatments' route after successful seeding
                    this.$router.push({ name: 'AllTherapeutic' });
                    // Optionally, you can update your component state or perform other actions here
                    // You might want to redirect the user or give a success message
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error updating data:", error);
                    // You might want to show an error message to the user
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

                    setTimeout(() => {
                        this.isSuccessModalOpen = false;
                        this.$router.push({ name: 'AllTherapeutic' });  // Replace with your route
                    }, 10000);


                    // Redirect to the 'all-treatments' route after successful seeding

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
        getOneTreatment(oneTreatment) {

            axios.get(`api/treatments/${oneTreatment}`).then((response) => {
                this.oneTreatment = response.data.oneTreatment;
                this.formData.title = response.data.oneTreatment.title,
                    this.formData.price = response.data.oneTreatment.price,
                    this.formData.program_type_id = response.data.oneTreatment.program_type_id,
                    this.formData.program_system_id = response.data.oneTreatment.program_system_id,
                    this.formData.appointment_type_id = response.data.oneTreatment.appointment_type_id,
                    this.formData.session_type_id = response.data.oneTreatment.session_type_id,
                    this.formData.user_id = response.data.oneTreatment.user_id,
                    this.formData.room_id = response.data.oneTreatment.room_id,
                    this.formData.treatment_type_id = response.data.oneTreatment.treatment_type_id,

                    console.log(this.oneTreatment);
            });
        },
    },


    mounted() {
        this.getTreatmentTypes();
        this.getProgramSystem();
        this.getAppointmentTypes();
        this.getTypesesstion();
        this.getProgramType();
        this.getOneTreatment(this.$route.params.id);
        this.getParents();
        this.getAllDoctor();
        this.getallTreateant();
        this.updateData();
        this.getAllRoom();
        //  console.log(this.$route.params.id);
    },
};
</script>
<style scoped>
/* Add custom styles for the name input field */
.name-input {
  height: 70vh;
  margin: auto !important;
   overflow-y: scroll;
  width: 100%;
  position: relative;
  background-color: #e7e7e7;
  padding: 10px;
  margin-bottom: 15px !important;
  border-radius: 10px;
}
.name-input::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.name-input {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
.name-input {
  width: 606px;
}

.name-input input {
 
  border: none;
  padding: 10px;
  margin: 25px;
  background-color: #f8f8f8;
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

#input-1{
  text-align: center !important;
  background-color:#E4E4E4 !important;
}
#pv_id_1{
  border: none;
  text-align: center;
  background-color:#E7E7E7 !important;
  border-bottom: 2px solid black;
  border-radius: 0 ;
 font-size: 20px;
 padding-top: 3%;
}
#pv_id_1:focus {
  border: none !important;

}

.seed {
  width: 600px;

  margin: auto !important;
  background-color: #135c65;
  display: block;
  color: white;
 

 
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



.loader {
  border: 5px solid #f3f3f3;
  border-top: 5px solid #3498db;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
  margin: 20px auto;
  /* Adjust margin as needed */
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

.error-message {
  display: flex;
  align-items: center;
  color: #ff0000;
  /* Red color for errors */
  margin-top: 5px;
  font-size: 0.9em;
}

.error-icon {
  margin-right: 5px;
  /* Add styles for your error icon */
}

@media (max-width: 768px) {

  .name-input,
  .custom-select,
  .error-message {
    width: 100%;
    /* Full width on smaller screens */
    margin-bottom: 15px;
  }

  .v-btn {
    width: 100%;
    /* Full width button */
    padding: 12px;
    /* Larger touch target */
  }

  .error-message {
    font-size: 0.8em;
    /* Adjust font size */
  }
}

/* Add additional CSS for animation or other styling as needed */

/* Add any other custom styles here */
</style>
