<script>
import axios from 'axios'
import {th} from "vuetify/locale";

export default {

  data() {
    return {
      search: '',
      headers: [

        {key: 'evaluation_title', title: 'Evaluation Title'},
        {title: this.$t('operation')},
      ],
      sideProfile: [],
      alert_text: null,
      groupBy: [{key: 'side_profile_title'}],
      loading: true,
      childName: ''

    }
  },
  methods: {
    showside(id) {
      // console.log(id)
      // this.$router.push({ name: 'showChildEvaluation' , params: {id: id} })
      this.$router.push({name: 'resulte', params: {child_id: this.$route.params.id, sideProfile_id: id}})
      // this.$router.push({ name: 'resulte' })
      // this.$router.push({ name: 'resulte' })
    },
    goBack() {
      this.$router.go(-1)
    },
    getSideProfile() {
      axios.get(`api/child/${this.$route.params.id}/show-side-profiles`).then(res => {
        this.sideProfile = res.data.sideProfile
        this.loading = false;
        console.log(res.data.sideProfile)

      })
    },
    getChildrenName() {
      axios.get(`api/child/${this.$route.params.id}`).then(res => {
        this.childName = res.data.child.name
        // this.loading = false;
      })
    }
    , editItem(id) {
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

    showItem(evaluation_id, side_profile_id) {
      console.log(evaluation_id)
      this.$router.push({
        name: 'showChildResult', params: {
          child_id: this.$route.params.id,
          sideProfile_id: side_profile_id,
          evaluation_id: evaluation_id
        }
      })
    }
  },
  mounted() {
    this.getSideProfile()
    this.getChildrenName()
  }
}
</script>

<template>
  <div>
    <v-btn height="45" class="mb-5 text-white" color="#135c65" @click="goBack">
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


    <v-card>
      <v-card-title>
        {{ childName }}
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
          :headers="headers"
          :items="sideProfile"
          :search="search"
          :group-by="groupBy"
          style="padding:15px;"
      >

        <template #top>
          <v-progress-linear v-if="loading" slot="progress" style="color:#F6F6F6" indeterminate></v-progress-linear>
        </template>
        <template #group-header="{item, isGroupOpen, toggleGroup ,columns , props}">

          <tr>
            <td @click="toggleGroup(item)" style="cursor: pointer; background-color:#F6F6F6;  ">
              <v-icon
              >{{ isGroupOpen(item) ? 'mdi-chevron-down' : 'mdi-chevron-right' }}
              </v-icon>

              {{ item.value }}

            </td>
            <td @click="toggleGroup(item)" style="background-color:#F6F6F6; cursor: pointer;"></td>
            <td style="background-color:#F6F6F6">
              <v-icon small color="primary" class="mx-3" @click="showside(item.items[0].raw.side_profile_id)">mdi-eye
              </v-icon>
              <!-- <v-icon small color="primary" class="mx-3" @click="editItem(item.items[0].raw.side_profile_id)">mdi-eye</v-icon> -->

            </td>
          </tr>
        </template>

        <template #headers="">
          <tr>
            <td>{{$t('evaluation_type')}}</td>
            <td>{{headers[0].title}}</td>
            <td>{{headers[1].title}}</td>

          </tr>

        </template>

        <template #item="{ item , index }">


          <tr>
            <td>{{ colgroup }}</td>
            <td>{{ item.columns.evaluation_title }}</td>
            <td>
              <v-icon small color="primary" class="mr-2"
                      @click="showItem(item.raw.evaluations_id,item.raw.side_profile_id)">mdi-eye
              </v-icon>

            </td>
          </tr>

        </template>

      </v-data-table>
    </v-card>
  </div>
</template>