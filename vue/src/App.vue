<template>
  <v-container>
    <v-row no-gutters>
      <v-col cols="2">
        <v-sheet v-for="item in menuItems" :key="item.route" class="ma-2 pa-2">
          <router-link :to="item.route ">
            {{ item.title }}
          </router-link>
        </v-sheet>
      </v-col>
      <v-col cols="10">
        <v-sheet class="ma-2 pa-2">
          <router-view></router-view>
        </v-sheet>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'

const menuItems = ref([
  { route: '/', title: 'Ask Gemini' },
  { route: '/set-gemini-api-key', title: 'Set API Key' }
])
</script>

<style scoped>
/* Add styles if needed */
</style>
