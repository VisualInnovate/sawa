<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 class="mb-1">{{ $t("ProgramType") }}</h2>

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
              >{{ $t("SystemProgram") }}</v-btn
            >
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
            <h2 class="mb-1">{{ $t("addProgramType") }}</h2>
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
            <v-btn @click="closeForm" class="" elevation="2">
              {{ $t("Cancel") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-data-table :headers="header" :items="programtype" :search="search">
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
                >mdi-plus-box</v-icon
              >
              <v-icon
                small
                color="primary"
                class="mx-3"
                @click="editItem(item.columns.id)"
                >mdi-pencil</v-icon
              >
              <v-icon
                small
                color="error mx-3"
                @click="deleteItem(item.columns.id)"
                >mdi-delete</v-icon
              >
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
      programtype: [],
      loading: true,
      showDialog: false,
      formData: {
        title: "",
        // Add other form fields as needed
      },
    };
  },
  methods: {
    getprogramtype() {
      axios.get("/api/programtypes").then((res) => {
        this.programtype = res.data.programtype;
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
        .post("/api/programtypes", this.formData)
        .then((res) => {
          // Handle success, e.g., show a success message
          console.log("Item saved successfully");
          // Close the form dialog
          this.closeForm();
          // Refresh the program types list
          this.getprogramtype();
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
    this.getprogramtype();
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

.submit-button:hover {
  background-color: #1565c0; /* Darker shade of blue on hover */
}

.cancel-button {
  color: #757575; /* Gray color */
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-right: 8px; /* Add some spacing between buttons */
}
.cancel-button {
  color: #fff; /* White text */
  background-color: #757575; /* Gray background color */
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: background-color 0.3s ease;
}

.cancel-button:hover {
  background-color: #616161; /* Darker gray background on hover */
}
/* Add any custom styles here */
</style>
