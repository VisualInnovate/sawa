<script>
import axios from "axios";
import {th} from "vuetify/locale";
import {format, formatDistance, formatRelative, subDays, differenceInMonths} from 'date-fns'
import moment from "moment";
import InputText from 'primevue/inputtext';
import Calendar from 'primevue/calendar';

export default {
  components:{InputText,Calendar},
  data: () => ({
    valu:"",

    NameRules: [
      value => {
        if (value) return true
        return "This field is required"

      },
    ],
    title: "",
    answers: [],
    alert_text: '',
    type: "success",
    snackbar: true,
    selected: [],
    children: [],
    selectBox: [],
    child_id: '',
    child: '',
    
    numberOfMonth: '',
    skip: [],
    headerAndQuestions: [],
    examDate:'',
  }),
  methods: {
    fomate(){
    // this.examDate =  moment(new Date()).format("YYYY-MM-DD HH:mm")
    },
    goBack() {
        this.$router.go(-1)
      },
    getQuestions() {
      axios.get(`/api/evaluations/${this.$route.params.id}`).then(res => {
        this.headerAndQuestions = res.data.evaluation


      })
      axios.get(`/api/evaluations/${this.$route.params.id}/show`).then(res => {
        this.title = res.data.evaluation.title
        // console.log(res.data.evaluation)
      })


    },
    async submit() {
      const {valid} = await this.$refs.form.validate()
      if (!valid)
        return
      this.answers = []
      this.selected.forEach((value, question_id) => {
        this.answers.push({question_id, value})
      })
      this.examDate =  moment(new Date()).format("YYYY-MM-DD HH:mm")
      axios.post(`/api/evaluations/${this.$route.params.id}/submit`, {
        'answers': this.answers,
        'child_id': this.child_id,
        'date':this.examDate
      }).then(res => {
        if (res.data.status == 200) {
          this.child.childInMonths = -1 //reset child in months to -1 to not show any question header
          this.alert_text = "evaluation added successfully "
          this.type = "success"
        }
      }).catch((error) => {
        this.alert_text = error.response.data.message
        this.type = "error"
      })


    },
    getChildren() {
      axios.get("/api/child").then(res => {
        this.children = res.data.children.forEach((item) => {
          this.selectBox.push({'title': item.name, 'value': item.id})
        })
        // console.log(this.selectBox)

      })
    },
    radioChange(selected, evaluation_header_id, question_id) {
      // console.log(this.selected)
      // console.log(evaluation_header_id)
      let flag = 0
      if (this.skip[evaluation_header_id] == undefined) {
        this.skip[evaluation_header_id] = [{id: question_id, answer: selected}]
      } else {
        let answer = this.skip[evaluation_header_id]
        answer.forEach((elem) => {
          // console.log(elem)
          if (elem.id == question_id) {
            flag++
            elem.answer = selected
          }

        })
        if (!flag) {
          answer.push({id: question_id, answer: selected})
          this.skip[evaluation_header_id] = answer
        }
      }
      // console.log(this.skip)

      let count = 0;
      let check = 0.
      let prev = -1
      let current = -1
      Object.entries(this.skip).reverse().forEach((elem) => {
        const [key, value] = elem;
        prev=current
        current=key


        for (const item of value) {
          if (item.answer == 1)
            count++
          else {
            count = 0
            break
          }
        }
        if (count) {

          if (this.headerAndQuestions[key].length == count)
            check++;
          count = 0
        } else {
          check = 0
        }
        if (check == 2) {
          let checkHeaderFlag = 0;

          for (const item of Object.entries(this.headerAndQuestions)) {
            const [headerKey, valueKey] = item;
            if (key == headerKey) {
              break;
            }
            valueKey.forEach((elem) => {
              this.selected[elem.questions.id] = 1
            })
          }

          this.answers = []
          this.selected.forEach((value, question_id) => {
            this.answers.push({question_id, value})
          })
          axios.post(`/api/evaluations/${this.$route.params.id}/${prev}/basalAge`, {
            answers: this.answers,
            child_id: this.child_id,
            date:this.examDate
          }).then(res => {
            console.log(res.data.resultEvaluation)
          })

          this.$router.push({name: 'Children', params: {alert: 1}})
        }

      })
    }, 
    getSpecificChildren() {


      axios.get(`/api/child/${this.child_id}/${this.$route.params.id}`).then(res => {
        console.log(res.data.child)
        if (!res.data.child.canDoExam) {
          this.alert_text = "sorry this child has this evaluate lass than 6 months"
          this.type = "error"
          this.child = res.data.child
          this.child.childInMonths = -1 //reset child in months to -1 to not show any question header
        } else {
          this.alert_text = ""
          this.child = res.data.child
        }
        // console.log(this.child)
      })
    },

  }

  , mounted() {
    this.getQuestions()
    this.getChildren()

    this.examDate =  moment(new Date()).format("YYYY-MM-DD HH:mm")
    
    console.log(this.examDate)
  },
  


}


</script>

<template>
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
      <h1 class="text-center"> {{ title }}</h1>
  
  
      <v-form fast-fail ref="form" @submit.prevent="submit">
        <v-select
            label="Child"
            v-model="child_id"
            @update:modelValue="getSpecificChildren"
            :items="selectBox"
            :rules="NameRules"
        ></v-select>
        <!-- <v-text-field
            v-model="examDate"
            :label="$t('examDate')"
            type="datetime-local"
            
        ></v-text-field> -->
        <div class="card flex justify-content-center">
          <Calendar style="width: 100%;" v-model="examDate" @change="fomate()" date-format="dd-mm-yy" showIcon :rules="NameRules"  :show-time="true"  />
        
      </div>
       
        <div v-for="questions in Object.values(headerAndQuestions).reverse()">
  
          <div v-if="questions[0].min_age <= this.child.childInMonths">
            <ul>
              <li class="font-weight-bold mb-3 mx-7">{{ questions[0].title }}</li>
            </ul>
  
            <div v-for=" question  in questions" class="border border-1 rounded pa-5">
  
              <div class="mb-3">
                {{ question.questions.title }}
              </div>
              <v-radio-group v-model="selected[question.questions.id]"
                             @change="radioChange(selected[question.questions.id],question.questions.evaluation_header_id,question.questions.id)"
                             :rules="NameRules">
                <v-radio label="True" value="1"></v-radio>
                <v-radio label="False" value="0"></v-radio>
              </v-radio-group>
  
            </div>
          </div>
          <div class="mb-7">
  
          </div>
  
        </div>
        <v-btn type="submit" block class="mt-2">{{ $t('submit') }}</v-btn>
  
      </v-form>
      
    </v-sheet>
  
  </div>
</template>