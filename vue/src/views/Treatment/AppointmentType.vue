<template>
  <div class=" lg:w-[80%] m-auto">
    <!-- Header Section -->
    <v-dialog v-model="showDialog" class="form-adds" max-width="600">
      <v-card class="form-all" style="border-radius: 15px; ">
        <v-card-title>
          <h2 class="mb-1">{{ $t("AppointmentType") }}</h2>
        </v-card-title>
        <InputText class="w-[90%] m-auto" type="text" v-model="formData.title" :placeholder='$t("title")' />
      
        <v-card-actions>
          <v-btn @click="saveItem" class="submit-button" elevation="2">
            {{ $t("submit") }}
          </v-btn>
          <v-btn @click="closeForm" class="" elevation="2">
            {{ $t("Cancel") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="showModal" class="form-adds" max-width="600">
      <v-card class="form-all" style="border-radius: 15px; ">
        <v-card-title>
          <h2 class="mb-1">{{ $t("AppointmentType") }}</h2>
        </v-card-title>
        <InputText class="w-[90%] m-auto" type="text" v-model="formData.title" :placeholder='$t("title")' />
      
        <v-card-actions>
          <v-btn @click="update" class="submit-button" elevation="2">
            {{ $t("submit") }}
          </v-btn>
          <v-btn @click="showModal = false" class="" elevation="2">
            {{ $t("Cancel") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 shadow mb-4 p-4">
      <div class="paragraph text-2xl">
        <h2>{{ $t("Appointment_type") }}</h2>
        <p>{{ $t("AppointmentAc") }}</p>
      </div>
    <div class="relative ">
       <i class="pi pi-search absolute top-[20%] right-[5%] font-bold cursor-pointer"  @click="performSearch()"/>
       <InputText style="text-align: center;" class="lg:w-full" v-model="searchQuery" placeholder="Search" />
    </div>
     

      <div  @click="openForm()" class=" m-auto ">
   
         
       <div style=" margin: auto; border: 2px solid #135C65; " class="py-2 rounded-full w-[50%] h-[50%]">
  
<svg style="margin: auto;" xmlns="http://www.w3.org/2000/svg" width="23.391" height="26.316" viewBox="0 0 23.391 26.316">
  <path id="plus" d="M17.495,19.12V29.354a1.388,1.388,0,0,1-1.3,1.462,1.388,1.388,0,0,1-1.3-1.462V19.12H5.8a1.472,1.472,0,0,1,0-2.924h9.1V5.962A1.388,1.388,0,0,1,16.2,4.5a1.388,1.388,0,0,1,1.3,1.462V16.2h9.1a1.472,1.472,0,0,1,0,2.924Z" transform="translate(-4.5 -4.5)" fill="#148a98" fill-rule="evenodd"/>
</svg>

       </div>

          <p class="m-auto cursor-pointer text-xl w-full">{{ $t("add_Appointment") }}</p>
    
      </div>
    </div>
    <div   v-for="room in roomssearchQuery" class=" flex justify-between  hover:bg-[#dbebf5] rounded-md py-8 my-2 bg-[#F8F8F8]">

       
<div class="m-auto flex w-[50%]">

  <div class="px-3 ">
   
   
     <p class="text-lg font-bold">{{ room.title }}</p> 
   
    <div>
      <p class="font-bold text-[#135C65]">{{ room.treatment_type?.title }}</p>
    </div>
  </div>
</div>

<div class="m-auto ">
  <v-icon small color="error" @click="deleteItem(room.id)"
              >mdi-delete</v-icon
            >
            <v-icon
              small
              color="primary"
              class="mr-2"
              @click="editItem(room.id)"
              >mdi-pencil</v-icon
    >
</div>
</div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2';
import 'primeicons/primeicons.css'
import InputText from 'primevue/inputtext';
import Pagination from '../../components/Pagination.vue'
export default {
  components: {
    Pagination,InputText
  },
  data() {

    return {
      currentPage: 5,
      currentPage: 1,
      pageSize: 10,
      items: [],
      appointmen_id:'',

      searchQuery: "",
      rooms: [],
      sessionTypes: [],
      showDialog: false,
      showModal: false,
      id: "",
      formData:
      {
        title: "",

      }
      // other data properties
    };
  },
  computed:
  {
    roomss() {
      return ` ${this.this.sessionTypes}`;
    },
    roomssearchQuery() {
      return this.sessionTypes.filter((st) => st.title.match(this.searchQuery));
    },
  },
  methods: {

    deleteItem(id) {
      axios.delete(`/api/appointmenttypes/${id}`, this.formData)
        .then(response => {
          console.log('Item deleted successfully:', response.data);
          Swal.fire(
            'تم الحذف بنجاح!',
            'Your treatment has been deleted.',
            'success'
          );

          // Find the index of the treatment in the treatments array
          const index = this.sessionTypes.findIndex(sessionType => sessionType.id === id);

          // Remove the treatment from the array if it exists
          if (index !== -1) {
            this.sessionTypes.splice(index, 1);
          }

        }).catch(error => {
          // Handle any errors here
          console.error("There was an error deleting the treatment: ", error);
          Swal.fire(
            'Error!',
            'There was a problem deleting your treatment.',
            'error'
          );
        });
    },
    getOneSession(id) {
      axios.get(`api/appointmenttypes/${id}`)
        .then((response) => {
          // Assuming the response data has the structure { program_type: { title: '...' } }
          this.formData.title = response.data.appointmentTypes.title;
          this.id = response.data.appointmentTypes.id;

        })
        .catch((error) => {
          console.error('Error fetching session type:', error);
          // Handle the error (e.g., show an error message to the user)
        });

    },
    getAllRoom() {
      axios.get(`api/appointmenttypes`).then((response) => {
        this.sessionTypes = response.data.appointmentTypes;
        this.items = Array.from({ length: 50 }, (_, i) => ({ id: i + 1, name: `Item ${i + 1}` }));
        console.log(this.sessionTypes);
      });
    },
    update(){
      axios.put(`api/appointmenttypes/${this.appointmen_id}`,this.formData).then(() => {
        this.getAllRoom()
      this.showModal=false
        
      });
      

    }, 
    editItem(itemId) {
      // Assuming you have a route named 'EditRoom' that takes an 'id' parameter
      this.showModal= true,
      this.appointmen_id=itemId
      axios.get(`api/appointmenttypes/${itemId}`).then((response) => {
        this.formData.title=response.data.program_type.title
        
      });
    },
    handlePageChange(page) {
      this.currentPage = page;
    },
    openForm() {
      this.showDialog = true;
    },
    closeForm() {
      this.showDialog = false;
      // Reset form data when the dialog is closed
      this.formData = {
        title: "",
        // Reset other form fields as needed
      };
    },
    saveItem() {
      // Perform any necessary validation before saving

      // Make an API request to save the form data
      axios.post("/api/appointmenttypes", this.formData)
        .then((res) => {
          // Handle success, e.g., show a success message
          console.log("Item saved successfully");
          // Close the form dialog
          this.closeForm();
          // Refresh the program types list
          this.getAllRoom();
          // Reset validation errors on successful save
          this.validationErrors = {};
          // Optionally, show a success message to the user
          this.showAlert({
            type: "success",
            message: "Item saved successfully.",
          });
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            // Handle validation errors
            this.validationErrors = error.response.data.errors;
          } else {
            // Handle other errors
            console.error('Error saving item:', error);
            // Optionally, show an error message to the user
            this.showAlert({
              type: "error",
              message: "Failed to save item. Please try again.",
            });
          }
        });
    },
  },

  mounted() {
    const sessionId = this.$route.params.id; // Replace this with the actual session ID you want to fetch
    this.getOneSession(sessionId);
    this.getAllRoom();
  },


};
</script>
<style scoped>
.container {
  /* max-width: 1000px; */
  margin: auto;
  padding: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #ffffff;
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-section {
  display: flex;
  align-items: center;
  background-color: #ffffff;
  border-radius: 25px;
  padding: 10px;
  border-color: #000;
}

.search-input {
  border: none;
  outline: none;
  padding: 10px;
  border-radius: 20px;
  flex-grow: 1;
  /* Make the input expand to fill the space */
  font-size: 16px;
  width: 500px;
}

.search-button {
  background: none;
  border: none;
  padding: 10px;
  cursor: pointer;
  color: #555;
  /* Adjust the color as needed */
  display: flex;
  align-items: center;

}

.search-button:hover {
  color: #ffffff;
  /* Change color on hover for visual feedback */
}

.material-icons {
  font-size: 24px;
}

/* Optional: Hide the default clear button in some browsers */
.search-input::-ms-clear,
.search-input::-webkit-search-cancel-button {
  display: none;
}

.paragraph p {
  color: #29ccff;
}

.contant {
  display: flex;
  margin-top: 15px;
  background-color: #7A7A7A;
  height: 200px;
  padding: 20px;

  margin-bottom: 20px;

}

.contant h6 {
  font-size: 22px;
  color: #148a98;
}

.contant p {
  color: #000;
  font-size: 20px;
}

h5 {
  padding: 10px;
  color: #148a98;
}

.app-dev {
  display: flex;
  justify-content: space-between;
  /* Align children at the start and end */
  /* Align children vertically */
  gap: 20px;
  /* Space between children */
  padding: 10px;
  /* Padding around the container */
}

.app-dev .left {
  margin: 0cm 20cm 0cm 0cm;
  color: #148a98;
}

.app-dev .left p {

  color: #148a98;
}

@media only screen and (max-width: 600px) {
  .app-dev {
    flex-direction: column;
  }

  .search-input {
    width: 100%;
  }

  .header,
  .add-data,
  .search-section {
    flex-direction: column;
  }
}

@media only screen and (min-width: 601px) {
  .search-input {
    width: auto;
    /* Adjust as necessary */
  }
}

@media only screen and (min-width: 600px) {
  .search-input {
    width: 80%;
    /* Adjust width for larger screens */
  }

  .content {
    display: flex;
    justify-content: space-around;
    /* Evenly space out the divs */
    align-items: center;
    border: 15px solid #ffffff;
    /* A line below each treatment item */
    border-radius: 15px;
    padding: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
    background-color: #d5d5d5;
  }

  .first-div,
  .second-div,
  .third-div {
    flex-basis: 30%;
    /* Each div takes approximately one-third of the width */
    text-align: center;
    /* Center the text inside each div */
  }

  .first-div {
    /* Specific styles for the first div */
  }

  .second-div {
    /* Specific styles for the second div */
  }

  .third-div {
    /* Specific styles for the third div */
  }

}

.form-adds h2 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 10px;
  margin-top: 10px;
  padding: 25px;
  text-align: center;
}

.submit-button {
  background-color: #148A98;
  /* Blue color */
  color: #fff;
  /* White text */
  font-weight: bold;
  margin: 15px;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: background-color 0.3s ease;
  margin-right: 8px;
  /* Add some spacing between buttons */

}



.cancel-button {
  color: #757575;
  /* Gray color */
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-right: 8px;
  /* Add some spacing between buttons */
}

.cancel-button {
  color: #fff;
  /* White text */
  background-color: #757575;
  /* Gray background color */
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: background-color 0.3s ease;
}

.cancel-button:hover {
  background-color: #616161;
  /* Darker gray background on hover */
}

.form-adds {
  width: 1168px;
  height: 376px;

}

.form-all {
  border-radius: 2cm;
}

@media only screen and (min-width: 1200px) {
  .container {
    max-width: 1200px;
    /* or any other max-width you prefer */
  }
}

@media only screen and (max-width: 600px) {
  .form-adds {
    width: 100%;
    /* Full width on small screens */
  }
}

@media only screen and (min-width: 601px) {
  .form-adds {
    width: 80%;
    /* Adjust as needed for medium screens */
  }
}

@media only screen and (min-width: 1024px) {
  .form-adds {
    width: 600px;
    /* Fixed width for larger screens */
  }
}
</style>
