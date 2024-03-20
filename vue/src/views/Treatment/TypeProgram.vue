<template>
  <div>
    <div>
      <!-- Your existing template code here -->
    </div>
    <v-snackbar v-model="alert.show" :color="alert.type" :style="{ top: '0' }">
      {{ alert.message }}
    </v-snackbar>
    <v-card>
      <confirm-dialog @confirmed="deleteItem" ref="confirmDialog" />
      <v-card-title>
        <h2 class="mb-1">{{ $t("ProgramType") }}</h2>

        <v-row class="mb-3">
          <v-col cols="12" sm="6" md="4">
            <v-text-field v-model="search" label="Search" outlined hide-details></v-text-field>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-btn @click="openForm" style="background-color: #4caf50; color: white; font-weight: bold">{{
              $t("addProgramType") }}</v-btn>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <router-link :to="{ name: 'CreateUser' }">
              <v-icon color="success">mdi-plus</v-icon>
            </router-link>
          </v-col>
        </v-row>
      </v-card-title>
      <v-dialog v-model="showDialog" class="form-adds" max-width="600">
        <v-card class="form-all" style="border-radius: 15px; ">
          <v-card-title>

            <h2 class="mb-1">{{ $t("addProgramType") }}</h2>
          </v-card-title>
          <v-card-text>
            <v-text-field v-model="formData.title" :label="$t('title')" outlined required></v-text-field>
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
          <tr v-if="item.columns">
            <td>{{ item.columns.id }}</td>
            <td>{{ item.columns.title }}</td>
            <td>

              <v-icon small color="primary" class="mx-3" @click="showItem(item.columns.id)">
                mdi-plus-box
              </v-icon>
              <v-icon small color="primary" class="mx-3" @click="editItem(item.columns.id)">mdi-pencil</v-icon>
              <v-icon small color="error mx-3" @click="detailsItem(item.columns.id)">mdi-delete</v-icon>
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
    <template>
      <v-dialog v-model="dialog" max-width="400">
        <v-card>
          <v-card-title class="headline">Confirmation</v-card-title>
          <v-card-text>
            Are you sure you want to delete this item?
            {{ showdata }}

          </v-card-text>
          <v-card-actions>
            <v-btn @click="dialog = false" color="primary"> Cancel </v-btn>
            <v-btn @click="deleteItem(showdata)" color="error"> Confirm </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-model="editdialog" max-width="400">
        <v-card>
          <v-card-title class="headline">Confirmation</v-card-title>
          <v-card-text>
            Are you sure you want to edit this item?
            {{ editdata }}
          </v-card-text>
          <v-card-actions>
            <v-btn @click="editdialog = false" color="primary"> Cancel </v-btn>
            <v-btn @click="editItem(editdata)" color="error"> Confirm </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-model="readDate" max-width="600" max-height="400">

        <v-card>
          <v-card-title>
            <h2 class="mb-1">{{ $t("editProgramType") }}</h2>
          </v-card-title>
          <v-card-text>
            <h2> {{ $t("title") }} : {{ editFormData.title }}</h2>
            <h3>{{ editFormData.created_at }}</h3>

            <!-- Add other form fields as needed -->
          </v-card-text>
          <v-card-actions>
            <v-btn @click="updateItem(editFormData.id)" class="submit-button" elevation="2">
              {{ $t("update") }}
            </v-btn>
            <v-btn @click="closeEditFormedit" class="cancel-button" elevation="2">
              {{ $t("Cancel") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="isEditing" max-width="600">

        <v-card>
          <v-card-title>
            <h2 class="mb-1">{{ $t("editProgramType") }}</h2>
          </v-card-title>
          <v-card-text>
            <v-text-field v-model="editFormData.title" :label="$t('title')" outlined required></v-text-field>
            <!-- Add other form fields as needed -->
          </v-card-text>
          <v-card-actions>
            <v-btn @click="updateItem(editFormData.id)" class="submit-button" elevation="2">
              {{ $t("update") }}
            </v-btn>
            <v-btn @click="closeEditForm" class="cancel-button" elevation="2">
              {{ $t("Cancel") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
  </div>
</template>

<script>
import axios from "axios";
import ConfirmDialog from "@/components/ConfirmDialog.vue";
export default {
  components: {
    ConfirmDialog,
  },
  data() {
    return {
      search: "",
      dialog: false,
      showdata: "",
      itemDetails: {},
      successMessage: '',
      readDate: false,


      alert: {
        show: false,
        type: "success", // You can customize the alert color
        message: "",
      },
      title: "Confirmation",
      headers: [
        { key: "id", title: this.$t("index") },
        { key: "title", title: this.$t("title") },
      ],
      programtype: [],
      loading: true,
      showDialog: false,

      isEditing: false, // Changed from editDialog
      editFormData: {
        title: "",
        // Add other form fields as needed
      },
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
    closeEditFormedit() {
      this.readDate = false;
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
          this.setSuccessMessage('Item deleted successfully!');
          // Refresh the program types list
          this.getprogramtype();
        })
        .catch((error) => {
          // Handle error, e.g., show an error message
          console.error("Error saving item:", error);
        });
    },
    openDialog() {
      this.dialog = true;
    },

    confirm() {
      this.$emit("confirmed");
      this.dialog = false;
    },
    async deleteItem(id) {
      try {
        if (this.showdata) {
          this.showAlert({
            type: "warning", // Alert type can be "success", "info", "warning", "error"
            message: "Your custom alert message here",
          });
          this.dialog = false;
        }

        // User confirmed the deletion
        await axios.delete(`/api/programtypes/${id}`);
        console.log("Item deleted successfully");

        // Show a success alert
        this.showAlert({
          type: "success",
          message: "Item deleted successfully",
        });

        this.getprogramtype();
      } catch (error) {
        // Handle error, e.g., show an error message
        this.showAlert({
          type: "error",
          message: `Error deleting item: ${error.message}`,
        });
        console.error("Error deleting item:", error);
      }
    },

    showAlert({ type, message }) {
      // Set the alert properties
      this.alert.type = type;
      this.alert.message = message;
      this.alert.show = true;
    },

    async detailsItem(id) {
      try {
        this.showdata = `${id}`;
        this.dialog = true;
        await axios.get(`/api/programtypes/${id}`);
        console.log(id);
      } catch (err) { }
    },

    async showItem(id) {

      try {
        // Fetch item details using the provided ID
        const response = await axios.get(`/api/programtypes/${id}`);

        // Set the item details and show the dialog
        this.editFormData = response.data.program_type;
        this.readDate = true;
      } catch (error) {
        console.error('Error fetching item details:', error);
      }
    },
    hideDialog() {
      // Close the dialog
      this.showDialog = false;
    },

    // ... other methods ...

    async editItem(id) {

      const response = await axios.get(`/api/programtypes/${id}`);
      console.log(response);

      this.editFormData = response.data.program_type;
      this.isEditing = true;



      // Check if the selectedItem is defined

    },
    updateItem(id) {
      // Perform any necessary validation before updating
      // Then make an API request to update the form data
      // Get the ID from editFormData

      // Create an object containing the fields to update
      const updatedFields = {
        title: this.editFormData.title,
        // Add other fields as needed
      };

      axios
        .put(`/api/programtypes/${id}`, updatedFields)
        .then((res) => {
          // Handle success, e.g., show a success message
          console.log("Item updated successfully");
          this.editdialog = false;
          // Close the edit form dialog

          // Refresh the program types list
          this.getprogramtype();
        })
        .catch((error) => {
          // Log the specific error message from the response
          console.error("Error updating item:", error.response.data.message);

          // Log the entire response for further inspection
          console.log("Full response:", error.response);

          // Show a more specific error message to the user
          this.showAlert({
            type: "error",
            message: `Failed to update item. ${error.response.data.message}`,
          });
        });
    },
    closeEditForm() {
      // Reset edit form data when the dialog is closed
      this.editFormData = {
        id: null,
        title: "",
        // Reset other form fields as needed
      };

      // Close the edit form dialog
      this.isEditing = false; // Changed from editDialog
    },
    setSuccessMessage(message) {
      console.log('Setting success message:', message);
      this.successMessage = message;
      setTimeout(() => {
        console.log('Clearing success message');
        this.successMessage = '';
      }, 3000);
    }
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

/* Add any custom styles here */
</style>
