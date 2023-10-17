<template>
  <v-expansion-panel-title expand-icon="mdi-plus" collapse-icon="mdi-minus">
    <div class="pa-4 header-question">
      {{header.title}}
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
        aria-required="true"
    ></v-text-field>


    <div class="d-flex justify-end">
      <v-btn class="btn-question"
          :icon="icon"
          :color="color"
          @click="addQuestion"
      ></v-btn>
    </div>

  </v-expansion-panel-text>

</template>

<script>
export default {
  name: "question",
  props: ['header'],
  emits:['question-inputs'],
  data: () => ({

    NameRules: [
      value => {
        if (value) return true

        return ' Field is required.'
      },
    ],

    headers: [],
    questionsNumbers: [1,2],
    questionCounter:2,
    questionInputs: [],
    color:'success',
    icon:"mdi-plus"
  }),
  methods:{
    addQuestion(){
      if(this.questionCounter<3)
      {
        this.questionsNumbers.push(++this.questionCounter)
        this.color="red"
        this.icon="mdi-minus"
      }

      else{
        --this.questionCounter
        this.questionsNumbers.splice(-1)
        this.questionInputs.splice(-1,1)
        this.color="success"
        this.icon="mdi-plus"
      }

      // console.log(this.questionInputs)


    },
    returnparent(){
      this.$emit('question-inputs',this.header.id,this.questionInputs)
    }
  },mounted() {

  }

}
</script>

<style scoped>
.header-question{
  font-size: 25px;
}
.btn-question i{
  transition:.3s all ease-in-out;
}
</style>