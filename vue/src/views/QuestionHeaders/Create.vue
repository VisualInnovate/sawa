<script>
import axios from "axios";

export default {
  data: () => ({

    NameRules: [
      value => {
        if (value?.length >= 3) return true

        return ' name must be at least 3 characters.'
      },
    ],
    questionHeader: {
      title: "",
      from: "",
      to: "",

    },
    fromSelect: [
      {'title': "0", 'value': 0},
      {'title': 'سته اشهر ', 'value': 0.5},
      {'title': 'سنة', 'value': 1},
      {'title': 'سنة و نصف', 'value': 1.5},
      {'title': 'سنتين', 'value': 2},
      {'title': 'سنتين و نصف', 'value': 2.5},
      {'title': '3 سنين', 'value': 3},
      {'title': '3 سنين و نصف', 'value': 3.5},
      {'title': '4 سنين', 'value': 4},
      {'title': '4 سنين و نصف', 'value': 4.5},
      {'title': '5 سنين', 'value': 5},
      {'title': '5 سنين و نصف', 'value': 5.5},
      {'title': '6 سنين', 'value': 6},
      {'title': '6 سنين و نصف', 'value': 6.5},
      {'title': '7 سنين', 'value': 7},
      {'title': '7 سنين و نصف', 'value': 7.5},
      {'title': '8 سنين', 'value': 8},
      {'title': '8 سنين و نصف', 'value': 8.5},
      {'title': '9 سنين', 'value': 9},
      {'title': '9 سنين و نصف', 'value': 9.5},
      {'title': '10 سنين', 'value': 10},
      {'title': '10 سنين و نصف', 'value': 10.5},
      {'title': '11 سنه', 'value': 11},
      {'title': '11 سنين و نصف', 'value': 11.5},
    ],
    toSelect: [
      {'title': 'سته اشهر ', 'value': 0.5},
      {'title': 'سنة', 'value': 1},
      {'title': 'سنة و نصف', 'value': 1.5},
      {'title': 'سنتين', 'value': 2},
      {'title': 'سنتين و نصف', 'value': 2.5},
      {'title': '3 سنين', 'value': 3},
      {'title': '3 سنين و نصف', 'value': 3.5},
      {'title': '4 سنين', 'value': 4},
      {'title': '4 سنين و نصف', 'value': 4.5},
      {'title': '5 سنين', 'value': 5},
      {'title': '5 سنين و نصف', 'value': 5.5},
      {'title': '6 سنين', 'value': 6},
      {'title': '6 سنين و نصف', 'value': 6.5},
      {'title': '7 سنين', 'value': 7},
      {'title': '7 سنين و نصف', 'value': 7.5},
      {'title': '8 سنين', 'value': 8},
      {'title': '8 سنين و نصف', 'value': 8.5},
      {'title': '9 سنين', 'value': 9},
      {'title': '9 سنين و نصف', 'value': 9.5},
      {'title': '10 سنين', 'value': 10},
      {'title': '10 سنين و نصف', 'value': 10.5},
      {'title': '11 سنين', 'value': 11},
      {'title': '11 سنين و نصف', 'value': 11.5},
    ],
    alert_text: '',
    type: 'success',

    snackbar: true,
  }),
  methods: {
    goBack() {
        this.$router.go(-1)
      },
    submit() {
      axios.post(`/api/evaluationheaders/create`, this.questionHeader)
          .then(res => {

            this.alert_text = res.data.message
            if (res.data.status == 200)
              this.type = "success"


          }).catch((error) => {
        console.log(error.response.data.message)
        this.type = "error"
        this.alert_text = error.response.data.message

      }).finally(() => {

        questionHeader.title = ""
        questionHeader.from = ""
        questionHeader.to = ""

      })
    },

  },
  mounted() {

  }
}
</script>
<template>
  <!--  <v-alert v-if="alert_text!= null " color="green" :text="alert_text" class="mb-5"></v-alert>-->
  <div>
    <v-btn height="45" class="mb-5 text-white" color="#A9AB7F" @click="goBack">
      <v-icon
        start
        icon="mdi-arrow-left"
      ></v-icon>
      {{$t('back')}}
    </v-btn>
    <v-sheet max-width="1200" class="mx-auto">
      <v-alert
          :type="type"
          variant="tonal"
          border="start"
          elevation="2"
          closable
          :close-label="$t('close')"
          :text="alert_text"
          v-if="alert_text != '' "
          class="mb-8"
      >
      </v-alert>
      <v-form fast-fail @submit.prevent class="py-4">
        <v-text-field
            v-model="questionHeader.title"
            :label="$t('header_title')"
            :rules="NameRules"
        ></v-text-field>
        <div>
          <div class="v-container">
            <div class="v-row">
              <div class="v-col-6">
                <v-select
                    :label="$t('from')"
                    v-model="questionHeader.from"
                    :items="fromSelect"
                ></v-select>
              </div>
  
              <div class="v-col-6">
                <v-select
                    :label="$t('to')"
                    v-model="questionHeader.to"
                    :items="toSelect"
                ></v-select>
              </div>
            </div>
          </div>
        </div>
  
        <v-btn type="submit" @click="submit" block class="mt-2">{{$t('submit')}}</v-btn>
      </v-form>
    </v-sheet>
  
  </div>
 </template>
