<script>
import axios from "axios";

export default {
  props: ["id"],
  data() {
    return {
      user_permissions: [],
      new_permissions: [],
    };
  },
  methods: {
    syncPermissions() {
      console.log(this.new_permissions);
      axios
        .post(`/api/users/${this.id}/sync-permissions`, {
          roles: this.new_permissions,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getUserPermissions() {
      axios
        .get(`/api/users/${this.id}/permissions`)
        .then((res) => {
          this.user_permissions = res.data.user_permissions;
          this.user_permissions.forEach((per) => {
            this.new_permissions.push(per);
          });
          console.log(this.user_permissions);
          console.log(this.new_permissions);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    removePer(per) {
      this.new_permissions.splice(this.new_permissions.indexOf(per), 1);
      this.user_permissions.splice(this.user_permissions.indexOf(per), 1);
    },
  },
  mounted() {
    this.getUserPermissions();
  },
};
</script>

<template>
  <div style="margin: 1.5rem 0; padding: auto 0">
    <v-row style="min-height: 80vh">
      <v-col sm="12">
        <v-row>
          <v-col
            v-for="per in user_permissions"
            style="
              background: gainsboro;
              margin: 0.3rem 0.5rem;
              padding: 0.5rem 1rem;
              border-radius: 99px;
              cursor: pointer;
            "
            :md="4"
            :sm="6"
            @click="removePer(per)"
          >
            {{ per.name }}
          </v-col>
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-btn
      color="success"
      @click="syncPermissions"
      :disabled="new_permissions.length == 0"
    >
      Submit
    </v-btn>
  </div>
</template>
