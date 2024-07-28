<template>
  <div id="app">
      <router-view />
  </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
</script>

<style>
body {
  background-color: #010814;
  color: white;
  margin: 0;
  font-family: Arial, sans-serif;
}

#app {
  min-height: 100vh;
}
</style>
