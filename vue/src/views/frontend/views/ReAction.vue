<template>
  <Map2></Map2>
  <nave class="shadow"></nave>
  <RForm></RForm>
  <About />
</template>
<script setup(props) { }>
import Map2 from "../components/Map2.vue";
import Nave from "../components/Nave.vue";
import RForm from "../components/RForm.vue";
import About from "../components/About.vue";

export default {
  components: { Map2, Nave, RForm, About },
};
</script>
