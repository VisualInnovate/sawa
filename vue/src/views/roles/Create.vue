<script setup>
import { ref, onMounted, computed } from "vue";
import { useUsersStore } from "../../stores/Users";

const rolesStore = useUsersStore();
const form = ref({
  name: "",
  permissions: [],
});

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
});

const create = async (form) => {
  await rolesStore.addRole(form);
};

onMounted(async () => {
    rolesStore.fetchPermissions();
});
</script>

<template>
  <div>
    <v-btn height="45" class="mb-5 text-white" color="#A9AB7F" @click="goBack">
      <v-icon
        start
        icon="mdi-arrow-left"
      ></v-icon>
      Back
    </v-btn>
    <v-card class="mx-auto pa-12 pb-8" elevation="8">
      <v-alert
        class="custom-alert-class"
        type="success"
        variant="tonal"
        border="start"
        elevation="2"
        closable
        :close-label="$t('close')"
        v-if="rolesStore.successMsg"
      >
        <small>{{ rolesStore.successMsg }}</small>
      </v-alert>
      <v-alert
          class="custom-alert-class"
          type="error"
          variant="tonal"
          border="start"
          elevation="2"
          closable
          :close-label="$t('close')"
          v-if="rolesStore.errors.length !== 0"
        >
          <small
            class="d-block"
            v-for="(item, index) in rolesStore.errors"
            :value="index"
            :key="index"
            v-if="typeof rolesStore.errors === 'object'"
          >
            {{ item }}
          </small>
          <small
            class="d-block"
            v-else="typeof rolesStore.errors === 'string'"
          >
            {{ rolesStore.errors }}
          </small>
        </v-alert>
      <v-card-title class="mb-2"> Create Role </v-card-title>
      <v-form v-model="valid" @submit.prevent="create(form)">
        <v-row>
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
              v-model="form.permissions"
              :items="rolesStore.permissions"
              label="Permissions"
              variant="solo"
              :item-title="(role) => role.name"
              :item-value="(role) => role.id"
              :item-disabled="false"
              multiple
            ></v-select>
          </v-col>
        </v-row>
        <v-card-actions>
          <v-btn color="error" variant="elevated">Cancel</v-btn>
          <v-btn type="submit" color="success" variant="elevated">
            <v-progress-circular
              indeterminate
              color="white"
              class="mx-3"
              size="25"
              v-show="rolesStore.loading"
            ></v-progress-circular>  
            Save
          
          </v-btn>
        </v-card-actions>
      </v-form>
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
