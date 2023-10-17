<script>
import axios from "axios";
import ConfirmPopup from "primevue/confirmpopup";
import moment from "moment";

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
        { key: "fname", title: this.$t("parent.fname") },
        { key: "lname", title: this.$t("parent.lname") },
        { key: "email", title: this.$t("parent.email") },
        { key: "phone", title: this.$t("parent.phone") },
        { key: "image", title: this.$t("parent.image") },
      ]);
    },
  },
  methods: {
    getParents() {
      axios.get("/api/admin-parents").then((res) => {
        this.parents = res.data.parents;
        console.log(res.data.parents);
        this.loading = false;
      });
    },
    fomate(date) {
      return moment(date).format("DD-MM-yy ");
    },
  },
  mounted() {
    this.getParents();
  },
};
</script>

<template>
  <div>
    <v-card>
      <v-card-title>
        <h2 style="margin: 1rem 0">
          {{ $t("parents") }}
        </h2>
        <v-spacer></v-spacer>

        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="header" :items="parents" :search="search">
        <template #top>
          <v-progress-linear
            v-if="loading"
            slot="progress"
            style="color: #135c65"
            indeterminate
          ></v-progress-linear>
        </template>
        <template #item="{ item }">
          <tr>
            <td>{{ item.columns.id }}</td>
            <td>{{ item.columns.fname }}</td>
            <td>{{ item.columns.lname }}</td>
            <td>{{ item.columns.email }}</td>
            <td>{{ item.columns.phone }}</td>
            <td>
              <img
                :src="item.columns.image"
                style="width: 32px; height: 32px; border-radius: 99px"
                alt="no_img"
                srcset=""
              />
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
