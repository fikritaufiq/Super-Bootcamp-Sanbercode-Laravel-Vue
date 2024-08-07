<template>
  <div id="app" class="bg-base-200 min-h-screen text-white">
    <router-view v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
  </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
</script>

<style>
body {
  background-color: #040412;
  color: #dadfe8;
  margin: 0;
  font-family: Arial, sans-serif;
}

#app {
  min-height: 100vh;
}


.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter, .fade-leave-to  {
  opacity: 0; 
}
</style>