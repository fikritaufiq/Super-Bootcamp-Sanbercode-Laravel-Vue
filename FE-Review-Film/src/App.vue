<template>
  <div id="app">
    <PublicLayout>
      <router-view />
    </PublicLayout>
  </div>
</template>

<script setup>
import PublicLayout from './layouts/PublicLayout.vue';
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
