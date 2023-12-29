<template>
    <v-dialog v-model="dialog" max-width="400">
      <v-card>
        <v-card-title class="headline">{{ title }}</v-card-title>
        <v-card-text>{{ message }}</v-card-text>
        <v-card-actions>
          <v-btn @click="dialog = false" color="primary" outlined>
            Cancel
          </v-btn>
          <v-btn @click="confirm" color="error">
            Confirm
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  
  <script>
  export default {
    data() {
      return {
        dialog: false,
        title: "Confirmation",
        message: "Are you sure you want to perform this action?",
      };
    },
    methods: {
      openDialog({ title = "Confirmation", message = "" } = {}) {
        this.title = title;
        this.message = message;
        this.dialog = true;
      },
      confirm() {
        this.$emit('confirmed');
        this.dialog = false;
      },
    },
  };
  </script>
  
  <style scoped>
  .v-card {
    background-color: #ffffff;
    width: 500px;
    padding: 20px;
    height: 200px;
  }
  
  .v-card-title {
    color: #1e88e5; /* Primary color */
  }
  
  .v-card-actions {
    justify-content: flex-end;
  }
  
  .v-btn {
    margin-left: 8px;
  }
  </style>
  