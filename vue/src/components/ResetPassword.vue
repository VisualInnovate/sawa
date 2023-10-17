<script setup>
// imports
import { ref } from "vue";
import { useAuthStore } from "../stores/Auth";
import { useRoute } from "vue-router";

// variables
const route = useRoute();
const authStore = useAuthStore();
const form = ref({
  token: route.params.token,
  email: route.query.email,
  password: "",
  password_confirmation: "",
});

// validation
const valid = ref(false);
const rules = ref({
  password: [(v) => !!v || "Password is required"],
  password_confirmation: [(v) => !!v || "Password Confirmation is required"],
});
</script>

<template>
  <v-container>
    <v-row>
      <v-col class="v-col-sm-12 v-col-md-6 offset-md-3 mx-auto">
        <v-card elevation="4" light tag="section">
          <v-card-title> Reset Password </v-card-title>
          <v-card-text>
            <v-alert
              class="custom-alert-class"
              type="error"
              variant="tonal"
              border="start"
              elevation="2"
              closable
              :close-label="$t('close')"
              v-if="authStore.errors.length !== 0"
            >
              <template
                v-for="(item, index) in authStore.errors"
                :value="index"
                :key="index"
              >
                <div>
                  {{ item[0] }}
                </div>
              </template>
            </v-alert>
          </v-card-text>
          <v-form @submit.prevent="authStore.resetPassword(form)" v-model="valid">
            <v-card-text>
              <v-text-field
                outline
                label="New Password"
                type="password"
                v-model="form.password"
                :rules="rules.password"
              ></v-text-field>
              <v-text-field
                outline
                label="Confirm Password"
                type="password"
                v-model="form.password_confirmation"
                :rules="rules.password_confirmation"
              ></v-text-field>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn color="info" type="submit"> Reset </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style lang="scss">
.custom-alert-class {
  .v-alert__close {
    margin-inline-start: 10px;
  }
}
</style>
