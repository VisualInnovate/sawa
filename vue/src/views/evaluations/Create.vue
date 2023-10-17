<script>
import axios from "axios";
import questionComponent from '../../components/question.vue'

export default {
  data: () => ({

    NameRules: [
      value => {
        if (value) return true
        return "This field is required"

      },
    ],
    isFormValid:false,
    evaluation: {
      title: "",
      side_profile_id:"",
      six_month:true,
      questions :[]
    },
    alert_text: null,
    type:"success",
    snackbar: true,
    selected: [],
    headers: [],
    questions: [],
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
      this.evaluation.side_profile_id=this.$route.params.sideProfile_id // set side profile id
      axios.post(`/api/evaluations/create`, this.evaluation).then(res => {
        if (res.data.status == 200) {
          this.evaluation = {};
          this.evaluation.six_month=true  //we must put default value

          this.alert_text = "evaluation added successfully "
          this.type="success"
        }
      }).catch((error)=>{
        this.alert_text = error.response.data.message
        this.type="error"
      })
    },
    getQuestionHeaders() {
      axios.get("/api/evaluationheaders").then(res => {
        this.headers = res.data.headers
        console.log(this.headers)
        // console.log(res.data.children)
      })
    },

    addQuestion(headerId, inputs) {

      this.questions[headerId]= inputs
      // this.questions.insert(headerId,inputs)
      console.log(this.questions)
    },
    // validate ()
    // {
    //   this.$refs.form?.validate()
    // }



  },

  mounted() {
    this.getQuestionHeaders()
    // this.$watch('$refs', this.validate, { immediate: true })


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
          v-if="alert_text!= null "
          class="mb-8"
      >
  
      </v-alert>
      <v-form fast-fail @submit.prevent  ref="form" >
        <v-text-field
            v-model="evaluation.title"
            :label="$t('evaluation_title')"
            :rules="NameRules"
        ></v-text-field>
  
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
                  @question-inputs="addQuestion"
              />
  
            </v-expansion-panel>
  
  
          </v-expansion-panels>
        </v-container>
  
  
        <v-btn type="submit"  @click="submit" block class="mt-2">{{$t('submit')}}</v-btn>
  
      </v-form>
    </v-sheet>
  </div>
</template>