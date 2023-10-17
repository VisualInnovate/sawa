<template>
  <Map />
  <AppointmentRecords />
  <About />
</template>
<script setup(props) { }>
import Map from "../components/Map.vue";
import AppointmentRecords from "../components/AppointmentRecords.vue";
import About from "../components/About.vue";

export default {
  components: { Map, AppointmentRecords, About },
};
</script>
