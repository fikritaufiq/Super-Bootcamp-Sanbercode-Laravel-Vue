<template>
  <nav class="bg-gray-900 text-white p-4 flex items-center justify-between">
    <div class="block lg:hidden">
      <button @click="toggleDropdown" class="flex items-center space-x-2">
        <span>Menu</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <div v-if="isDropdownOpen" class="absolute left-0 mt-2 w-48 bg-gray-800 text-white rounded-lg shadow-lg lg:hidden">
        <router-link to="/" class="block px-4 py-2 hover:bg-gray-700">Home</router-link>
        <router-link to="/film" class="block px-4 py-2 hover:bg-gray-700">Film</router-link>
        <router-link to="/genre" class="block px-4 py-2 hover:bg-gray-700">Genre</router-link>
        <router-link to="/cast" class="block px-4 py-2 hover:bg-gray-700">Cast</router-link>
      </div>
    </div>

    <div class="hidden lg:flex lg:items-center lg:space-x-4 lg:ml-auto">
      <router-link to="/" class="hover:text-gray-300">Home</router-link>
      <router-link to="/film" class="hover:text-gray-300">Film</router-link>
      <router-link to="/genre" class="hover:text-gray-300">Genre</router-link>
      <router-link to="/cast" class="hover:text-gray-300">Cast</router-link>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};
</script>

<style scoped>

</style>
