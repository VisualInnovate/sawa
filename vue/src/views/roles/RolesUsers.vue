<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useUsersStore } from "../../stores/Users";

const usersStore = useUsersStore();

const router = useRouter();
const items = ref([]);
const headers = ref([
  { text: "Id", value: "id", sortable: false },
  { text: "Name", align: "start", sortable: false, value: "name" },
  { text: "Email", align: "start", sortable: false, value: "email" },
  { text: "Role", align: "start", sortable: false, value: "roles" },
  { text: "Actions", value: "actions", sortable: false },
]);

const pageSizes = ref([5, 10, 20]);

const getItems = async () => {
  await usersStore.fetchUsers();
  items.value = usersStore.users.map(getDisplayItem);
};

const handlePageChange = (value) => {
  usersStore.params.page = value;
  getItems();
};

const handlePageSizeChange = (size) => {
  usersStore.params.size = size;
  usersStore.params.page = 1;
  getItems();
};

const getDisplayItem = (item) => {
  return {
    id: item.id,
    name: item.name,
    email: item.email,
    role: item.roles[0],
  };
};

const editItem = (id) => {
  router.push({ name: "UserRole", params: { id: id } });
};

const deleteItem = (id) => {
  router.push({ name: "UserRoleDelete", params: { id: id } });
};

onMounted(() => {
  getItems();
});
</script>

<template>
  <v-row align="center" class="list px-3 mx-auto">
    <v-col cols="12" sm="8">
      <v-text-field
        v-model="usersStore.params.keyword"
        label="Search by Name"
        @keyup="
          page = 1;
          getItems();
        "
      ></v-text-field>
    </v-col>

    <v-col cols="12" sm="4">
      <v-btn color="success" :to="{ name: 'CreateUser' }">
        {{ $t("create_button") }}
      </v-btn>
    </v-col>
    <v-col cols="12" sm="12">
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
      <v-row>
        <v-col cols="4" sm="3">
          <v-select
            v-model="usersStore.params.size"
            :items="pageSizes"
            label="Items per Page"
            @update:modelValue="handlePageSizeChange"
          ></v-select>
        </v-col>

        <v-col cols="12" sm="9">
          <v-pagination
            rounded="circle"
            v-model="usersStore.params.page"
            :length="usersStore.params.totalPages"
            total-visible="7"
            next-icon="mdi-menu-right"
            prev-icon="mdi-menu-left"
            @update:modelValue="handlePageChange"
          ></v-pagination>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" sm="12">
      <v-card class="mx-auto" tile>
        <v-card-title>Users</v-card-title>

        <v-table>
          <thead>
            <tr>
              <th v-for="header in headers" :key="header.id">
                {{ header.text }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.email }}</td>
              <td>{{ item.role?.name }}</td>
              <td>
                <v-icon
                  small
                  color="primary"
                  class="mr-2"
                  @click="editItem(item.id)"
                  >mdi-pencil</v-icon
                >
                <v-icon small color="error" @click="deleteItem(item.id)"
                  >mdi-delete</v-icon
                >
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card>
    </v-col>
  </v-row>
</template>
