<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
const route =  useRoute()
onMounted(() => {
  axios.get(`api/roles/${route.params.id}`);
});

</script>

<template>
  <div>
    <v-btn height="45" class="mb-5 text-white" color="#A9AB7F" @click="goBack">
      <v-icon
        start
        icon="mdi-arrow-left"
      ></v-icon>
      Back
    </v-btn>
    this is roles show
  </div>
</template>
