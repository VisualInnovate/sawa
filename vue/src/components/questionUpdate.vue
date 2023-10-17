<template>
  <v-expansion-panel-title expand-icon="mdi-plus" collapse-icon="mdi-minus">
    <div class="pa-4">
      {{ header.title }}
    </div>

  </v-expansion-panel-title>
  <v-expansion-panel-text>
    <!-- here  questions -->
    <v-text-field
        :rules="NameRules"
        :label="$t('question')"
        v-for="(question , index) in questionsNumbers"
        v-model="questionInputs[index]"
        v-on:keyup="returnparent"
    ></v-text-field>
    <div class="d-flex justify-end">
      <v-btn
          :icon="icon"
          :color="color"
          @click="addQuestion"
      ></v-btn>
    </div>

  </v-expansion-panel-text>

</template>

<script>
import {th} from "vuetify/locale";

export default {
  name: "question",
  props: ['header', 'questionsAndHeader'],
  emits: ['question-inputs'],
  data: () => ({

    NameRules: [
      value => {
        if (value) return true

        return ' Field is required.'
      },
    ],

    headers: [],
    questionsNumbers: [1,2],
    questionCounter: 2,
    questionInputs: [],
    color:'success',
    icon:"mdi-plus"
  }),
  methods: {
    addQuestion() {
      if(this.questionCounter<3)
      {
        this.questionsNumbers.push(++this.questionCounter)
        this.color="red"
        this.icon="mdi-minus"
      }

      else{
        --this.questionCounter
        this.questionsNumbers.splice(-1,1)
        this.questionInputs.splice(-1,1)
        this.color="success"
        this.icon="mdi-plus"
      }

      // console.log(this.questionInputs)
    },
    returnparent() {
      this.$emit('question-inputs', this.header.id, this.questionInputs)
    },

    setData() {
      console.log(this.questionsAndHeader)

      if (this.questionsAndHeader != undefined) {
        this.questionsNumbers = []
        let i = 1
        this.questionsAndHeader.forEach((value) => {
          this.questionsNumbers.push(i++)
          this.questionInputs.push(value.questions.title)
        })
        this.questionCounter = this.questionsAndHeader.length
        if(this.questionCounter == 3)
        {

          this.color="red"
          this.icon="mdi-minus"
        }

        else{

          this.color="success"
          this.icon="mdi-plus"
        }
      }
      this.returnparent()
    }
  },
  watch: {
    questionCounter(val) {// business rule every category have 2 or 3 options
      if (val > 3)
        this.questionsNumbers.splice(-1)
    }
  }, created() {
    this.setData()
  }

}
</script>

<style scoped>

</style>