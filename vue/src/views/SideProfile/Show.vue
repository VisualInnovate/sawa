<script>
import axios from 'axios'
import {th} from "vuetify/locale";

export default {

  data() {
    return {
      search: '',
      headers: [],
      evaluations: [],
      alert_text: null

    }
  },
  methods: {
    getEvaluations() {
      axios.get(`/api/side-profiles/${this.$route.params.id}/evaluations`).then(res => {
        this.evaluations = res.data.evaluations
        console.log(res.data.evaluations)

      })
    }, editItem(id) {
      this.$router.push({name: 'EditEvaluations', params: {id: id}})
    }
    , deleteItem(id) {
      console.log(id)
      axios.delete(`/api/evaluations/${id}/delete`).then(res => {
        if (res.data.status == 200) {
          this.alert_text = "evaluation deleted successfully "
          this.evaluations = res.data.evaluations
        }

      })
    },
    create() {
      this.$router.push({name: 'CreateEvaluations',params:{sideProfile_id : this.$route.params.id}})
    },
    showItem(id) {
      this.$router.push({name: 'ShowEvaluations', params: {id: id}})
    }
  },
  computed:{
    header(){
      return this.headers=[{ title: this.$t('index')},
        {key: 'title', title: this.$t('evaluation_title')},]
    }
  },
  mounted() {
    this.getEvaluations()
  }
}
</script>

<template>
 <div>
  <v-btn height="45" class="mb-5 text-white" color="#135C65" @click="goBack">
    <v-icon
      start
      icon="mdi-arrow-left"
    ></v-icon>
    {{$t('back')}}
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

  <v-btn text="Create" color="green" height="45" class="mb-5 mt-5" @click="create">
    {{$t('create_button')}}
  </v-btn>

  <v-card>
    <v-card-title>
      {{$t('evaluations')}}
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
      <template #item="{ item , index}">
        <tr>
          <td>{{  index + 1}}</td>
          <td>{{ item.columns.title }}</td>
          <td>
            <v-icon small color="primary" class="mx-3" @click="showItem(item.raw.id)">mdi-plus-box</v-icon>
            <v-icon small color="primary" class="mx-3" @click="editItem(item.raw.id)">mdi-pencil</v-icon>
            <v-icon small color="error mx-3" @click="deleteItem(item.raw.id)">mdi-delete</v-icon>
          </td>
        </tr>

      </template>

    </v-data-table>
  </v-card>
 </div>
</template>