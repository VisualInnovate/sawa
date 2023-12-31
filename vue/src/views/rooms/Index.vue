<template>
  
  <div>
    
    <v-card>
      <v-card-title>
        <h2 class="mb-1">{{ $t("room") }}</h2>
        <p>{{ $t("defindexroom") }}</p>

        <v-row class="mb-3">
          <v-col cols="12" sm="6" md="4">
            <v-text-field
              v-model="search"
              label="Search"
              outlined
              hide-details
            ></v-text-field>
          </v-col>
          <v-col v-if="showCreateButton" cols="12" sm="6" md="4"></v-col>
          <v-col cols="12" sm="6" md="4">
            <!-- Use router-link with v-icon for navigation -->
            <router-link :to="{ name: 'CreateUser' }">
              <v-icon color="success">mdi-plus</v-icon>
            </router-link>
          </v-col>
        </v-row>
      </v-card-title>

      <v-data-table :headers="header" :items="parents" :search="search">
        <template #item="{ item }">
          <tr>
            <td>{{ item.columns.id }}</td>
            <td>{{ $t("drtitle") }}{{ item.columns.title }}</td>
                 <td>
            <v-icon small color="primary" class="mx-3" @click="showItem(item.columns.id)">mdi-plus-box</v-icon>
            <v-icon small color="primary" class="mx-3" @click="editItem(item.columns.id)">mdi-pencil</v-icon>
            <v-icon small color="error mx-3" @click="deleteItem(item.columns.id)">mdi-delete</v-icon>
          </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import axios from "axios";
import ConfirmPopup from "primevue/confirmpopup";
import moment from "moment";
import SidbarVue from "../frontend/components/Sidbar.vue";

export default {
  components: { ConfirmPopup },

  data() {
    return {
      search: "",
      headers: [],
      parents: [],
      loading: true,
    };
  },
  computed: {
    header() {
      return (this.headers = [
        { key: "id", title: this.$t("index") },
        { key: "title", title: this.$t("roomdoctor") },
      ]);
    },
  },
  methods: {
    getParents() {
      axios.get("/api/getrome_data").then((res) => {
        this.parents = res.data.parents;
        console.log(res.data.parents);
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getParents();
  },
};
</script>

<style scoped>
/* Add any custom styles here */
</style>