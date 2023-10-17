<script setup>
// imports
import { ref } from "vue";
import sawaLogo from "../assets/img/sawa_logo.svg";
import { useAuthStore } from "../stores/Auth";

// variables
const authStore = useAuthStore();
const visible = ref(false);
const form = ref({
  email: "",
  password: "",
});

// validation
const valid = ref(false);
const rules = ref({
  email: [
    (v) => !!v || "E-mail is required",
    (v) => /.+@.+/.test(v) || "E-mail must be valid",
  ],
  password: [(v) => !!v || "Password is required"],
});
</script>

<template>
  <div class="py-4">
    <v-img class="mx-auto mb-10" max-width="228" :src="sawaLogo"></v-img>

    <v-card
      class="mx-auto pa-12 pb-8"
      elevation="8"
      max-width="448"
      rounded="lg"
    >
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
        <small
          class="d-block"
          v-for="(item, index) in authStore.errors"
          :value="index"
          :key="index"
          v-if="typeof authStore.errors === 'object'"
        >
          {{ item }}
        </small>
        <small class="d-block" v-else="typeof authStore.errors === 'string'">
          {{ authStore.errors }}
        </small>
      </v-alert>

      <v-form @submit.prevent="authStore.handleLogin(form)" v-model="valid">
        <div class="text-subtitle-1 text-medium-emphasis">Account</div>

        <v-text-field
          density="compact"
          placeholder="Email address"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
          v-model="form.email"
          :rules="rules.email"
        ></v-text-field>

        <div
          class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
        >
          Password

          <router-link
            class="text-caption text-decoration-none text-blue"
            :to="{ name: 'ForgotPassword' }"
            rel="noopener noreferrer"
            target="_blank"
          >
            Forgot login password?</router-link
          >
        </div>

        <v-text-field
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner="visible = !visible"
          v-model="form.password"
          :rules="rules.password"
        ></v-text-field>

        <v-card class="mb-12" color="surface-variant" variant="tonal">
          <v-card-text class="text-medium-emphasis text-caption">
            <p>Sign in with your email and password:</p>
            <p>Email: <strong>admin@admin.com</strong></p>
            <p>Password: <strong>password</strong></p>
          </v-card-text>
        </v-card>

        <!-- login btn -->
        <v-btn
          block
          type="submit"
          class="mb-8"
          color="blue"
          size="large"
          variant="tonal"
        >
          <v-progress-circular
            indeterminate
            color="info"
            class="mx-3"
            size="25"
            v-show="authStore.loading"
          ></v-progress-circular>
          Log In
        </v-btn>
      </v-form>
      <!-- sign up now link -->
      <v-card-text class="text-center">
        <router-link
          class="text-blue text-decoration-none"
          :to="{ name: 'Register' }"
          rel="noopener noreferrer"
        >
          Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
        </router-link>
      </v-card-text>
    </v-card>
  </div>
</template>

<style lang="scss">
.custom-alert-class {
  .v-alert__close {
    margin-inline-start: 10px;
  }
}
</style>
