<script>
import axios from 'axios'
import {th} from "vuetify/locale";

export default {

  data() {
    return {
      search: '',
      headers: [],
      questionHeaders: [],
      alert_text: null,
      loading: true

    }
  },
  methods: {
    getQuestionHeaders() {
      axios.get("/api/evaluationheaders").then(res => {
        this.questionHeaders = res.data.headers
        // console.log(res.data.children)
        this.loading= false;

      })
    }, editItem(id) {
      this.$router.push({name: 'EditHeaders', params: {id: id}})
    }
    , deleteItem(id) {
      console.log(id)
      axios.delete(`/api/evaluationheaders/${id}/delete`).then(res => {
        if (res.data.status == 200) {
          this.alert_text = "category has been deleted successfully "
          this.questionHeaders = res.data.headers
        }

      })
    },
    create() {
      this.$router.push({name: 'CreateHeaders'})
    }
  }, computed: {
    header() {
      return this.headers = [{key: 'id', title: this.$t('index')},
        {key: 'title', title: this.$t('header_title')},
        {key: 'type', title: this.$t('header_type')},
        {key: 'min_age', title: this.$t('min_age')},
        {key: 'actions', title: this.$t('actions')},

      ]
    }
  },
  mounted() {
    this.getQuestionHeaders()
  }
}
</script>

<template>
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

  <v-btn text="Create" color="green" height="45" class="mb-5 mt-5" @click="create">
    {{ $t('create_button') }}
  </v-btn>

  <v-card>
    <v-card-title>
      {{ $t('headers') }}
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
        :items="questionHeaders"
        :search="search"
    >
      <template #top>
        <v-progress-linear v-if="loading" slot="progress" style="color:#135c65" indeterminate></v-progress-linear>
      </template>

      <template #item="{ item , index }">
        <tr>
          <td>{{ index + 1 }}</td>
          <td>{{ item.columns.title }}</td>
          <td>{{ item.columns.type }}</td>
          <td>{{ item.columns.min_age }} months</td>
          <td>
            <v-icon small color="primary" class="mr-2" @click="editItem(item.columns.id)">mdi-pencil</v-icon>
            <v-icon small color="error" @click="deleteItem(item.columns.id)">mdi-delete</v-icon>
          </td>
        </tr>

      </template>

    </v-data-table>
  </v-card>
</template>
