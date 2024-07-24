<template>
    <div>
      <Header />
      <main class="mt-4">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>
    </div>
  </template>
  
  <script setup>
  import Header from '../components/Layouts/Header.vue';
  </script>
  
  <style scoped>
  </style>
  