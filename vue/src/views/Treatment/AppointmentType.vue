<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 class="mb-1">{{ $t("appointments") }}</h2>

        <v-row class="mb-3">
          <v-col cols="12" sm="6" md="4">
            <v-text-field
              v-model="search"
              label="Search"
              outlined
              hide-details
            ></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-btn
              @click="openForm"
              style="background-color: #4caf50; color: white; font-weight: bold"
            >{{ $t("addappointments") }}</v-btn>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <router-link :to="{ name: 'CreateUser' }">
              <v-icon color="success">mdi-plus</v-icon>
            </router-link>
          </v-col>
        </v-row>
      </v-card-title>
      <v-dialog v-model="showDialog" max-width="600">
        <v-card>
          <v-card-title>
            <h2 class="mb-1">{{ $t("addappointments") }}</h2>
          </v-card-title>
          <v-card-text>
            <v-text-field
              v-model="formData.title"
              :label="$t('title')"
              outlined
              required
            ></v-text-field>
            <!-- Add other form fields as needed -->
          </v-card-text>
          <v-card-actions>
            <v-btn @click="saveItem" class="submit-button" elevation="2">
              {{ $t("submit") }}
            </v-btn>
            <v-btn @click="closeForm" class="cancel-button">
              {{ $t("Cancel") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-snackbar v-model="successSnackbar" color="success" timeout="3000">
        {{ successMessage }}
        <v-btn text @click="successSnackbar = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-snackbar>
      <v-data-table :headers="header" :items="appointments" :search="search">
        <template #item="{ item }">
          <tr>
            <td>{{ item.columns.id }}</td>
            <td>{{ item.columns.title }}</td>
            <td>
              <v-icon
                small
                color="primary"
                class="mx-3"
                @click="showItem(item.columns.id)"
              >mdi-plus-box</v-icon>
              <v-icon
                small
                color="primary"
                class="mx-3"
                @click="editItem(item.columns.id)"
              >mdi-pencil</v-icon>
              <v-icon
                small
                color="error mx-3"
                @click="deleteItem(item.columns.id)"
              >mdi-delete</v-icon>
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      search: "",
      headers: [
        { key: "id", title: this.$t("index") },
        { key: "title", title: this.$t("title") },
      ],
      appointments: [],
      loading: true,
      showDialog: false,
      formData: {
        title: "",
        // Add other form fields as needed
      },
      successSnackbar: false,
      successMessage: "",
    };
  },
  methods: {
    getappointments() {
      axios.get("/api/appointmenttypes").then((res) => {
        this.appointments = res.data.appointments;
        this.loading = false;
      });
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
      // Then make an API request to save the form data
      axios
        .post("/api/appointmenttypes", this.formData)
        .then((res) => {
          // Handle success
          console.log("Item saved successfully");

          // Set success message and show Snackbar
          this.successMessage = "Item saved successfully";
          this.successSnackbar = true;

          // Close the form dialog
          this.closeForm();

          // Refresh the appointments list
          this.getappointments();
        })
        .catch((error) => {
          // Handle error, e.g., show an error message
          console.error("Error saving item:", error);
        });
    },
  },
  computed: {
    header() {
      return (this.headers = [
        { key: "id", title: this.$t("index") },
        { key: "title", title: this.$t("title") },
      ]);
    },
  },
  mounted() {
    this.getappointments();
  },
};
</script>

<style scoped>
h2 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 10px;
  margin-top: 10px;
  padding: 25px;
}
.submit-button {
  background-color: #2196f3; /* Blue color */
  color: #fff; /* White text */
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: background-color 0.3s ease;
  margin-right: 8px; /* Add some spacing between buttons */
}

.cancel-button:hover {
  background-color: #616161; /* Darker gray background on hover */
}
.success-message {
  position: fixed;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 300px;
  margin-top: 20px;
  z-index: 9999;
}
/* Add any custom styles here */
</style>
