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
    sideProfile:{
      title:"",

    },
    type:"success",
    alert_text: null,
  }),
  methods:{
    submit(){
      axios.post(`/api/side-profiles/create`,this.sideProfile).then(res =>{
        if(res.data.status == 200)
        {
          this.sideProfile=[];
          this.alert_text="side profile added successfully "
          this.type= "success"
        }
      }).catch((error)=>{
        this.alert_text = error.response.data.message
        this.type="error"

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
  
  
    <v-sheet max-width="1200"  class="mx-auto" >
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
      <v-form fast-fail @submit.prevent>
        <v-text-field
            v-model="sideProfile.title"
            :label="$t('side_profile_title')"
            :rules="NameRules"
        ></v-text-field>
  
  
  
        <v-btn type="submit" @click="submit" block class="mt-2">{{$t('submit')}}</v-btn>
      </v-form>
    </v-sheet>
  </div>
</template>