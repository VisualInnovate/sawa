<template>
    <div class="grid grid-row-3">
        <Map />
        <SingForm />
        <About />
        </div>
</template>
<script>
import Map from '../components/Map.vue'; 
import SingForm from '../components/SingForm.vue'; 
import About from '../components/About.vue';

export default {
components:{Map,SingForm,About},

  

}
</script>