<script setup>
import { ref, onMounted, computed } from "vue";
import { useUsersStore } from "../../stores/Users";
import axios from "axios";
import { useI18n } from "vue-i18n";
const t = useI18n();
const usersStore = useUsersStore();

const imageSrc = ref("");
const doctor_image = ref("");
const fileInput = ref(null);

const alert_text = ref("");
const show_alert = ref(false);
const openFile = () => {
  fileInput.value.click();
};

const form = ref({
  name: "",
  title: "",
  email: "",
  image: "",
  role: null,
  password: "",
});

const handleFileUpload = (e) => {
  const image = e.target.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(image);
  reader.onload = (e) => {
    imageSrc.value = e.target.result;
    doctor_image.value = image;
    form.value.image = image;
    // console.log(imageSrc);
  };
};

const valid = ref(false);

const rules = ref({
  name: [
    (value) => {
      if (value) return true;
      return "Name is required";
    },
    (value) => {
      if (value?.length >= 4) return true;
      return "Name must be less than 4 charcters";
    },
  ],
  title: [
    (value) => {
      if (value) return true;
      return "title is required";
    },
  ],
  email: [
    (value) => {
      if (value) return true;

      return "E-mail is requred.";
    },
    (value) => {
      if (/.+@.+\..+/.test(value)) return true;

      return "E-mail must be valid.";
    },
  ],
  password: [
    (value) => {
      if (value) return true;
      return "Password is required";
    },
    (value) => {
      if (value?.length >= 4) return true;
      return "Password must be less than 6 charcters";
    },
  ],
});

const create = async (form) => {
  const formData = new FormData();
  formData.append("name", form.name);
  formData.append("title", form.title);
  formData.append("email", form.email);
  formData.append("image", form.image);
  formData.append("role", form.role);
  formData.append("password", form.password);

  console.log(formData.get("image"));

  usersStore.addUser(formData);

  // axios
  //   .post("/api/users/create", formData)
  //   .then((res) => {
  //     alert_text.value = t("user_created");
  //     show_alert.value = true;
  //     console.log(res);
  //   })
  //   .catch((err) => {
  //     console.log(err);
  //   });
};

onMounted(async () => {
  usersStore.fetchRoles();
});
</script>

<template>
  <v-card class="mx-auto pa-12 pb-8" elevation="8">
    <v-alert
      class="custom-alert-class"
      type="success"
      variant="tonal"
      border="start"
      elevation="2"
      closable
      :close-label="$t('close')"
      v-if="usersStore.successMsg"
    >
      <small>{{ usersStore.successMsg }}</small>
    </v-alert>
    <v-alert
      class="custom-alert-class"
      type="error"
      variant="tonal"
      border="start"
      elevation="2"
      closable
      :close-label="$t('close')"
      v-if="usersStore.errors.length !== 0"
    >
      <small
        class="d-block"
        v-for="(item, index) in usersStore.errors"
        :value="index"
        :key="index"
        v-if="typeof usersStore.errors === 'object'"
      >
        {{ item[0] }}
      </small>
      <small class="d-block" v-else="typeof usersStore.errors === 'string'">
        {{ usersStore.errors }}
      </small>
    </v-alert>
    <v-card-title class="mb-2"> Create User </v-card-title>
    <!-- Alert -->
    <!-- <v-alert
      class="custom-alert-class"
      type="success"
      variant="tonal"
      closable
      :close-label="$t('close')"
      v-if="show_alert == true"
    >
      <small>{{ alert_text }}</small>
    </v-alert> -->
    <!-- End Alert -->
    <v-form v-model="valid" @submit.prevent="create(form)">
      <v-row>
        <!--  Name -->
        <v-col cols="12" md="4">
          <v-text-field
            v-model="form.name"
            :rules="rules.name"
            :counter="4"
            label="Name"
            variant="solo"
            required
          ></v-text-field>
        </v-col>
        <!-- End  Name -->

        <!-- Title -->
        <v-col cols="12" md="4">
          <v-text-field
            v-model="form.title"
            :rules="rules.title"
            label="Title"
            variant="solo"
            required
          ></v-text-field>
        </v-col>
        <!-- End Title -->
      </v-row>
      <v-row>
        <!-- Role  -->
        <v-col cols="12" md="4">
          <label for="role" style="display: block">{{
            $t("choose_role")
          }}</label>
          <select
            name="role"
            id="role"
            v-model="form.role"
            style="width: 100%; border: 1px solid gray; border-radius: 5px"
          >
            <option :value="role.id" v-for="role in usersStore.roles">
              {{ role.name }}
            </option>
          </select>
        </v-col>
        <!-- End Role  -->
        <!-- Image -->
        <v-col cols="12" md="4" style="display: flex; align-items: center">
          <div class="relative">
            <label for="image">{{ $t("personal_image") }}</label>
            <input
              style="border: 1px solid gray; padding: 0 1rem"
              class="rounded"
              type="file"
              ref="fileInput"
              name="image"
              id="image"
              @change="handleFileUpload"
              :rules="rules.name"
            />
          </div>
          <img
            @click="openFile"
            v-if="imageSrc.length > 0"
            :src="imageSrc"
            class="uploaded-image relative cursor-pointer rounded object-cover"
          />
        </v-col>
        <!-- Image -->
      </v-row>
      <v-row>
        <!-- Email  -->
        <v-col cols="12" md="4">
          <v-text-field
            v-model="form.email"
            :rules="rules.email"
            label="E-mail"
            variant="solo"
            required
          ></v-text-field>
        </v-col>
        <!-- End Email  -->

        <!--Password  -->
        <v-col cols="12" md="4">
          <v-text-field
            v-model="form.password"
            :rules="rules.password"
            :counter="6"
            label="Password"
            variant="solo"
            required
          ></v-text-field>
        </v-col>
        <!-- End Password  -->
      </v-row>
      <v-card-actions>
        <!-- <v-btn color="error" variant="elevated">Cancel</v-btn> -->
        <v-btn type="submit" color="success" variant="elevated">
          <v-progress-circular
            indeterminate
            color="white"
            class="mx-3"
            size="25"
            v-show="usersStore.loading"
          ></v-progress-circular>
          Save
        </v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<style lang="scss">
.custom-alert-class {
  .v-alert__close {
    margin-inline-start: 10px;
  }
}
</style>
