<script>
import axios from 'axios'
import {th} from "vuetify/locale";

export default {

  data() {
    return {
      search: '',
      headers: [],
      sideProfile: [],
      alert_text: null,
      loading: true,
      groupBy: [{key: 'side_profile_title'}],
      active: false

    }
  },
  methods: {
    getSideProfile() {
      axios.get("/api/side-profiles/all-evaluations").then(res => {
        this.sideProfile = res.data.evaluations
        console.log(this.sideProfile)
        this.loading = false


      })
    }, editItem(id) {
      this.$router.push({name: 'EditSideProfiles', params: {id: id}})
    }
    , deleteItem(id) {
      console.log(id)
      axios.delete(`/api/side-profiles/${id}/delete`).then(res => {
        if (res.data.status == 200) {
          this.alert_text = "side profile deleted successfully "
          this.sideProfile = res.data.sideProfile
        }

      })
    },
    create() {
      this.$router.push({name: 'CreateSideProfiles'})
    },
    showItem(id) {
      this.$router.push({name: 'ShowSideProfiles', params: {id: id}})
    },
    onClickOutside() {
      this.active = false
    },
    editEvaluation(id) {
      this.$router.push({name: 'EditEvaluations', params: {id: id}})
    }
    , deleteEvaluation(id) {
      console.log(id)
      axios.delete(`/api/evaluations/${id}/delete`).then(res => {
        if (res.data.status == 200) {
          this.alert_text = "evaluation deleted successfully "
          this.getSideProfile()
        }

      })
    },
    createEvaluation(side_profile_id) {
      this.$router.push({name: 'CreateEvaluations',params:{sideProfile_id : side_profile_id}})
    },
    showEvaluation(id) {
      this.$router.push({name: 'ShowEvaluations', params: {id: id}})
    }
  },
  mounted() {
    this.getSideProfile()
  },
  computed: {
    header() {
      return this.headers = [
        {key: 'evaluation_title', title: this.$t('evaluation_title')},
        { title: this.$t('operation')},

      ];
    }
  },

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

  <v-btn text="Create" color="green" height="45" class="mb-5 mt-5" @click="create" v-click-outside="onClickOutside">
    {{ $t('create_button') }}
  </v-btn>

  <v-card>
    <v-card-title>
      {{ $t('side_profile') }}
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
        :items="sideProfile"
        :search="search"
        :loading="true"
        :group-by="groupBy"
        item-key="name"
        show-group-by
    >
      <template #top>
        <v-progress-linear v-if="loading" slot="progress" style="color:#135c65" indeterminate></v-progress-linear>
      </template>
      <template #headers="">
        <tr>
          <td>{{$t('evaluation_type')}}</td>
          <td>{{headers[0].title}}</td>
          <td>{{headers[1].title}}</td>
        </tr>

      </template>
      <template #group-header="{item, isGroupOpen, toggleGroup ,columns , props}">

        <tr>
          <td @click="toggleGroup(item)" style="cursor: pointer; background-color:#EFEFEF;  ">
            <v-icon 
            >{{ isGroupOpen(item) ? 'mdi-chevron-down' : 'mdi-chevron-right' }}
            </v-icon>

            {{ item.value}}

          </td>
          <td @click="toggleGroup(item)" style="cursor: pointer; background-color:#EFEFEF;  "></td>
          <td style=" background-color:#EFEFEF; ">
            <v-icon small color="primary" class="mx-3" @click="createEvaluation(item.items[0].raw.side_profile_id)">mdi-plus-box</v-icon>
            <v-icon small color="primary" class="mx-3" @click="editItem(item.items[0].raw.side_profile_id)">mdi-pencil</v-icon>

          </td>

        </tr>

      </template>


            <template #item="{ item , index }">


              <tr>
                <td>{{ colgroup }}</td>
                <td>{{ item.columns.evaluation_title }}</td>
                <td>
                  <v-icon small color="primary" class="mx-3" @click="showEvaluation(item.raw.evaluation_id)">mdi-eye</v-icon>
                  <v-icon small color="primary" class="mx-3" @click="editEvaluation(item.raw.evaluation_id)">mdi-pencil</v-icon>
                  <v-icon small color="error mx-3" @click="deleteEvaluation(item.raw.evaluation_id)">mdi-delete</v-icon>
                </td>
              </tr>

            </template>

    </v-data-table>
    <!--      <template #no-data>-->
    <!--            <p class="text-center text-sm-center w-100 my-5" style="color:#135C65">The Table is Empty. Please insert data with the above Button.</p>-->
    <!--      </template>-->

  </v-card>
</template>