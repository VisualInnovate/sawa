<script>
import axios from "axios";
import questionComponent from '../../components/questionUpdate.vue'

export default {
  data: () => ({

    NameRules: [
      value => {
        if (value?.length >= 3) return true

        return ' name must be at least 3 characters.'
      },
    ],
    evaluation: {
      title: "",
      side_profile_id:'',
      six_month:true,
      questions: []
    },
    alert_text: null,
    snackbar: true,
    selected: [],
    headers: [],
    questions: [],
    headerAndQuestions: null,
    sideProfile:[]
  }),
  components: {
    questionComponent
  },
  methods: {
    goBack() {
        this.$router.go(-1)
      },
   async submit() {

        // if(!this.isFormValid && this.evaluation.title !="" && this.evaluation.side_profile_id !="") {
        //   this.alert_text = "All questions is required"
        //   this.type="error"
        //   return
        // }
        const { valid } = await this.$refs.form.validate()
        if(!valid )
          return

      this.evaluation.questions=[]
      this.questions.forEach((questions,headerId)=>{  // re formate data to be like $request ->questions[header_id]
        this.evaluation.questions.push({headerId,questions})
      })
      axios.post(`/api/evaluations/${this.$route.params.id }/update`, this.evaluation).then(res => {
        if (res.data.status == 200) {

          this.alert_text = "evaluation edited successfully "
        }
      })
    },getSideProfile(){
      axios.get("/api/side-profiles").then(res => {

        this.sideProfile = res.data.sideProfile.map((elem)=>{
          return {'title':elem.title , 'value':elem.id}
        })


      })
    },
    getQuestionHeaders() {
      axios.get("/api/evaluationheaders").then(res => {
        this.headers = res.data.headers
        console.log(this.headers)
      })
    },
    getQuestions() {
      axios.get(`/api/evaluations/${this.$route.params.id}`).then(res => {
        this.headerAndQuestions = res.data.evaluation
        console.log(this.headerAndQuestions)

      })
      axios.get(`/api/evaluations/${this.$route.params.id}/show`).then(res => {
        this.evaluation.title = res.data.evaluation.title
        this.evaluation.side_profile_id= res.data.evaluation.side_profile_id
        if(res.data.evaluation.six_month==0)
        this.evaluation.six_month= false

      })
    }
    ,
    addQuestion(headerId, inputs) {

      this.questions[headerId] = inputs

    }
  },

  created() {
    this.getQuestions()
    this.getQuestionHeaders()
    this.getSideProfile()


  },
}
</script>
<template>
  <!--  <v-alert v-if="alert_text!= null " color="green" :text="alert_text" class="mb-5"></v-alert>-->

  <div>
    <v-btn height="45" class="mb-5 text-white" color="#135C65" @click="goBack">
      <v-icon
        start
        icon="mdi-arrow-left"
      ></v-icon>
      {{$t('back')}}
    </v-btn>
    <v-sheet max-width="1200" class="mx-auto">
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
      <v-form fast-fail @submit.prevent ref="form">
        <v-text-field
            v-model="evaluation.title"
            :label="$t('evaluation_title')"
            :rules="NameRules"
        ></v-text-field>
        <v-select
            :label="$t('side_profile_title')"
            v-model="evaluation.side_profile_id"
            :items="sideProfile"
        ></v-select>
        <v-checkbox
            v-model="evaluation.six_month"
            :label="$t('evaluation_exception')"
        ></v-checkbox>
        <v-container fluid>
  
          <v-expansion-panels>
            <v-expansion-panel
                v-for="head in headers"
                :key="head.id">
  
              <questionComponent
                  :header="head"
                  v-if="headerAndQuestions"
                  :questionsAndHeader="headerAndQuestions[head.id]"
                  @question-inputs="addQuestion"
              />
  
            </v-expansion-panel>
  
  
          </v-expansion-panels>
        </v-container>
  
  
        <v-btn type="submit" @click="submit" block class="mt-2">{{$t('submit')}}</v-btn>
  
      </v-form>
    </v-sheet>
  </div>
</template>