<template>
  <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <div class="flex-1 text-left">
      <router-link to="/" class="text-lg hover:text-gray-300 mx-2">Home</router-link>
    </div>
    <div class="flex-1 text-center">
      <router-link to="/login" class="text-lg hover:text-gray-300 mx-2">Login</router-link>
      <router-link to="/register" class="text-lg hover:text-gray-300 mx-2">Register</router-link>
    </div>

    <div class="flex-1 text-right">
    </div>
  </header>
</template>

<style scoped>
</style>