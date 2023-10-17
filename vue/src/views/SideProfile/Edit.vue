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
      axios.post(`/api/side-profiles/${this.$route.params.id}/update`,this.sideProfile).then(res =>{
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
 
</template>