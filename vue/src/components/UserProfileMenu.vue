<script setup>
import { ref } from 'vue'
import { useAuthStore } from "../stores/Auth";

const { handleLogout } = useAuthStore();

const items = ref([
  { title: "My Profile" , clickAction: '', icon:'mdi-account-tie' },
  { title: "Logout", clickAction: handleLogout, icon: 'mdi-logout' },
]);
</script>

<template>
  <v-menu>
    <template v-slot:activator="{ props }">
      <v-btn icon="mdi-dots-vertical" v-bind="props"></v-btn>
    </template>
    <v-list>
    <template v-for="(item, index) in items" :value="index" :key="index" >    
        <v-list-item  @click.prevent="item.clickAction" :prepend-icon="item.icon">
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
    </template>
    </v-list>
  </v-menu>
</template>
