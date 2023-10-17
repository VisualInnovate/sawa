<script setup>
import { ref, onMounted } from "vue";
import { useUsersStore } from "../../stores/Users";
import { useRoute } from "vue-router";
import { storeToRefs } from "pinia";
import axios from "axios";
const route = useRoute();

const usersStore = useUsersStore();
const { getUserById } = storeToRefs(usersStore);

const form = ref({
  user_id: null,
  title: "",
  name: "",
  email: "",
  image: "",
  password: "",
  role: null,
});

const valid = ref(false);
const fileInput = ref(null);
const imageSrc = ref("");
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
});

const openFile = () => {
  fileInput.value.click();
};
const handleFileUpload = (e) => {
  const image = e.target.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(image);
  reader.onload = (e) => {
    imageSrc.value = e.target.result;
    form.value.image = image;
    // console.log(imageSrc);
  };
};

const updateUser = async (form) => {
  // console.log(form);

  const formData = new FormData();

  formData.append("name", form.name);
  formData.append("title", form.title);
  formData.append("email", form.email);
  formData.append("role", form.role);
  formData.append("user_id", form.user_id);

  if (form.password != null) {
    formData.append("password", form.password);
  }
  if (form.image != null) {
    formData.append("image", form.image);
  }

  await usersStore.updateUser(formData);
};

onMounted(async () => {
  await usersStore.fetchRoles();
  await usersStore.fetchUsers();
  const user = getUserById.value(route.params.id);
  form.value.user_id = route.params.id;
  form.value.title = user.title;
  form.value.name = user.name;
  form.value.email = user.email;
  imageSrc.value = user.image;
  form.value.role = user.roles[0].id;

  if (form.value.password === "") {
    delete form.value.password;
  }
  if (form.value.image === "") {
    delete form.value.image;
  }
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
        {{ item }}
      </small>
      <small class="d-block" v-else="typeof usersStore.errors === 'string'">
        {{ usersStore.errors }}
      </small>
    </v-alert>
    <v-card-title class="mb-2"> Edit User </v-card-title>
    <v-form v-model="valid" @submit.prevent="updateUser(form)">
      <v-row>
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
        <v-col cols="12" md="4">
          <v-select
            v-model="form.role"
            :items="usersStore.roles"
            label="Role"
            variant="solo"
            :item-title="(role) => role.name"
            :item-value="(role) => role.id"
            :item-disabled="false"
          ></v-select>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field
            v-model="form.email"
            :rules="rules.email"
            label="E-mail"
            variant="solo"
            required
          ></v-text-field>
        </v-col>
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
      <v-row>
        <!-- Image -->
        <v-col cols="12" md="4" style="display: flex; align-items: center">
          <div class="relative m-auto">
            <input
              type="file"
              ref="fileInput"
              name="image"
              id="image"
              hidden
              @change="handleFileUpload"
            />
            <img
              @click="openFile"
              :src="imageSrc"
              class="uploaded-image relative m-auto cursor-pointer rounded-full"
            />

            <svg
              @click="openFile"
              class="cursor-pointer absolute left-[50%] m-auto bottom-0 bg-white rounded-full p-1 h-8 w-8"
              viewBox="-2.4 -2.4 28.80 28.80"
              xmlns="http://www.w3.org/2000/svg"
              fill="#29CCFF"
              transform="matrix(-1, 0, 0, 1, 0, 0)"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  fill="#29CCFF"
                  d="M21 3H3C1.35 3 0 4.35 0 6v12c0 1.55 1.19 2.83 2.7 2.98.1.01.2.02.3.02h18c.1 0 .2 0 .29-.02.03 0 .06-.01.09-.01C22.86 20.78 24 19.52 24 18V6c0-1.65-1.35-3-3-3zm1 13.53l-2.21-4.42c-.25-.5-.69-.87-1.22-1.03-.19-.05-.38-.08-.57-.08-.35 0-.7.09-1.01.27l-6.41 3.74-2.46-1.67C7.78 13.11 7.39 13 7 13c-.52 0-1.03.2-1.41.59L2 17.18V6c0-.55.45-1 1-1h18c.55 0 1 .45 1 1v10.53z"
                ></path>
                <circle fill="#29CCFF" cx="11" cy="10" r="2"></circle>
              </g>
            </svg>
          </div>
        </v-col>
        <!-- Image -->
      </v-row>
      <v-card-actions>
        <!-- <v-btn color="error" variant="elevated" @click.prevet="$router.go(-1)"
          >Cancel</v-btn
        > -->
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
