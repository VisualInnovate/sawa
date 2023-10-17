<script>
import axios from 'axios'
import {th} from "vuetify/locale";
import router from "@/router/index.js";

export default {

  data() {
    return {
      search: '',
      headers: [],
      evaluations: [],
      alert_text: null,
      tableCounter: 1

    }
  },
  methods: {
    goBack() {
        this.$router.go(-1)
      },
    getResults() {
      axios.get(`/api/evaluations/${this.$route.params.child_id}/${this.$route.params.sideProfile_id}/evaluations-child`).then(res => {
        this.evaluations = res.data.evaluations
        console.log(this.evaluations )

      })
    },
    showItem(id) {
      console.log(id)
      this.$router.push({
        name: 'showChildResult', params: {
          child_id: this.$route.params.child_id,
          sideProfile_id: this.$route.params.sideProfile_id,
          evaluation_id: id
        }
      })
    }

  },
  mounted() {
    this.getResults()
  },
  computed: {
    locale() {

      return this.$i18n.locale;
    },
    header() {
      return this.headers = [{title: "id"},
        {key: 'evaluation_title', title: this.$t('evaluation_title')},]
    }
  }
}
</script>

<template>
 <div>
  <v-btn height="45" class="mb-5" color="red" @click="goBack">
    <v-icon
      start
      icon="mdi-arrow-left"
    ></v-icon>
    Back
  </v-btn>

  <v-alert
      type="success"
      variant="tonal"
      border="start"
      elevation="2"
      closable
      :close-label="$t('close')"
      :text="alert_text"
      v-if="alert_text!= null "
      class="mb-8"
  >

  </v-alert>

  <!--  <v-btn   text="Create" color="green" height="45"  class="mb-5 mt-5"   @click="create">-->
  <!--    Create-->
  <!--  </v-btn>-->

  <v-card>
    <v-card-title>
      Evaluation
      <v-spacer></v-spacer>

      <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
        :headers="header"
        :items="evaluations"
        :search="search"
    >
      <template #item="{ item , index }">
        <tr>
          <td>{{ index + 1 }}</td>
          <td>{{ item.columns.evaluation_title }}</td>
          <td>
            <v-icon small color="#135C65" class="mx-3" @click="showItem(item.raw.id)"> mdi-eye</v-icon>

          </td>
        </tr>

      </template>

    </v-data-table>
  </v-card>
 </div>
</template>
