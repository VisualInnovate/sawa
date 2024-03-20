<template>
    <va-card class="card">
      
      <div>
      
  
       <div v-if="activeTab === 'English'" class="mt-4">
         Content for Tab 1
        
       </div>
        <div v-if="activeTab === 'Arabic'" class="mt-4">
         Content for Tab 2
        
       </div>
        <div v-if="activeTab === 'Azerbaijan'" class="mt-4">
         Content for Tab 3
       
       </div>
        <div v-if="activeTab === 'Georgia'" class="mt-4">
         Content for Tab 4
         
       </div>
      
       
     </div>
    </va-card>
  
   </template>
   <script>
   import axios from "axios";
   import Dropdown from 'primevue/dropdown';
   
   import InputText from 'primevue/inputtext';
   
   export default {
     components:{Dropdown,InputText},
     data() {
       return {
         // ... existing data properties ...
        
         tabs: [".$t('typeroom1'"],
         activeTab:"Singel Room",
        
       };
     },
     computed: {
       locale() {
         return this.$i18n.locale;
       },
     },
     methods: {
       // ... existing methods ...
       arr (){
         return this.tabs =[
                   { name:this.$t('typeroom1')  },
                   { name:this.$t('typeroom2')  },
                   { name:this.$t('typeroom2')  },
                   { name:this.$t('typeroom2')  },
                   { name:this.$t('typeroom2')  },
                 
                  
               ]
       },
   
      }
    }
     
   </script>
  
   
   <style scoped>
   .router-link-active button {
    color:#EB486D  !important;
  }
   </style>
   