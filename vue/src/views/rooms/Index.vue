<template>
  <div class="container">
    <!-- Header Section -->
    <div class="header">
      <div class="paragraph">
        <h2>{{ $t("roomnumber") }}</h2>
        <p>{{ $t("RoomAc") }}</p>
      </div>
      <div class="search-section">
        <input type="text" v-model="searchQuery" placeholder="Search..." class="search-input" />
        <v-icon color="success" size="40" @click="performSearch()" class="icon-border">mdi-magnify</v-icon>
      </div>

      <div class="add-data">
        <v-col cols="12" sm="6" md="4" class="create-user-link" @click="navigateToAddRoom">
          <v-icon color="success" size="40" class="icon-border">mdi-plus</v-icon>
          <p>{{ $t("addRoom") }}</p>
        </v-col>
      </div>
    </div>
    <div class="content" v-for="(treatment, index) in roomssearchQuery" :key="index">
      <div class="first-div">
        <i class="fas fa-user"></i> <!-- This is the Font Awesome user icon -->
        <h5>{{ $t("numberroom") }} :{{ treatment.title }}</h5>
        <p>{{ $t("ProgramType") }}: {{ treatment.treatment_type.title }}</p>
      </div>
      <div class="second-div" >

        <p>{{ $t("drtitle") }} {{ treatment.user.title }}</p>

        <v-icon small color="primary mx-3">mdi-account-group</v-icon>
        0/ {{ treatment.capacity }}
      </div>

      <div class="third-div">
        <!-- Content for the third div -->
        <v-icon small color="primary" class="mx-3" @click="editItem(treatment.id)">mdi-pencil</v-icon>
        <v-icon small color="error mx-3" @click="deleteItem(treatment.id)">mdi-delete</v-icon>
      </div>

    </div>
    <!-- Rest of your component -->

  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      searchQuery: "",
      headers: [5],
      rooms: [],
      page: 1,
      showModal: false,
      // other data properties
    };
  },
  computed:
     {
      roomss()
      {
        return ` ${this.this.rooms}`; 
      },
      roomssearchQuery()
      {
        return this.rooms.filter((st) => st.title.match(this.searchQuery));
      },
     },
  methods: {
    
    navigateToAddRoom() {
      // Navigate to the add room route
      this.$router.push({ name: 'CreateRoom' });
    },

    deleteItem(id) {
      axios.delete('/api/destroy/room/' + id)
        .then(response => {
          console.log('Item deleted successfully:', response.data);
          this.showAlert = true;
          this.alertMessage = 'Room deleted successfully!';
          this.get();

          // Auto-hide the alert after 3 seconds (adjust as needed)

          this.showAlert({
            type: "success",
            message: "Item deleted successfully",
          });
        })
        .catch(error => {
          console.error('Error deleting item:', error);
        });
    },
    getAllRoom() {
      axios.get(`api/getrome_data`).then((response) => {
        this.rooms = response.data.rooms;
        console.log(this.rooms);
      });
    },
    editItem(itemId) {
      // Assuming you have a route named 'EditRoom' that takes an 'id' parameter
      this.$router.push({ name: 'EditRoom', params: { id: itemId } });
    }
  },

  mounted() {

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
</style>
