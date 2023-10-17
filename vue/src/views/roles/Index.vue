<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useUsersStore } from "../../stores/Users";

const rolesStore = useUsersStore();

const router = useRouter();
const items = ref([]);
const headers = ref([
  { text: "Id", value: "id", sortable: false },
  { text: "Name", align: "start", sortable: false, value: "name" },
  { text: "Actions", value: "actions", sortable: false },
]);
const pageSizes = ref([5, 10, 20]);

const getItems = async () => {
  await rolesStore.fetchRoles();
  items.value = rolesStore.roles.map(getDisplayItem);
};

const handlePageChange = (value) => {
  rolesStore.params.page = value;
  getItems();
};

const handlePageSizeChange = (size) => {
  rolesStore.params.size = size;
  rolesStore.params.page = 1;
  getItems();
};

const getDisplayItem = (item) => {
  return {
    id: item.id,
    name: item.name,
    module: item.module,
  };
};

const editItem = (id) => {
  router.push({ name: "EditRole", params: { id: id } });
};

const deleteItem = (id) => {
  if (confirm("Are you sure you want to delete?")) {
    // yes
    rolesStore.deleteRole(id);
    getItems();
  }
};
onMounted(() => {
  getItems();
});
</script>

<template>
  <v-row align="center" class="list px-3 mx-auto">
    <v-col cols="12" sm="8">
      <v-text-field
        v-model="rolesStore.params.keyword"
        label="Search by Name"
        @keyup="
          page = 1;
          getItems();
        "
      ></v-text-field>
    </v-col>

    <v-col cols="12" sm="4">
      <v-btn color="success" :to="{ name: 'CreateRole' }"> Create </v-btn>
    </v-col>

    <v-col cols="12" sm="12">
      <v-row>
        <v-col cols="4" sm="3">
          <v-select
            v-model="rolesStore.params.size"
            :items="pageSizes"
            label="Items per Page"
            @update:modelValue="handlePageSizeChange"
          ></v-select>
        </v-col>

        <v-col cols="12" sm="9">
          <v-pagination
            rounded="circle"
            v-model="rolesStore.params.page"
            :length="rolesStore.params.totalPages"
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
        <v-card-title>Roles</v-card-title>

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
