<script>
import axios from 'axios'
import {th} from "vuetify/locale";
import ConfirmPopup from 'primevue/confirmpopup';
import moment from 'moment';

export default {
  components:{ConfirmPopup},

  data () {
    return {
      search: '',
      headers: [

      ],
      children: [],
      alert_text: null,
      loading:true

    }
  },computed:{
    header(){
        return this.headers=[ { key: 'id', title: this.$t('index') },
        { key: 'name', title: this.$t('child_name') },
        { key: 'birth_date', title: this.$t('birth_date') },
        { key: 'actions', title: this.$t('actions') },
      ]
    }
  },
  methods:{
     getChildren(){
      axios.get("/api/child").then(res =>{
        this.children=res.data.children
        console.log(res.data.children)
      // }
        this.loading=false
        

      })
    },
    fomate(date){
      return moment(date).format('DD-MM-yy ')

    },
    editItem(id){
      this.$router.push({ name: 'EditChildren' , params: {id: id} })
    }
    ,deleteItem(id){
      console.log(id)
      axios.delete(`/api/child/${id}/delete`).then(res =>{
        if(res.data.status == 200)
        {
          this.alert_text="children deleted successfully "
          this.children=res.data.children
        }

      })
    },
    showItem(id){
      this.$router.push({ name: 'ShowChildren' , params: {id: id} })
    },
    create(){
      this.$router.push({ name: 'CreateChildren' })
    }
  },
 async mounted() {
    if(this.$route.params.alert)
    {
      this.alert_text="done "

     }


   this.getChildren()
    
  },
 
  
}
</script>

<template>
  <div>
    <v-alert
      type="success"
      variant="tonal"
      border="start"
      elevation="2"
      closable
      :close-label="$t('close')"
      :text="alert_text"
      v-if="alert_text!= null"
      class="mb-8"
  >

  </v-alert>
  
  <v-btn   text="Create" color="green" height="45"  class="mb-5 mt-5"   @click="create">
    {{$t('create_button')}}
  </v-btn>

  <v-card>
    <v-card-title >
      {{$t('children')}}
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
        :headers="header"
        :items="children"
        :search="search"
    >
      <template #top>
        <v-progress-linear v-if="loading" slot="progress" style="color:#135c65" indeterminate></v-progress-linear>
      </template>
      <template #item="{ item }">
        <tr>
          <td>{{ item.columns.id }}</td>
          <td>{{ item.columns.name }}</td>
          <td> {{ fomate(item.columns.birth_date)}}</td>
          <td>
            <v-icon  small color="primary" class="mr-2" @click="showItem(item.columns.id)">mdi-eye</v-icon>
            <v-icon small color="primary" class="mr-2" @click="editItem(item.columns.id)">mdi-pencil</v-icon>
            <v-icon small color="error" @click="deleteItem(item.columns.id)">mdi-delete</v-icon>
            <Button @click="confirm2($event)" icon="pi pi-times" label="Delete" outlined severity="danger"></Button>
          </td>
        </tr>
      </template>
    </v-data-table>
  </v-card>
  </div>
</template>