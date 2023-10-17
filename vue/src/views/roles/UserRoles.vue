<script>
import axios from "axios";

export default {
  props: ["id"],
  data() {
    return {
      permissions: [],
      user_permissions: [],
      new_permissions: [],
      checked_permissions: [],
      permission_name: "",
      alert: {
        show: false,
        text: "",
        color: "",
      },
    };
  },
  methods: {
    getPermissions() {
      axios
        .post("/api/permissions", {
          name: this.permission_name,
          name: this.permission_name,
        })
        .then((res) => {
          this.permissions = res.data.permissions.data;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addPermissions() {
      console.log(this.checked_permissions);
      axios
        .post(`/api/users/${this.id}/add-permissions`, {
          roles: this.checked_permissions,
        })
        .then((res) => {
          this.alert.color = "success";
          this.alert.text = res.data.message;
          this.alert.show = true;
          setTimeout(() => {
            this.alert.show = false;
          }, 3000);
          console.log(res);
        })
        .catch((err) => {
          this.alert.color = "error";
          this.alert.text = err.response.data.message;
          this.alert.show = true;
          setTimeout(() => {
            this.alert.show = false;
          }, 3000);
          console.log(err);
        });
    },
    getUserPermissions() {
      axios
        .get(`/api/users/${this.id}/permissions`)
        .then((res) => {
          this.user_permissions = res.data.user_permissions;

          this.user_permissions.forEach((per) => {
            this.checked_permissions[per.id] = per.id;
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    onCheckboxChange(index, e) {
      if (e === true) {
        this.checked_permissions.push(index);
      }
      console.log(index);
      console.log(e);
    },
  },
  mounted() {
    this.getUserPermissions();
    this.getPermissions();
  },
  watch: {
    permission_name() {
      this.getPermissions();
    },
  },
};
</script>

<template>
  <div style="margin: 1.5rem 0; padding: auto 0">
    <v-alert
      :type="alert.color"
      :text="alert.text"
      v-show="alert.show"
    ></v-alert>
    <v-row>
      <v-col sm="12">
        <div>
          <!-- Search Permission -->
          <v-col sm="12" md="6">
            <v-text-field
              v-model="permission_name"
              label="Permission Name"
              style="margin: 2rem 0"
              hide-details="auto"
            ></v-text-field>
          </v-col>
          <!-- End Search Permission -->

          <div class="d-flex flex-row flex-wrap">
            <v-checkbox
              v-for="(per, index) in permissions"
              v-model="checked_permissions[per.id]"
              :label="per.name"
              color="success"
              :value="per.id"
              @change="onCheckboxChange(per.id, $event.target.checked)"
            ></v-checkbox>
          </div>
        </div>
      </v-col>
    </v-row>
    <v-btn color="success" @click="addPermissions"> Submit </v-btn>
  </div>
</template>
