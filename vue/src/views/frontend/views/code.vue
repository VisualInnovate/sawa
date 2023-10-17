<!-- App.vue -->
<template>
  <div class="max-h-screen">
    <Map />
    <otp-entry></otp-entry>
    <About />
  </div>
</template>

<script>
import OtpEntry from '../components/OtpEntry.vue';
import Map from "../components/Map.vue";
import About from "../components/About.vue";
export default {
  components: {
    OtpEntry,
    Map,
    About
  },
};
</script>
