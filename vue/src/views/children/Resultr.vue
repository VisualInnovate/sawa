<template>
<div>
    <v-btn height="45" class="mb-5 text-white" color="#135c65" @click="goBack">
        <v-icon
          start
          icon="mdi-arrow-left"
        ></v-icon>
          {{$t('back')}}
      </v-btn>
      <div>
        <v-btn height="45" class="mb-5 text-white" color="#A9AB7F" @click="goprint">
          {{$t('print')}}
      </v-btn>
      </div>
      
  


        <v-data-table 
          v-model:sort-by="sortBy"
          :headers="header"
          :items="desserts"
          class="elevation-1"
        >
        <template v-slot:item="{ item }">
          <tr>
            <td>{{ item.columns.id }}</td>
            <td>{{ item.columns.evaluation_title }}</td>
            <td>{{ item.columns.side_profile_title }}</td>
            <td>{{ item.columns.child_age }}</td>
            <td>{{ item.columns.diff_age}}</td>
            <td>{{ item.columns.grow_age }}</td>
            <td>{{ Math.round(item.columns.late_percentage) }} %</td>
            <td>{{ item.columns.result_created_at}}</td>
          </tr>
        </template></v-data-table>
        
        
      
</div>
</template>
<script>
import axios from 'axios'
import moment from 'moment';

  export default {
    data () {
      return {
        sortBy: [{ key: 'evaluation_title', order: 'asc' }],
        headers: [
         
        ],
        desserts: [],
      }
    },
    computed: {
    locale() {

      return this.$i18n.locale;
    },
    header() {
      return this.headers = [
        {title: this.$t('id') ,key:'id'},
        { title:this.$t('side_profile_title'), key: 'side_profile_title' },
        { title:this.$t('evaluation_title'), key: 'evaluation_title'},

          { title: this.$t('child_age'), key: 'child_age' },
          { title: this.$t('diff_age'), key: 'diff_age' },
          { title: this.$t('grow_age'), key: 'grow_age' },
          { title: this.$t('late_percentage'), key: 'late_percentage' },
          { title: this.$t('result_created_at'), key: 'result_created_at' },


      ];
    },
  },
    
    methods: {
     async getruslte(){
       await axios.post("/api/child/results",{
          sideprofile_id:this.$route.params.sideProfile_id,child_id:this.$route.params.child_id
        }).then(res => {
          console.log(res.data.evaluation_results)
       this.desserts=res.data.evaluation_results
      })  
      for(var i=0; i<this.desserts.length;i++){
        this.desserts[i].result_created_at=moment(this.desserts[i].result_created_at).format('DD-MM-yy ')
      }      
      },
        goBack() {
        this.$router.go(-1)
      },
      goprint(){
        this.$router.push({name:'ResultPrint'})
      }
    },
    mounted() {
        
      this.getruslte()
    },
  }
</script>