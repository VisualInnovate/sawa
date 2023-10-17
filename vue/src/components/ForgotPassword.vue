<script setup>
// imports
import { ref, onMounted } from "vue";
import { useAuthStore } from "../stores/Auth";

// variables
const form = ref({
  email: "",
});

// validation
const valid = ref(false);
const rules = ref({
  email: [
    (v) => !!v || "E-mail is required",
    (v) => /.+@.+/.test(v) || "E-mail must be valid",
  ],
});

const authStore = useAuthStore();

onMounted(() => {
  authStore.resetAuthStore();
});
</script>

<template>
  <v-container>
    <v-row>
      <v-col class="v-col-sm-12 v-col-md-6 offset-md-3 mx-auto">
        <v-card elevation="4" light tag="section">
          <v-card-title> Forgot Password </v-card-title>
          <v-card-text>
            <v-alert
              class="custom-alert-class"
              type="success"
              variant="tonal"
              border="start"
              elevation="2"
              closable
              :close-label="$t('close')"
              v-if="authStore.successMsg"
            >
              {{ authStore.successMsg }}
            </v-alert>
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
          <v-form
            @submit.prevent="authStore.forgotPassword(form)"
            v-model="valid"
          >
            <v-card-text>
              <v-text-field
                outline
                label="Email"
                type="text"
                v-model="form.email"
                :rules="rules.email"
              ></v-text-field>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn color="info" type="submit"> Send Link </v-btn>
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
