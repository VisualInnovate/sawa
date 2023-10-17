<script>
import axios from "axios";
import InputText from 'primevue/inputtext';
import Calendar from "primevue/calendar";
export default {
  components:{InputText,Calendar},
  data: () => ({
    maxDate: new Date(),
    NameRules: [
      value => {
        if (value?.length >= 3) return true

        return ' name must be at least 3 characters.'
      },
    ],
    child:{
      name:"",
      birth_date:""
    },
    alert_text: null
  }),
  methods:{
    goBack() {
        this.$router.go(-1)
      },
    submit(){
      axios.post(`/api/child/${this.$route.params.id }/update`,this.child).then(res =>{
        if(res.data.status == 200)
        {
          this.alert_text="children updated successfully "
          this.child=res.data.child
        }

        console.log(res.data.children)

      })
    },
    getChild(){
      axios.get(`/api/child/${this.$route.params.id}`).then(res =>{
        this.child=res.data.child
      })
    }
  },
  mounted() {
    this.getChild()
  }
}
</script>
<template>
 <div>
  <v-btn height="45" class="mb-5 text-white" color="#135C65" @click="goBack">
    <v-icon
      start
      icon="mdi-arrow-left"
    ></v-icon>
    {{$t('back')}}
  </v-btn>
    <v-sheet max-width="1200"  class="mx-auto" >
  
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
  
      <v-form fast-fail @submit.prevent>
        <v-text-field
            v-model="child.name"
            :label="$t('child_name')"
            :rules="NameRules"
        ></v-text-field>
        <div class="card flex justify-content-center">
          <Calendar
            style="width: 100%"
            showButtonBar
            v-model="child.birth_date" 
            showIcon
            placeholder="dd/mm/yy"
            :maxDate="maxDate"
            :rules="NameRules"

          />
        </div>
      
     
  
        <!-- <v-text-field
            v-model="child.birth_date"
            :label="$t('birth_date')"
           type="date"
        ></v-text-field> -->
  
        <v-btn type="submit" @click="submit" block class="mt-2">{{$t('submit')}}</v-btn>
      </v-form>
    </v-sheet>
 </div>
</template>